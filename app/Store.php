<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public static function checkStore($token){
        $store = Store::where('token', $token)->first();
        if ($store){
            return true;
        }
        else{
            return false;
        }
    }

    public static function updateStoreDetails($request, $token){
        $store = Store::where('token', $token)->update([
            'store_name' => $request->store_name,
            'location' => $request->location,
            'token' => Str::random(15)
        ]);
        if ($store){
            return true;
        }
        else{
            return false;
        }
    }
}
