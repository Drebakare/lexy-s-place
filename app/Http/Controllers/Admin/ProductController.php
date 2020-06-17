<?php

namespace App\Http\Controllers\Admin;

use App\AuditTrail;
use App\Brand;
use App\DrinkCategory;
use App\DrinkType;
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
            $new_category->category_image = "Default.png";
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
                $update_category = DrinkCategory::updateCategoryDetails($request, $token);
                if ($update_category){
                    $action = "Updated Category Details to ".$request->name;
                    AuditTrail::createLog(Auth::user()->id, $action );
                    return redirect()->back()->with('success', 'Category Details Successfully Updated');
                }
                else{
                    return redirect()->back()->with('failure', 'Category Details could not be Updated');
                }
            }
            else{
                return redirect()->back()->with('failure', 'Category Details does not Exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Category Details could not be Edited');
        }
    }

    public function addProductType(){
        $categories = DrinkCategory::get();
        $drink_types = DrinkType::get();
        return view('Admin.Actions.create-product-drinktype', compact('categories', 'drink_types'));
    }

    public function createDrinkType(Request $request){
        try {
            if($request->file('image')->getSize() > 100000 )
            {
                return redirect()->back()->with('failure', "Uploaded File Size is Larger than 1mb");
            }
            $this->validate($request, [
                'name' => 'bail|required|unique:drink_types',
                'drink_category' => 'bail|required'
            ]);
            $image_file = $request->file('image');
            $image_name = Product::imageProcesses($image_file);
            $new_drink_type = new DrinkType();
            $new_drink_type->name = $request->name;
            $new_drink_type->category_id = $request->drink_category;
            $new_drink_type->token = Str::random(15);
            $new_drink_type->image = $image_name;
            $new_drink_type->save();

            $action = "Created a new Drink Type called ".$new_drink_type->name;
            AuditTrail::createLog(Auth::user()->id, $action );
            return redirect()->back()->with('success', 'Category successfully created');
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', "Error Creating Drink Type");
        }
    }

    public function editDrinkType(Request $request, $token){
        try {
            if ($request->hasFile('image')){
                if ($request->file('image')->getSize() > 100000) {
                    return redirect()->back()->with('failure', "Uploaded File Size is Larger than 1mb");
                }
            }
            $this->validate($request, [
                'name' => 'bail|required',
                'drink_category' => 'bail|required',
            ]);

            $check_drink = DrinkType::checkDrink($token);
            if ($check_drink){
                $update_drink = DrinkType::where('token', $token)->first();
                if ($request->hasFile('image')){
                    $image_file = $request->file('image');
                    $image_name = Product::imageProcesses($image_file);
                    $update_drink->image = $image_name;
                }
                $update_drink->name = $request->name;
                $update_drink->category_id = $request->drink_category;
                $update_drink->token = Str::random(15);
                $update_drink->save();
                $action = "Updated Drink Type Details to ".$update_drink->name;
                AuditTrail::createLog(Auth::user()->id, $action );

                return redirect()->back()->with('success', 'Drink Type Details successfully created');
            }
            else{
                return redirect()->back()->with('failure', 'Drink Type Details does not Exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Drink Type Details could not be Edited');
        }
    }
}
