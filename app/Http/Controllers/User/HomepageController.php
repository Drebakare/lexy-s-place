<?php

namespace App\Http\Controllers\User;

use App\DrinkCategory;
use App\DrinkType;
use App\Http\Controllers\Controller;
use App\Http\Middleware\checkStoreSession;
use App\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{

    public function Homepage(){
        if (!session()->get('check_store_session')){
            return view('set_session')->with('Kindly select the store you dealing with');
        }
        $products = Product::getSomeProducts();
        $categories = DrinkType::getAllCategories();
        return view('homepage', compact('products', 'categories'));
    }
    public function displayForm(){

        if (session()->get('check_store_session')){
            return redirect(route('homepage'));
        }
        else{
            return view('set_session');
        }
    }

    public function setStoreSession(Request $request){
        $this->validate($request, [
            'store' => 'bail|required'
        ]);
        try {
            if($request->session()->has('check_store_session'))
            {
                $request->session()->put('check_store_session', $request->store);
                if (\session()->get('cart')){
                    $request->session()->forget('cart');
                }
                return redirect(route('homepage'))->with('success', 'Store Updated Successfully');
            }
            else{
                $request->session()->put('check_store_session', $request->store);
                return redirect()->back()->with('success', 'Store Information Successfully Set');

            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', $exception->getMessage());
        }
    }

}
