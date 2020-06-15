<?php

namespace App\Http\Controllers\Admin;

use App\AuditTrail;
use App\CustomerDetail;
use App\Http\Controllers\Controller;
use App\Membership;
use App\Role;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
        $users = User::get();
        $memberships = Membership::get();
        $action = "Viewed User Management Page";
        AuditTrail::createLog(Auth::user()->id, $action );
        return view('Admin.Actions.view-users', compact('users', 'memberships'));
    }

    public function editMembershipDetails(Request $request, $token){
        try {
                $this->validate($request, [
                   'membership_level' => 'bail|required'
                ]);
            $user = User::getUserByToken($token);
            if ($user){
               $customer_details = CustomerDetail::getUserDetailsById($user->id);
               $customer_details -> membership_id = $request->membership_level;
               $customer_details->save();
                $action = "Changed ".$user->email. " Membership to " . $customer_details -> membership ->membership_name;
                AuditTrail::createLog(Auth::user()->id, $action );
                return redirect()->back()->with('success', "User's Membership Level Updated Successfully");
            }
            else{
                return redirect()->back()->with('failure', 'User Could Not Be Found');
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', "Action could not be performed");
        }
    }

    public function viewUser($token){
        try {
            $user = User::getUserByToken($token);

            if ($user){
                $action = " Viewed " . $user->email . " Details";
                AuditTrail::createLog(Auth::user()->id, $action );
                return view('Admin.Actions.view-user-details', compact('user'));
            }
            else{
                return redirect()->back()->with('failure', 'User Could Not Be Found');
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', "Action could not be performed");
        }
    }

    public function suspendUser($token){
        try {
            $user = User::getUserByToken($token);
            if ($user){
                $user->active = 0;
                $user->save();
                $action = " Suspended " . $user->email;
                AuditTrail::createLog(Auth::user()->id, $action );
                return redirect()->back()->with('success', 'User Successfully Suspended');
            }
            else{
                return redirect()->back()->with('failure', 'User Could Not Be Found');
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', "Action could not be performed");
        }
    }

    public function activateUser($token){
        try {
            $user = User::getUserByToken($token);
            if ($user){
                $user->active = 1;
                $user->save();
                $action = " Activated " . $user->email;
                AuditTrail::createLog(Auth::user()->id, $action );
                return redirect()->back()->with('success', 'User Successfully Activated');
            }
            else{
                return redirect()->back()->with('failure', 'User Could Not Be Found');
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', "Action could not be performed");
        }
    }

    public function addUser(){
        $stores = Store::get();
        $roles = Role::get();
        return view('Admin.Actions.add-user', compact('stores', 'roles'));
    }

    public function submitNewUserForm(Request $request){
        $this->validate($request, [
           'first_name' => 'bail|required',
           'last_name' => 'bail|required',
           'dob' => 'bail|required',
           'email' => 'bail|required|unique:users',
           'password' => 'bail|required|confirmed',
           'store' => 'bail|required',
           'role' => 'bail|required',
        ]);
        try {
            $new_user = new User();
            $new_user->first_name = $request->first_name;
            $new_user->last_name = $request->last_name;
            $new_user->email = $request->email;
            $new_user->DOB = $request->dob;
            $new_user->token = Str::random(15);
            $new_user->store_id = $request->store;
            $new_user->role_id = $request->role;
            $new_user->password = bcrypt($request->password);
            $new_user->save();
            $action = " Added ".$new_user->email. " as " . $new_user->role->role. " to ". $new_user->store->store_name;
            AuditTrail::createLog(Auth::user()->id, $action );
            return redirect()->back()->with('success', "User Successfully Added");
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', "Action could not be performed");
        }
    }
}
