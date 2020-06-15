<?php

namespace App\Http\Controllers\Admin;

use App\AuditTrail;
use App\Brand;
use App\DrinkCategory;
use App\Http\Controllers\Controller;
use App\Product;
use App\Stock;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function addProductBrand(){
        $brands = Brand::get();
        return view('Admin.Actions.create-product-brand', compact('brands'));
    }

    public function createBrand(Request $request){
        $this->validate($request, [
            'brand_name' => 'bail|required|unique:brands',
        ]);
        try {
            //create a new store
            $new_brand = new Brand();
            $new_brand->brand_name = $request->brand_name;
            $new_brand->token = Str::random(15);
            $new_brand->save();
            //log action
            $action = "Created a new Brand called ".$new_brand->brand_name;
            AuditTrail::createLog(Auth::user()->id, $action );

            return redirect()->back()->with('success', 'Brand successfully created');
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Brand could not be created');
        }
    }

    public function editBrand(Request $request, $token){
        $this->validate($request, [
            'brand_name' => 'bail|required',
        ]);
        try {
            $check_brand = Brand::checkBrand($token);
            if ($check_brand){
                $update_brand = Brand::updatebrandDetails($request, $token);
                if ($update_brand){
                    $action = "Updated Brand to ".$request->brand_name;
                    AuditTrail::createLog(Auth::user()->id, $action );
                    return redirect()->back()->with('success', 'Brand Details Successfully Updated');
                }
                else{
                    return redirect()->back()->with('failure', 'Brand could not be Updated');
                }
            }
            else{
                return redirect()->back()->with('failure', 'Brand does not Exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Brand could not be Edited');
        }
    }

    public function addProductCategory(){
        $categories = DrinkCategory::get();
        return view('Admin.Actions.create-product-category', compact('categories'));
    }

    public function createCategory(Request $request){
        $this->validate($request, [
            'name' => 'bail|required|unique:drink_categories',
        ]);
        try {
            //create a new store
            $new_category = new DrinkCategory();
            $new_category->name = $request->name;
            $new_category->token = Str::random(15);
            $new_category->save();
            //log action
            $action = "Created a new Category called ".$new_category->name;
            AuditTrail::createLog(Auth::user()->id, $action );

            return redirect()->back()->with('success', 'Category successfully created');
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Category could not be created');
        }
    }

    public function editCategory(Request $request, $token){
        $this->validate($request, [
            'name' => 'bail|required',
        ]);
        try {
            $check_category = DrinkCategory::checkCategory($token);
            if ($check_category){
                $update_brand = Brand::updatebrandDetails($request, $token);
                if ($update_brand){
                    $action = "Updated Brand to ".$request->brand_name;
                    AuditTrail::createLog(Auth::user()->id, $action );
                    return redirect()->back()->with('success', 'Brand Details Successfully Updated');
                }
                else{
                    return redirect()->back()->with('failure', 'Brand could not be Updated');
                }
            }
            else{
                return redirect()->back()->with('failure', 'Brand does not Exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Brand could not be Edited');
        }
    }
}
