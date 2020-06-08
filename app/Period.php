<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = [
        'period', 'room_id', 'price' ,  'token'
    ];

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }

    public static function getPeriods(){
        return Period::where('store_id', session()->get('check_store_session'))->get();
    }
}
