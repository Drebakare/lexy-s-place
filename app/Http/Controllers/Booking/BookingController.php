<?php

namespace App\Http\Controllers\Booking;

use App\AuditTrail;
use App\Booking;
use App\CustomerDetail;
use App\Http\Controllers\Controller;
use App\Period;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkStoreSession');
    }

    public function bookRoom(){
        if (session()->get('intended_url')){
            session()->forget('intended_url');
        }
        $periods = Period::getPeriods();
        foreach ($periods as $key =>  $period ){
            $confirm_period = Booking::confirmAvailability($period);
            if ($confirm_period){
                unset($periods[$key]);
            }
        }
        $membership_id = CustomerDetail::getUserDetails()->membership_id;
        AuditTrail::createLog(Auth::user()->id, "Viewed Booking Page");
        return view('actions.booking', compact('periods', 'membership_id'));
    }

    public function finalBookings(Request $request){
        try {
            $period = Period::where('id', $request->period)->first();

            $confirm_period = Booking::confirmAvailability($period);
            if ($confirm_period){
                return redirect()->back()->with('failure', "Period already Booked, Kindly Select Another Period");
            }
            else{
                $check_balance = CustomerDetail::checkBalance();

                if ($check_balance->credit_balance >= $period->price){
                    CustomerDetail::deductMoney($period->price);
                    //create bookings
                    $booking = new Booking();
                    $booking->user_id = Auth::user()->id;
                    $booking->period_id = $request->period;
                    $booking->booking_status = 0;
                    $booking->payment_status = 1;
                    $booking->receipt_no = Str::random(15);
                    $booking->token = Str::random(15);
                    $booking->store_id = session()->get('check_store_session');
                    $booking->save();

                    //record transactions
                    $transaction = new Transaction();
                    $transaction->user_id = Auth::user()->id;
                    $transaction->amount = $period->price;
                    $transaction->transaction_no = Str::random(15);
                    $transaction->transaction_type = 'Wallet-Debit-Booking';
                    $transaction->transaction_status = 1;
                    $transaction->token = Str::random(15);
                    $transaction->store_id = session()->get('check_store_session');
                    $transaction->save();
                    AuditTrail::createLog(Auth::user()->id, "Successfully Booked a Room");
                    return view('actions.booking_success_page', compact('booking'));
                }
                else{
                    return redirect()->back()->with('failure', 'Balance Insufficient For this Transaction');
                }

            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', 'Room Booking Could not be Processed');
        }
    }
}
