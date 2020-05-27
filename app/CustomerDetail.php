<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CustomerDetail extends Model
{
    protected $fillable = [
        'user_id', 'credit_balance', 'membership_id' , 'token'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function membership(){
        return $this->belongsTo(Membership::class);
    }

    public static function createNewCustomer($email){
        $user = User::getUserByEmail($email);
        $customer_details = CustomerDetail::create([
           'user_id' => $user->id,
            'credit_balance' => 0,
            'membership_id' => 1,
            'token' => Str::random(15),
        ]);
    }

    public static function getUserDetails(){
        return CustomerDetail::where('user_id', Auth::user()->id)->first();
    }
}
