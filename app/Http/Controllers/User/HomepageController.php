<?php

namespace App\Http\Controllers\User;

use App\DrinkCategory;
use App\DrinkType;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function Homepage(){
        $products = Product::getSomeProducts();
        $categories = DrinkType::getAllCategories();
        return view('homepage', compact('products', 'categories'));
    }
}
