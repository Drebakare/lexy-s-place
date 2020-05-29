<?php

namespace App\Http\Controllers\User;

use App\CustomerDetail;
use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MembershipController extends Controller
{
    public function upgradeMembership(){
        try {
            if (session()->get('intended_url')){
                session()->forget('intended_url');
            }
            $customer_details = CustomerDetail::where('user_id', Auth::user()->id)->first();
            if ($customer_details->membership_id == 1){
                $transaction = new Transaction();
                $transaction->user_id = Auth::user()->id;
                $transaction->amount = 5000;
                $transaction->transaction_no = Str::random(15);
                $transaction->transaction_type = 'Credit - Wallet';
                $transaction->transaction_status = 0;
                $transaction->token = Str::random(15);
                $transaction->save();
                $curl = curl_init();
                $email = Auth::user()->email;
                $amount = $transaction->amount * 100;  //the amount in kobo. This value is actually NGN 300

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
                    'reference_id' => $transaction->token,
                    'amount' => 5000,
                    'type' => 'credit',
                    'membership_upgrade' => 2
                ];
                session()->put('transaction_summary',$transaction_summary);
                return redirect( $tranx['data']['authorization_url']);
            }
            else{
                return redirect()->back()->with('failure', "You have an Active Membership Subscription");
            }

        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', 'Payment could not be processed');
        }
    }
}
