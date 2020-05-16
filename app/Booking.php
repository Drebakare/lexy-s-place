<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'period_id', 'booking_status', 'receipt_no', 'token'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function period(){
        return $this->belongsTo(Period::class);
    }
}
