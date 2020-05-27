<?php

namespace App\Http\Controllers\Auth;

use App\CustomerDetail;
use App\Http\Controllers\Controller;
use App\Membership;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use MongoDB\Driver\Session;

class AuthenticationController extends Controller
{
    public function userRegistration(Request $request){
        $this->validate($request, [
            'password' => 'bail|confirmed|required',
            'first_name' => 'bail|required',
            'last_name' => 'bail|required',
            'dob' => 'bail|required',
            'email' => 'bail|required|unique:users', // checks for email uniqueness
        ]);
        try {
            $age = User::getDateOfBirth($request->dob); // get user's date of birth
            // check for age limit
            if ($age < 18){
                return redirect()->back()->with('failure', 'Your age is below the age limit');
            }
            // save user details
            User::registerUser($request);
            //create membership
            CustomerDetail::createNewCustomer($request->email);
            //send welcome email to user
            $user = User::where('email', $request->email)->first(); // get user's details

            Mail::to($request->email)->send(new \App\Mail\RegistrationMail($user)); // send email to user

            // login user if registration successful
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $role = Auth::user()->role_id;
                // check role for redirection
                switch ($role){
                    case 1:
                        return redirect(route('user.dashboard'))->with('success', 'Login Successful');
                        break;
                    default:
                        return redirect(route('user.dashboard'))->with('success', 'Login Successful');
                }
            }
            else{
                return  redirect()->back()->with('failure', 'Authentication Failed');
            }
        }
        catch(\Exception $exception){
            return  redirect()->back()->with('failure', $exception->getMessage()); // return error if found
        }
    }

    public function Logout(){
        Auth::logout();
        return redirect(route('homepage'))->with('success', 'Logout Successful');
    }

    public function userLogin(Request $request){
        // validates input
        $this->validate($request, [
           'email' => 'bail|required',
           'password' => 'bail|required'
        ]);
        try {
            // try authentication
            if (Auth::attempt(['email' => $request->email, 'password'=> $request->password])){
                $role = Auth::user()->role_id;
                // check role for redirection
                switch ($role){
                    case 1:
                        if (session()->get('intended_url')){
                            return redirect(route(session()->get('intended_url')))->with('success', 'Login Successful');
                            break;
                        }
                        else{
                            return redirect(route('user.dashboard'))->with('success', 'Login Successful');
                            break;
                        }
                        break;
                    default:
                        return redirect(route('user.dashboard'))->with('success', 'Login Successful');
                }
            }
            else{
                return redirect()->back()->with('failure', 'Email or Password Incorrect');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', $exception->getMessage()); // return back if any error is found during the process
        }
    }

    public function forgotPassword(Request $request){
        $this->validate($request, [
           'email' => 'bail|required'
        ]);
        try {
            $user = User::getUserByEmail($request->email);
            if ($user){
                // send email to user
                Mail::to($request->email)->send(new \App\Mail\forgotPasswordMail($user));
                // return success message
                return  redirect()->back()->with('success', 'A link to change your password is sent to your email address');
            }
            else{
                return  redirect()->back()->with('failure', 'Email does not exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', $exception->getMessage());
        }
    }
    public function changePassword($token){
        try {
            $user = User::where('token', $token)->first();
            if ($user){
                return view('actions.new_password', compact("token"));
            }
            else{
                return  redirect(route('login'))->with('failure', 'Token Expired');
            }
        }
        catch (\Exception $exception){
            return redirect(route('login'))->with('failure', $exception->getMessage());
        }
    }

    public function finalChangePassword(Request $request){
        $this->validate($request, [
            'password' => 'bail|required|confirmed'
        ]);
        try {
            $user = User::where('token', $request->token)->update([
              'password' => bcrypt($request->password),
              'token' => Str::random(15),
            ]);
            if ($user){
                return redirect(route('login'))->with('success', 'Password Successfully Changed');
            }
            else{
                return redirect()->back()->with('failure', 'password could not be changed');
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', $exception->getMessage());
        }

    }

    //set age session

    public function setAgeSession(Request $request){
        $this->validate($request, [
           'dob' => 'bail|required'
        ]);
        try {

            if($request->session()->has('age'))
            {
                return redirect()->back()->with('success', 'Age already Specified');
            }
            else{
                $check_age = User::getDateOfBirth($request->dob);
                if ($check_age < 18){
                    return redirect()->back()->with('failure', 'Your age is below the age limit');
                }
                else{
                    $request->session()->put('age', $check_age);
                    return redirect()->back()->with('success', 'Age Limit Constraint Met, You Can Continue With Your Operation');
                }
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', $exception->getMessage());
        }
    }

    // social media login
    public function redirectToProvider($social){
        try {
            return Socialite::driver($social)->redirect();
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', $exception->getMessage());
        }
    }

    public function handleProviderCallback($social)
    {
        try {
            $user = Socialite::driver($social)->user();
            if ($user->getEmail() != null){
                $check_user = User::where('email', $user->getEmail())->first();
                if ($check_user){
                    Auth::loginUsingId($check_user->id);
                    $role = Auth::user()->role_id;
                    // check role for redirection
                    switch ($role){
                        case 1:
                            return redirect(route('user.dashboard'))->with('success', 'Login Successful');
                            break;
                        default:
                            return redirect(route('user.dashboard'))->with('success', 'Login Successful');
                    }
                }
                else{
                    User::newUser($user->getEmail(), $user->getEmail(), $user->getName());
                    CustomerDetail::createNewCustomer($user->getEmail());
                    if (Auth::attempt(['email' => $user->getEmail(), 'password' => $user->getEmail()])) {
                        return redirect(route('user.dashboard'))->with('success', 'Authentication Successful');
                    }
                    else{
                        return redirect(route('login'))->with('failure', 'Account Could Not Be Verified');
                    }
                }
            }
            else{
                return redirect(route('login'))->with('failure', 'Account Could Not Be Verified');
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', $exception->getMessage());
        }

        // $user->token;
    }
}
