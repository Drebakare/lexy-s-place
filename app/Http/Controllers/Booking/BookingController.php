<?php

namespace App\Http\Controllers\Booking;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Period;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookRoom(){
        $periods = Period::getPeriods();
        foreach ($periods as $key =>  $period ){
            $confirm_period = Booking::confirmAvailability($period);
            if ($confirm_period){
                unset($periods[$key]);
            }
        }
        return view('actions.booking', compact('periods'));
    }

    public function finalBookings(Request $request){
        try {
            dd($request);
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', 'Room Booking Could not be Processed');
        }
    }
}
