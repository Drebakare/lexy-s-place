<?php
/**
 * Created by PhpStorm.
 * User: drebakare
 * Date: 30/05/2020
 * Time: 11:02pm
 */

namespace App\Http;

use Illuminate\Support\Facades\Auth;

class paymentMethod{
    public static function processPayment ($request){
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
        return [$err, $response];

    }
    public static function processConfirmPayment($reference, $curl){
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer sk_test_c73dcf5db9c50537e01dd4cb133f7b1b2a2bd181",
                "cache-control: no-cache"
            ],
        ));
        return $curl;
    }
}

