<?php

namespace App\Http\Controllers\User;

use App\CustomerDetail;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderSummary;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function Dashboard(){
        $orders = Order::getUserOrders();
        $transactions = Transaction::getUserTransactions();
        $customer_details = CustomerDetail::getUserDetails();
        $credits = Transaction::getPaginatedUserTransactions();
        return view('actions.dashboard', compact('orders', 'transactions', 'customer_details', 'credits'));
    }

    public function viewOrder($token){
        $get_order = Order::getOrder($token);
        if ($get_order){
            $summaries = OrderSummary::getOrderSummaries($get_order->id);
            return view('actions.view-order', compact('summaries', 'get_order'));
        }
        else{
            return redirect()->back()->with('failure', 'Order Does not Exist');
        }
    }

    public function updateProfile(Request $request){
        $this->validate($request, [
            'first_name' => 'bail|required',
            'last_name' => 'bail|required'
        ]);
        try {
            $update_details = User::where(['id' => Auth::user()->id])->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);
            if ($update_details){
                return redirect()->back()->with('success', "Account Updated Successfully");
            }
            else{
                return redirect()->back()->with('failure', "Account Could not be Updated");
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', "Account Could not be Updated");
        }
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'old_password' => 'bail|required',
            'password' => 'bail|required|confirmed'
        ]);
        try {
            $user = User::where('id', Auth::user()->id)->first();
            if ($user){
                if (hash::check($request->old_password, $user->password)){
                    $user->update([
                        'password' => $request->password,
                    ]);
                    return redirect()->back()->with('success', 'Password Successfully Changed');
                }
                else{
                    return redirect()->back()->with('failure', 'Password Incorrect');
                }
            }
            else{
                return redirect()->back()->with('failure', 'User Does not Exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Password Could not be Changed');
        }
    }
}
