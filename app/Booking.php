<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    public function store(){
        return $this->belongsTo(Store::class);
    }

    public static function confirmAvailability($period){
        $status = Booking::where(['period_id' => $period->id, 'booking_status' => 0])
                            ->whereDate('created_at', Carbon::today())->first();
        return $status;
    }

    public static function getBookings(){
        return Booking::where('user_id', Auth::user()->id)->get();
    }
}
