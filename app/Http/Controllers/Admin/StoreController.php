<?php

namespace App\Http\Controllers\Admin;

use App\AuditTrail;
use App\Http\Controllers\Controller;
use App\Product;
use App\Stock;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function index(){
        $stores = Store::get();

        AuditTrail::createLog(Auth::user()->id, "Opened Create/Edit Store Page " );
        return view('Admin.Actions.create-store', compact('stores'));
    }

    public function createStore(Request $request){
        $this->validate($request, [
            'store_name' => 'bail|required|unique:stores',
            'location' => 'bail|required',
        ]);
        try {
            //create a new store
            $new_store = new Store();
            $new_store->store_name = $request->store_name;
            $new_store->location = $request->location;
            $new_store->token = Str::random(15);
            $new_store->save();
            //log action
            $action = "Created a new store called ".$new_store->store_name;
            AuditTrail::createLog(Auth::user()->id, $action );
            // initialize the products stock
            //get all products
            $products = Product::get();
            //add product to stock for the new store
            foreach ($products as $product){
                $new_stock = new Stock();
                $new_stock->product_id = $product->id;
                $new_stock->qty = 0;
                $new_stock->empties = 0;
                $new_stock->token = Str::random(15);
                $new_stock->store_id = $new_store->id;
                $new_stock->save();
                $action = "Created a new stock for ".$new_stock->product->name. " For " . $new_store->store_name;
                AuditTrail::createLog(Auth::user()->id, $action );
            }
            return redirect()->back()->with('success', 'Store successfully created and stock updated for the store');
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Store could not be created');
        }
    }

    public function editStore(Request $request, $token){
        $this->validate($request, [
           'store_name' => 'bail|required',
           'location' => 'bail|required'
        ]);
        try {
            $check_store = Store::checkStore( $token);
            if ($check_store){
                $update_store = Store::updateStoreDetails($request, $token);
                if ($update_store){
                    $action = "Updated Store to ".$request->store_name;
                    AuditTrail::createLog(Auth::user()->id, $action );
                    return redirect()->back()->with('success', 'Store Details Successfully Updated');
                }
                else{
                    return redirect()->back()->with('failure', 'Store could not be Updated');
                }
            }
            else{
                return redirect()->back()->with('failure', 'Store does not Exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Store could not be Edited');
        }
    }
}
