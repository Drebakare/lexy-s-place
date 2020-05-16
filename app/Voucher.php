<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code', 'discount', 'status' , 'token'
    ];
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
