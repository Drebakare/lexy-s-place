<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'transaction_no' , 'transaction_type', 'transaction_status',
         'token'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
