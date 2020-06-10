<?php

namespace App\Http\Controllers\Admin;

use App\AuditTrail;
use App\Http\Controllers\Controller;
use App\Order;
use App\Store;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function Dashboard(){
        $users = User::getAllCustomers();
        $stores = Store::get();
        $orders = Order::getFinishedOrders();
        $transactions = Transaction::getSuccessfulTransactions();
        $logs = AuditTrail::getSystemLogs();
        $latest_users = User::getLatestUsers();
        $latest_transactions = Transaction::getLatestTransactions();
        AuditTrail::createLog(Auth::user()->id, "Logged in to Dashboard");
        return view('Admin.Actions.dashboard', compact('users', 'stores', 'orders', 'transactions', 'logs', 'latest_users', 'latest_transactions'));
    }
}
