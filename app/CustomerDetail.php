<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
