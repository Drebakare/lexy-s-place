<?php

namespace App\Http\Controllers\Payment;

use App\CustomerDetail;
use App\Http\Controllers\Controller;
use App\Http\paymentMethod;
use App\Order;
use App\OrderSummary;
use App\Product;
use App\SubscriptionList;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use League\CommonMark\Block\Renderer\BlockQuoteRenderer;

class PaymentController extends Controller
{
    public function makePayment(Request $request)
    {
        try{
            if ($request->payment_submission == 'online'){
                $create_order = new order();
                $create_order->user_id = Auth::user()->id;
                $create_order->receipt_no = Str::random(15);
                $create_order->total_price = Order::calculateTotalOrderPrice();
                $create_order->total_paid = $request->amount;
                if(session()->get('voucher_id')){
                    $create_order->voucher_id = 0;
                }
                $create_order->membership_id = 1;
                $create_order->token = Str::random(15);
                $create_order->table_id = $request->table;
                $create_order->save();
                // create order summaries
                foreach (session()->get('cart') as $product){
                    $create_order_summaries = new OrderSummary();
                    $get_product = Product::getProduct($product['token']);
                    $create_order_summaries->order_id = $create_order->id;
                    $create_order_summaries->product_id = $get_product->id;
                    $create_order_summaries->qty = $product['quantity'];
                    $create_order_summaries->price = $get_product->price;
                    $create_order_summaries->sub_total = $product['quantity'] * $get_product->price;
                    $create_order_summaries->token = Str::random(15);
                    $create_order_summaries->save();
                }
                $result = paymentMethod::processPayment($request);
                if($result[0]){
                    return redirect()->back()->with('failure', "Payment Could not be Process, Kindly Try Again");
                }

                $tranx = json_decode($result[1], true);

                if(!$tranx["status"]){
                    return redirect()->back()->with('failure', "Payment Could not be Process, Kindly Try Again");
                }

                $transaction_summary = [
                    'reference_id' => $create_order->receipt_no ,
                    'amount' => $request->amount,
                    'type' => 'order',
                ];
                session()->put('transaction_summary',$transaction_summary);

                return redirect($tranx['data']['authorization_url']);
            }
            elseif ($request->payment_submission == 'wallet'){
                $confirm_balance = CustomerDetail::checkBalance();
                if ($confirm_balance->credit_balance >=  $request->amount){
                    $create_order = new order();
                    $create_order->user_id = Auth::user()->id;
                    $create_order->receipt_no = Str::random(15);
                    $create_order->total_price = Order::calculateTotalOrderPrice();
                    $create_order->total_paid = $request->amount;
                    if(session()->get('voucher_id')){
                        $create_order->voucher_id = 0;
                    }
                    $create_order->membership_id = 1;
                    $create_order->token = Str::random(15);
                    $create_order->table_id = $request->table;
                    $create_order->save();

                    // create order summaries
                    foreach (session()->get('cart') as $product){
                        $create_order_summaries = new OrderSummary();
                        $get_product = Product::getProduct($product['token']);
                        $create_order_summaries->order_id = $create_order->id;
                        $create_order_summaries->product_id = $get_product->id;
                        $create_order_summaries->qty = $product['quantity'];
                        $create_order_summaries->price = $get_product->price;
                        $create_order_summaries->sub_total = $product['quantity'] * $get_product->price;
                        $create_order_summaries->token = Str::random(15);
                        $create_order_summaries->save();
                    }
                    // deduct money from the wallet
                    $status = CustomerDetail::DeductMoney($request->amount);
                    if ($status){
                        $update_order = Order::where('token',$create_order->token)->update([
                            'status' => 1
                        ]);
                        if ($update_order){
                            if (session()->get('cart')){
                                session()->forget('cart');
                            }
                            // create transaction
                            $transaction = new Transaction();
                            $transaction->user_id = Auth::user()->id;
                            $transaction->amount = $request->amount;
                            $transaction->transaction_no = $create_order->receipt_no;
                            $transaction->transaction_type = 'Wallet- Debit - Order';
                            $transaction->transaction_status = 1;
                            $transaction->token = Str::random(15);
                            $transaction->save();
                            $order = Order::where('token', $create_order->token)->first();

                            return view('actions.success_page', compact('order'));
                        }
                        else{
                            return view('actions.failure_page')->with('failure', 'Was not Succcessfull');
                        }
                    }
                }
                else{
                    return redirect()->back()->with('failure', "Insufficient Balance, Kindly Credit You Wallet and Try Again");
                }
            }
            else{
                return redirect()->back()->with('failure', 'Kindly Select the right payment method to use');
            }

        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', 'payment could not be made, kindly try again');
        }
    }

    public function creditWallet(Request $request){
        try {
            $transaction = new Transaction();
            $transaction->user_id = Auth::user()->id;
            $transaction->amount = $request->amount;
            $transaction->transaction_no = Str::random(15);
            $transaction->transaction_type = 'Credit - Wallet';
            $transaction->transaction_status = 0;
            $transaction->token = Str::random(15);
            $transaction->save();

            $result = paymentMethod::processPayment($request);
            if($result[0]){
                return redirect()->back()->with('failure', "Payment Could not be Process, Kindly Try Again");
            }

            $tranx = json_decode($result[1], true);

            if(!$tranx["status"]){
                return redirect()->back()->with('failure', "Payment Could not be Process, Kindly Try Again");
            }

            $transaction_summary = [
                'reference_id' => $transaction->token,
                'amount' => $request->amount,
                'type' => 'credit',
            ];
            session()->put('transaction_summary',$transaction_summary);

            return redirect($tranx['data']['authorization_url']);
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', 'Payment could not be processed');
        }
    }

    public function confirmPayment(){
        try {
            $transaction_data = session()->get('transaction_summary');
            if ($transaction_data['type'] == 'order'){
                $curl = curl_init();
                $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
                if(!$reference){
                    session()->forget('transaction_summary');
                    return view('actions.failure_page')->with('failure', 'Could not be Confirmed.');
                }
                $curl_response = paymentMethod::processConfirmPayment($reference, $curl);
                $response = curl_exec($curl_response);
                $err = curl_error($curl_response);

                if($err){
                    // there was an error contacting the Paystack API
                    session()->forget('transaction_summary');
                    return view('actions.failure_page')->with('failure', 'Could not be Confirmed');
                }

                $tranx = json_decode($response);

                if(!$tranx->status){
                    session()->forget('transaction_summary');
                    return view('actions.failure_page')->with('failure', 'Was not Succcessfull');
                }

                if('success' == $tranx->data->status){
                    $receipt = $transaction_data['reference_id'];

                    if (session()->get('cart')){
                        session()->forget('cart');
                    }
                    $set_order_status = Order::where('receipt_no', $receipt)->update([
                        'status' => 1
                    ]);

                    // create transaction
                    $transaction = new Transaction();
                    $transaction->user_id = Auth::user()->id;
                    $transaction->amount = $transaction_data['amount'];
                    $transaction->transaction_no = $transaction_data['reference_id'];
                    $transaction->transaction_type = 'Online - Debit - Order';
                    $transaction->transaction_status = 1;
                    $transaction->token = Str::random(15);
                    $transaction->save();

                    session()->forget('transaction_summary');
                    $order = Order::where('receipt_no', $receipt)->first();
                    return view('actions.success_page', compact('order'));
                }
            }
            else{
                $curl = curl_init();
                $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
                if(!$reference){
                    session()->forget('transaction_summary');
                    return view('actions.payment_failure_page')->with('failure', 'Could not be Confirmed.');
                }
                $curl_response = paymentMethod::processConfirmPayment($reference, $curl);
                $response = curl_exec($curl_response);
                $err = curl_error($curl_response);

                if($err){
                    // there was an error contacting the Paystack API
                    session()->forget('transaction_summary');
                    return view('actions.payment_failure_page')->with('failure', 'Could not be Confirmed');
                }

                $tranx = json_decode($response);

                if(!$tranx->status){
                    session()->forget('transaction_summary');
                    return view('actions.payment_failure_page')->with('failure', 'Was not Succcessfull');
                }

                if('success' == $tranx->data->status){
                    $receipt = $transaction_data['reference_id'];
                    $set_order_status = Transaction::where('token', $receipt)->update([
                        'transaction_status' => 1,
                    ]);
                    $update_wallet = CustomerDetail::where('user_id', Auth::user()->id)->first();
                    $update_wallet->credit_balance = $update_wallet->credit_balance + $transaction_data['amount'];
                    $update_wallet->save();

                    if (array_key_exists('membership_upgrade', $transaction_data) ){
                        $customer_details = CustomerDetail::where('user_id', Auth::user()->id)->first();
                        $customer_details->membership_id = $transaction_data['membership_upgrade'];
                        $customer_details->save();
                        $decrypt = SubscriptionList::createOrUpdate($tranx->data->authorization->authorization_code);
                    }

                    session()->forget('transaction_summary');
                    $wallet = Transaction::where('token', $receipt)->first();
                    return view('actions.payment_success_page', compact('wallet'));
                }

            }
        }
        catch (\Exception $exception){
            session()->forget('transaction_summary');
            return view('actions.failure_page')->with('failure', 'Was not Succcessfull');
        }
    }
}
