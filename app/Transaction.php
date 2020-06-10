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
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public static function getUserTransactions(){
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        return $transactions;
    }

    public static function getPaginatedUserTransactions(){
        $transactions = Transaction::where('user_id', Auth::user()->id)->paginate(6);
        return $transactions;
    }

    public static function getSuccessfulTransactions(){
        return Transaction::where('transaction_status', 1)->get();
    }
    public static function getLatestTransactions(){
        return Transaction::where('transaction_status', 1)->OrderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }
}
