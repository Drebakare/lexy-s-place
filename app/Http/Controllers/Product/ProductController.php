<?php

namespace App\Http\Controllers\Product;

use App\Brand;
use App\DrinkType;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

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
        $products = [];
        // check if search keyword exist
        if ($request->keyword ==  null ) {
            //get all products and paginate them
            $products = Product::getAllProducts();
        }
        else{
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
                foreach ($searched_products as $searched_product){
                    array_push($products , $searched_product);
                }
            }
            // get all products if the product search results to no product
            if (count($products ) == 0) {
                $products = Product::getAllProducts();
                $status = true;
            }
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
        $keyword = $category;
        $status = false;
        $products = Product::getProductByCategory($category);
        if (count($products) == 0){
            $products = Product::getAllProducts();
            $status = true;
        }
        // get categories
        $categories = DrinkType::getAllCategories();
        //get product brands
        $brands = Brand::getAllBrands();
        return view('actions.search', compact('products', 'status' , 'keyword', 'categories', 'brands'));
    }
}
