<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderSummary;
use App\Product;
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
            $create_order = new order();
            $create_order->user_id = Auth::user()->id;
            $create_order->receipt_no = Str::random(15);
            $create_order->total_price = Order::calculateTotalOrderPrice();
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

            $curl = curl_init();
            $email = Auth::user()->email;
            $amount = $request->amount * 100;  //the amount in kobo. This value is actually NGN 300

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode([
                    'amount'=>$amount,
                    'email'=>$email,
                ]),
                CURLOPT_HTTPHEADER => [
                    "authorization: Bearer sk_test_c73dcf5db9c50537e01dd4cb133f7b1b2a2bd181", //replace this with your own test key
                    "content-type: application/json",
                    "cache-control: no-cache"
                ],
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            if($err){
                // there was an error contacting the Paystack API
                return redirect()->back()->with('failure', "Payment Could not be Process, Kindly Try Again");
            }

            $tranx = json_decode($response, true);

            if(!$tranx["status"]){
                return redirect()->back()->with('failure', "Payment Could not be Process, Kindly Try Again");
/*                print_r('API returned error: ' . $tranx['message']);*/
            }
            $transaction_summary = [
                'reference_id' => $create_order->receipt_no,
                'amount' => $request->amount,
            ];
            session()->put('transaction_summary',$transaction_summary);
            return redirect( $tranx['data']['authorization_url']);
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', $exception->getMessage());
        }
    }

    public function confirmPayment(){
        try {
            $curl = curl_init();
            $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
            if(!$reference){
                session()->forget('transaction_summary');
                return view('actions.failure_page')->with('failure', 'Could not be Confirmed.');
            }
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    "accept: application/json",
                    "authorization: Bearer sk_test_c73dcf5db9c50537e01dd4cb133f7b1b2a2bd181",
                    "cache-control: no-cache"
                ],
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

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
                $transaction_data = session()->get('transaction_summary');
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
                $transaction->transaction_type = 'Debit - Order';
                $transaction->transaction_status = 1;
                $transaction->token = Str::random(15);
                $transaction->save();

                session()->forget('transaction_summary');
                $order = Order::where('receipt_no', $receipt)->first();
                return view('actions.success_page', compact('order'));
            }
        }
        catch (\Exception $exception){
            dd($exception);
        }
    }
}
