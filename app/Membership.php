<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'membership_name', 'discount', 'token'
    ];

    public function customerDetail(){
        return $this->hasOne(CustomerDetail::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }

}
