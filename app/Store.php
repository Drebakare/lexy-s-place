<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'store_name', 'location'
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
