<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Stock;
use App\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function raiseOrder(){
        $products = Product::getAgentProducts(Auth::user()->store_id != null ? Auth::user()->store_id : null );
        $tables = Table::where('store_id', Auth::user()->store_id)->first();
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
        $check_stock = false;
        foreach ($request->sales as $sales){
            $stock = Stock::where(['product_id' => $sales['product_id'], 'store_id' => Auth::user()->store_id])->first();
            if ($stock->qty < $sales['quantity']){
                $check_stock = true;
                break;
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

        }
        /*if ($stock){
            $response = array(
                "data" => $stock->qty,
                "status" => true,
                "msg" => "Product Stock Updated"
            );
            return response()->json($response);
        }*/

    }
}
