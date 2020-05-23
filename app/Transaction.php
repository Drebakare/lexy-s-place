<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'transaction_no' , 'transaction_type', 'transaction_status',
         'token'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public static function getUserTransactions(){
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        return $transactions;
    }
}
