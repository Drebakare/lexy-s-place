<?php

namespace App\Http\Controllers\Admin;

use App\AuditTrail;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderSummary;
use App\Product;
use App\Stock;
use App\Store;
use App\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function raiseOrder(){
        $products = Product::getAgentProducts(Auth::user()->store_id != null ? Auth::user()->store_id : null );
        $tables = Table::where('store_id', Auth::user()->store_id)->get();
        return view('Admin.Actions.raise-order', compact('products', 'tables'));
    }

    public function fetchStock(Request $request){
        $stock = Stock::where(['product_id' => $request->product_id, 'store_id' => $request->store_id])->first();
        if ($stock){
            $response = array(
                "data" => $stock->qty,
                "status" => true,
                "msg" => "Product Stock Updated"
            );
            return response()->json($response);
        }
        else{
            $response = array(
                "status" => false,
                "msg" => "Stock Not Found"
            );
            return response()->json($response);
        }
    }

    public function userRaiseOrder(Request $request){
        try {
            $check_stock = false;
            $failed_products = [];
            foreach ($request->sales as $sales){
                $stock = Stock::where(['product_id' => $sales['product_id'], 'store_id' => Auth::user()->store_id])->first();
                if ($stock->qty < $sales['quantity']){
                    $check_stock = true;
                    array_push($failed_products, $sales['token']);
                }
            }
            if ($check_stock){
                $response = array(
                    "status" => false,
                    "msg" => "One or More Sales Product Quantities is/are more than quantities in Stock, Kindly Cross Check"
                );
                return response()->json($response);
            }
            else{
                $create_order = new order();
                $create_order->user_id = Auth::user()->id;
                $create_order->receipt_no = Str::random(15);
                $create_order->total_price = Order::calculateTotalSalePrice($request->sales);
                $create_order->total_paid = $create_order->total_price;
                $create_order->membership_id = 3;
                $create_order->token = Str::random(15);
                $create_order->table_id = $request->table_id;
                $create_order->store_id = Auth::user()->store_id;
                $create_order->status = 1;
                $create_order->save();

                foreach ($request->sales as $product){
                    $create_order_summaries = new OrderSummary();
                    $get_product = Product::getProduct($product['token']);
                    $create_order_summaries->order_id = $create_order->id;
                    $create_order_summaries->product_id = $get_product->id;
                    $create_order_summaries->qty = $product['quantity'];
                    $create_order_summaries->price = $get_product->price;
                    $create_order_summaries->sub_total = $product['quantity'] * $get_product->price;
                    $create_order_summaries->token = Str::random(15);
                    $create_order_summaries->save();
                }
                $response = array(
                    "status" => true,
                    "msg" => "Sales Successfully Completed"
                );
                return response()->json($response);
            }
        }
        catch (\Exception $exception){
            $response = array(
                "status" => true,
                "msg" => "Error Occur While Processing The Sales, Kindly Retry"
            );
            return response()->json($response);
        }

    }

    public function viewOrders(){
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('Admin.Actions.my-orders', compact('orders'));
    }

    public function viewOrderDetails($token){
        $order = Order::where('token', $token)->first();
        if ($order){
            return view('Admin.Actions.view-order-details', compact('order'));
        }
        else{
            return redirect()->back()->with('failure', 'Order Does not Exist');
        }
    }

    public function viewallOrders(){
        if (Auth::user()->role_id != 2){
            $orders = Order::where('store_id', Auth::user()->store_id)->orderBy('id', 'desc')->get();
        }
        else{
            $orders = Order::orderBy('id', 'desc')->get();
        }
        return view('Admin.Actions.view-orders', compact('orders'));
    }

    public function activateOrder($token){
        $order = Order::where('token', $token)->first();
        if ($order){
            $order->order_status = 1;
            $order->activated_by = Auth::user()->id;
            $order->save();
            return redirect()->back()->with('success', 'Order Status Successfully Updated');
        }
        else{
            return redirect()->back()->with('failure', 'Order Does not Exist');
        }
    }

    public function printOrderDetails($token){
        $order = Order::where('token', $token)->first();
        if ($order){
            return view('Admin.Actions.print-receipt', compact('order'));
        }
        else{
            return redirect()->back()->with('failure', 'Order Does not Exist');
        }
    }

    public function viewActivatedOrders(){
        $orders = Order::where(['activated_by' => Auth::user()->id, 'order_status' => 1])->get();
        return view('Admin.Actions.my-activated-orders', compact('orders'));
    }

    public function viewTables(){
        if (Auth::user()->store_id == null){
            $tables = Table::get();
        }
        else{
            $tables = Table::where(['store_id' => Auth::user()->store_id])->get();
        }
        return view('Admin.Actions.create-tables', compact('tables'));
    }

    public function createTable(Request $request){
        $this->validate($request, [
            'table_name' => 'bail|required|unique:tables',
        ]);
        try {
            //create a new store
            $new_table = new Table();
            $new_table->table_name = $request->table_name;
            $new_table->token = Str::random(15);
            $new_table->store_id = Auth::user()->store_id;
            $new_table->save();
            //log action
            $action = "Created a new Table called ".$new_table->table_name;
            AuditTrail::createLog(Auth::user()->id, $action);
            return redirect()->back()->with('success', 'Table successfully created');
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Table could not be created');
        }
    }

    public function editTable(Request $request, $token){
        $this->validate($request, [
            'table_name' => 'bail|required',
        ]);
        try {
            $check_table = Table::where('token', $token)->first();
            if ($check_table){
                $check_table->table_name = $request->table_name;
                $check_table->token = Str::random(15);
                $check_table->save();

                $action = "Updated Table to ".$request->table_name;
                AuditTrail::createLog(Auth::user()->id, $action );
                return redirect()->back()->with('success', 'Table Details Successfully Updated');
            }
            else{
                return redirect()->back()->with('failure', 'Table does not Exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Table could not be Edited');
        }
    }
}
