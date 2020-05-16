<?php

namespace App\Http\Controllers\User;

use App\DrinkCategory;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function Homepage(){
        $products = Product::getSomeProducts();
        $categories = DrinkCategory::getCategories();
       // $partitioned_products = Product::partitionedProduct($products);
        //dd($products);
        return view('homepage', compact('products', 'categories'));
    }
}
