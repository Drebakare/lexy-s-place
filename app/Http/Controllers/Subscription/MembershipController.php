<?php

namespace App\Http\Controllers\Subscription;

use App\AuditTrail;
use App\CustomerDetail;
use App\Http\Controllers\Controller;
use App\Membership;
use App\SubscriptionList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MembershipController extends Controller
{
    public function chargeUsers(){
        $users = SubscriptionList::getActiveUsers();
        foreach ( $users as $user ) {
            $email = $user->user->email;
            $amount = 5000 * 100;
            $authorization_code = Crypt::decryptString($user->authorization_key);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.paystack.co/transaction/charge_authorization",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode([
                    'authorization_code'=>$authorization_code,
                    'email'=>$email,
                    'amount' => $amount,
                ]),
                CURLOPT_HTTPHEADER => [
                    "authorization: Bearer sk_test_c73dcf5db9c50537e01dd4cb133f7b1b2a2bd181", //replace this with your own test key
                    "content-type: application/json",
                    "cache-control: no-cache"
                ],
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            $tranx = json_decode($response, true);
            if ($err){
                $change_membership = CustomerDetail::where('user_id', $user->user_id)->update([
                    'membership_id' => 1
                ]);
                if ($change_membership){
                    $user->status = 0;
                    $user->save();
                }
                $action = "Automatic Subscription Could not be mad";
                AuditTrail::createLog($user->user_id, $action);
            }
            if ("failure" == $tranx['data']['status']){
                $change_membership = CustomerDetail::where('user_id', $user->user_id)->update([
                    'membership_id' => 1
                ]);
                if ($change_membership){
                    $user->status = 0;
                    $user->save();
                }
                $action = "Successfully Subscribed for Membership upgrade";
                AuditTrail::createLog($user->user_id, $action);
            }
            if ("success" == $tranx['data']['status']){
                $update_wallet = CustomerDetail::where('user_id', $user->user_id )->first();
                $update_wallet->credit_balance = $update_wallet->credit_balance + ($amount / 100);
                $update_wallet->membership_id = 2;
                $update_wallet->save();
                $user->status = 1;
                $user->save();
            }
        }
    }
}
