<?php

namespace App\Http\Controllers\Product;

use App\Brand;
use App\DrinkType;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
    public function viewProduct($name,$token){
        $product = Product::getProduct($token); // get the specific product being requested for
        $related_products = Product::getRelatedProducts($product->drinkType->id); // get other products based on the product category
        $other_products = Product::getOtherProducts(); // get other other products that are not related
        return view('actions.view_product', compact('product', 'related_products', 'other_products'));
    }

    public function addToCart(Request $request){
        $product = Product::getProduct($request->product_token);
        if (!$product){
            $response = array(
                "status" => false,
                "msg" => "Product Not Found"
            );
            return response()->json($response);
        }
        else{
            $cart = session()->get('cart');
            if (!$cart){
                $cart = [
                    $request->product_token => [
                        "token" => $request->product_token,
                        "name" => $product->name,
                        "quantity" => $request->product_qty,
                        "price" => $product->price,
                    ]
                ];
                session()->put('cart', $cart);
                $total = 0.0 ;
                foreach (session()->get('cart') as $cart){
                    $total = $total + $cart["quantity"] * $cart["price"];
                }
                $response = array(
                    "status" => true,
                    "total_price" => $total,
                    "total_quantity" => count(session()->get('cart')),
                    "info"=> count(session()->get('cart')). "items - N". $total,
                    "msg" => "Product Added To Cart Successfully"
                );
                return response()->json($response);
            }
            else{
                if(isset($cart[$request->product_token])) {
                    $cart[$request->product_token]['quantity'] = $cart[$request->product_token]['quantity'] + $request->product_qty ;
                    session()->put('cart', $cart);
                    $total = 0.0 ;
                    foreach (session()->get('cart') as $cart){
                        $total = $total + $cart["quantity"] * $cart["price"];
                    }
                    $response = array(
                        "status" => true,
                        "total_price" => $total,
                        "total_quantity" => count(session()->get('cart')),
                        "info"=> count(session()->get('cart')). "items - N". $total,
                        "msg" => "Product Added To Cart Successfully"
                    );
                    return response()->json($response);

                }
                else{
                    $cart[$request->product_token] = [
                        "token" => $request->product_token,
                        "name" => $product->name,
                        "quantity" => $request->product_qty,
                        "price" => $product->price,
                    ];
                    session()->put('cart', $cart);
                    $total = 0.0 ;
                    foreach (session()->get('cart') as $cart){
                        $total = $total + $cart["quantity"] * $cart["price"];
                    }
                    $response = array(
                        "status" => true,
                        "total_price" => $total,
                        "total_quantity" => count(session()->get('cart')),
                        "info"=> count(session()->get('cart')). "" . " items - N ". "". $total,
                        "msg" => "Product Added To Cart Successfully"
                    );
                    return response()->json($response);
                }

            }
        }
    }
    public function searchProducts(Request $request){
        $status = false;
        $products = array();
        // check if search keyword exist
        if ($request->keyword ==  null ) {
            //get all products and paginate them
            $products = Product::getAllProducts();
        }
        else{
            //search for keyword before breaking it down
            $searched_result = Product::getProductByName($request->keyword);
            if (!empty($searched_result)){
                foreach($searched_result as $result){
                    array_push($products , $result);
                }
            }

            //break keyword into smaller words expecially when keyword is a sentence
            $words = explode(' ', $request->keyword);

            // loop through words  and remove any word that has a length less than 3
            foreach ($words as $key => $word){
                if(strlen($word)<3){
                    unset($words[$key]);
                }
            }
            // loop through word again and search for products with  a similar name
            foreach ($words as $key => $word){
                $searched_products = Product::getProductByName($word);
                if ($searched_products){
                    foreach ($searched_products as $searched_product){
                        array_push($products , $searched_product);
                    }
                }
            }
            if (count($products ) > 0) {
                $searched_word = session()->get('keyword');
                if ($searched_word){
                    session()->put('keyword', $request->keyword);
                }
                else{
                    session()->put('keyword', $request->keyword);
                }
            }
        }
        // get all products if the product search results to no product
        if (count($products ) == 0) {
            $products = Product::getAllProducts();
            $status = true;
        }

        //setting user search keyword to keyword
        $keyword = $request->keyword;
        // get categories
        $categories = DrinkType::getAllCategories();
        //get product brands
        $brands = Brand::getAllBrands();

        return view('actions.search', compact('products', 'status' , 'keyword', 'categories', 'brands'));
    }

    public function searchProductsByCategory($category){

        if(URL::previous() == \route('homepage') ){
            if (session()->get('keyword')){
                session()->forget('keyword');
            }
        }
        $keyword = $category;
        $status = false;
        $products = [];
        if (session()->get('keyword')){
            $searched_result = Product::filterProductByCategory(session()->get('keyword'), $category);
            if ($searched_result){
                foreach ( $searched_result as $result){
                    array_push($products , $result);
                }
            }
            //break keyword into smaller words expecially when keyword is a sentence
            $words = explode(' ', session()->get('keyword'));

            // loop through words  and remove any word that has a length less than 3
            foreach ($words as $key => $word){
                if(strlen($word)<3){
                    unset($words[$key]);
                }
            }
            // loop through word again and search for products with  a similar name
            foreach ($words as $key => $word){
                $searched_products = Product::filterProductByCategory($word, $category);
                if ($searched_products){
                    foreach ($searched_products as $searched_product){
                        array_push($products , $searched_product);
                    }
                }
            }
        }
        else{
            $products = Product::getProductByCategory($category);
        }
        if (count($products) == 0){
            if (session()->get('keyword')){
                session()->forget('keyword');
            }
            $products = Product::getAllProducts();
            $status = true;
        }
        // get categories
        $categories = DrinkType::getAllCategories();
        //get product brands
        $brands = Brand::getAllBrands();
        return view('actions.search', compact('products', 'status' , 'keyword', 'categories', 'brands'));
    }
    public function searchProductsByBrand($brand_name){
        $keyword = $brand_name;
        $status = false;
        $products = [];
        if (session()->get('keyword')){
            $searched_result = Product::filterProductByBrand(session()->get('keyword'), $brand_name);
            if ($searched_result){
                foreach ( $searched_result as $result){
                    array_push($products , $result);
                }
            }
            //break keyword into smaller words expecially when keyword is a sentence
            $words = explode(' ', session()->get('keyword'));

            // loop through words  and remove any word that has a length less than 3
            foreach ($words as $key => $word){
                if(strlen($word)<3){
                    unset($words[$key]);
                }
            }
            // loop through word again and search for products with  a similar name
            foreach ($words as $key => $word){
                $searched_products = Product::filterProductByBrand($word, $brand_name);
                if ($searched_products){
                    foreach ($searched_products as $searched_product){
                        array_push($products , $searched_product);
                    }
                }
            }
        }
        else{
            $products = Product::getProductByBrand($brand_name);
        }
        if (count($products) == 0){
            if (session()->get('keyword')){
                session()->forget('keyword');
            }
            $products = Product::getAllProducts();
            $status = true;
        }
        // get categories
        $categories = DrinkType::getAllCategories();
        //get product brands
        $brands = Brand::getAllBrands();
        return view('actions.search', compact('products', 'status' , 'keyword', 'categories', 'brands'));
    }
    public function searchProductsByType($drink_type){
        $keyword = $drink_type;
        $status = false;
        $products = [];
        if (session()->get('keyword')){
            $searched_result = Product::filterProductByType(session()->get('keyword'), $drink_type);
            if ($searched_result){
                foreach ( $searched_result as $result){
                    array_push($products , $result);
                }
            }
            //break keyword into smaller words expecially when keyword is a sentence
            $words = explode(' ', session()->get('keyword'));

            // loop through words  and remove any word that has a length less than 3
            foreach ($words as $key => $word){
                if(strlen($word)<3){
                    unset($words[$key]);
                }
            }
            // loop through word again and search for products with  a similar name
            foreach ($words as $key => $word){
                $searched_products = Product::filterProductByType($word, $drink_type);
                if ($searched_products){
                    foreach ($searched_products as $searched_product){
                        array_push($products , $searched_product);
                    }
                }
            }
        }
        else{
            $products = Product::getProductByType($drink_type);
        }
        if (count($products) == 0){
            if (session()->get('keyword')){
                session()->forget('keyword');
            }
            $products = Product::getAllProducts();
            $status = true;
        }
        // get categories
        $categories = DrinkType::getAllCategories();
        //get product brands
        $brands = Brand::getAllBrands();
        return view('actions.search', compact('products', 'status' , 'keyword', 'categories', 'brands'));
    }

    public function viewProducts(){
        $keyword = 'All Products';
        $status = false;
        $products = Product::getAllProducts();
        if (session()->get('keyword')){
            session()->forget('keyword');
        }
        // get categories
        $categories = DrinkType::getAllCategories();
        //get product brands
        $brands = Brand::getAllBrands();
        return view('actions.search', compact('products', 'status' , 'keyword', 'categories', 'brands'));
    }

    public function viewCart(){
        if(session()->get('cart') && !empty(session()->get('cart'))){
            $total = 0.0;
            foreach (session()->get('cart') as $product){
                $total = $total + $product["quantity"] * $product["price"];
            }
            return view('actions.cart', compact('total'));
        }
        else{
            if (URL::previous() == \route('user.cart') ){
                return redirect(route('homepage'))->with('failure', 'No Product in the Cart');
            }
            return redirect()->back()->with('failure', 'No product in the cart yet, Kindly shop to add product(s) to cart');
        }
    }

    public function updateCart(Request $request){
        $product = Product::getProduct($request->token);
        if (!$product || !session()->get('cart')){
            $response = array(
                "status" => false,
                "msg" => "Product Not Found"
            );
            return response()->json($response);
        }
        $cart = session()->get('cart');
        if ($cart[$request->token]['quantity']){
            $cart[$request->token]['quantity'] = $request->product_qty ;
            session()->put('cart', $cart);
        }
        $total = 0.0 ;
        foreach (session()->get('cart') as $cart){
            $total = $total + $cart["quantity"] * $cart["price"];
        }
        $response = array(
            "status" => true,
            "total_price" => $total,
            "total_quantity" => count(session()->get('cart')),
            "info"=> count(session()->get('cart')). "items - N". $total,
            "msg" => "Product Quantity Successfully updated"
        );
        return response()->json($response);
    }

    public function removeProduct(Request $request){
        if (session()->get('cart')[$request->token]){
            try {
                $cart = session()->get('cart');
                unset($cart[$request->token]);
                session()->put('cart', $cart);
                $total = 0.0 ;
                foreach (session()->get('cart') as $cart){
                    $total = $total + $cart["quantity"] * $cart["price"];
                }
                $response = array(
                    "status" => true,
                    "total_price" => $total,
                    "total_quantity" => count(session()->get('cart')),
                    "info"=> count(session()->get('cart')). "items - N". $total,
                    "msg" => "Product Successfully Removed"
                );
                return response()->json($response);
            }
            catch (\Exception $exception){
                $response = array(
                    "status" => false,
                    "msg" => $exception->getMessage()
                );
                return response()->json($response);
            }

        }
        else{
            $response = array(
                "status" => false,
                "msg" => "Product Does not Exist in the Cart"
            );
            return response()->json($response);
        }

    }

    public function cartCheckout(){
        if (session()->get('intended_url')){
            session()->forget('intended_url');
        }
        if(session()->get('cart') && !empty(session()->get('cart'))){
            $total = 0.0;
            foreach (session()->get('cart') as $product){
                $total = $total + $product["quantity"] * $product["price"];
            }
        }
        else{
            return redirect(route('homepage'))->with('failure', "You do not have any active cart yet");
        }
        return view('actions.checkout', compact('total'));
    }
}
