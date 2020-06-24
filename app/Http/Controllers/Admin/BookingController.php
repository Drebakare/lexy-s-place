<?php

namespace App\Http\Controllers\Admin;

use App\AuditTrail;
use App\Http\Controllers\Controller;
use App\Period;
use App\Room;
use App\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function viewRooms(){
        if (Auth::user()->store_id == null){
            $rooms = Room::get();
        }
        else{
            $rooms = Room::where(['store_id' => Auth::user()->store_id])->get();
        }
        return view('Admin.Actions.create-rooms', compact('rooms'));
    }

    public function createRoom(Request $request){
        $this->validate($request, [
            'room_name' => 'bail|required|unique:rooms',
        ]);
        try {
            //create a new room
            $new_room = new Room();
            $new_room->room_name = $request->room_name;
            $new_room->token = Str::random(15);
            $new_room->store_id = Auth::user()->store_id;
            $new_room->save();
            //log action
            $action = "Created a new Room called ".$new_room->room_name;
            AuditTrail::createLog(Auth::user()->id, $action);
            return redirect()->back()->with('success', 'Room successfully created');
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Room could not be created');
        }
    }

    public function editRoom(Request $request, $token){
        $this->validate($request, [
            'room_name' => 'bail|required',
        ]);
        try {
            $check_room = Room::where('token', $token)->first();
            if ($check_room){
                $check_room->room_name = $request->room_name;
                $check_room->token = Str::random(15);
                $check_room->save();

                $action = "Updated Room to ".$request->room_name;
                AuditTrail::createLog(Auth::user()->id, $action );
                return redirect()->back()->with('success', 'Room Details Successfully Updated');
            }
            else{
                return redirect()->back()->with('failure', 'Room does not Exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Room could not be Edited');
        }
    }

    public function viewPeriod(){
        if (Auth::user()->store_id == null){
            $periods = Period::get();
            $rooms = Room::get();
        }
        else{
            $periods = Period::where(['store_id' => Auth::user()->store_id])->get();
            $rooms = Room::where(['store_id' => Auth::user()->store_id])->get();
        }
        return view('Admin.Actions.create-periods', compact('periods','rooms'));
    }

    public function createPeriod(Request $request){
        $this->validate($request, [
            'period' => 'bail|required',
            'price' => 'bail|required',
            'room_id' => 'bail|required',
        ]);
        try {
            //create a new period
            $new_period = new Period();
            $new_period->period = $request->period;
            $new_period->token = Str::random(15);
            $new_period->store_id = Auth::user()->store_id;
            $new_period->price = $request->price;
            $new_period->room_id = $request->room_id;
            $new_period->save();
            //log action
            /*$action = "Created a new Period called ".$new_period->room_name;
            AuditTrail::createLog(Auth::user()->id, $action);*/
            return redirect()->back()->with('success', 'Period successfully created');
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Period could not be created');
        }
    }

    public function editPeriod(Request $request, $token){
        try {
            $this->validate($request, [
                'period' => 'bail|required',
                'price' => 'bail|required',
                'room_id' => 'bail|required',
            ]);
            $check_period = Period::where('token', $token)->first();
            if ($check_period){
                $check_period->period = $request->period;
                $check_period->token = Str::random(15);
                $check_period->price = $request->price;
                $check_period->room_id = $request->room_id;
                $check_period->save();
                return redirect()->back()->with('success', 'Period Details Successfully Updated');
            }
            else{
                return redirect()->back()->with('failure', 'Period does not Exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Period could not be Edited');
        }
    }
}
