<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function raiseOrder(){
        $products = Product::getAgentProducts(Auth::user()->store_id != null ? Auth::user()->store_id : null );
        return view('Admin.Actions.raise-order', compact('products'));
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
}
