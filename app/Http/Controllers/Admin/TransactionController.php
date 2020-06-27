<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Period;
use App\Room;
use App\SubscriptionList;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function viewTransactions(){
        if (Auth::user()->store_id == null){
            $transactions = Transaction::get();
        }
        else{
            $transactions = Transaction::where(['store_id' => Auth::user()->store_id])->get();
        }
        return view('Admin.Actions.view-transactions', compact('transactions'));
    }

    public function viewSubscription(){
        if (Auth::user()->store_id == null){
            $lists = SubscriptionList::get();
        }
        else{
            $lists = SubscriptionList::where(['store_id' => Auth::user()->store_id])->get();
        }
        return view('Admin.Actions.view-subscription', compact('lists'));
    }
}
