<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'brand_id', 'name', 'price' , 'drink_type_id', 'alcoholic',
        'has_empty', 'image',  'token', 'description'
    ];

    public function emptyOuts(){
        return $this->hasMany(EmptyOut::class);
    }
    public function openingClosingEmpties(){
        return $this->hasMany(OpeningClosingEmpty::class);
    }
    public function openingClosingInventories(){
        return $this->hasMany(OpeningClosingInventory::class);
    }
    public function openingClosingStock(){
        return $this->hasMany(OpeningClosingStock::class);
    }
    public function orderSummaries(){
        return $this->hasMany(OrderSummary::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function drinkType(){
        return $this->belongsTo(DrinkType::class);
    }
    public function promos(){
        return $this->hasMany(Promo::class);
    }
    public function stocks(){
        return $this->hasMany(Stock::class);
    }
    public function supplies(){
        return $this->hasMany(Supply::class);
    }

    public static function getSomeProducts(){
        //select all products but check if its still in stock
        $products = Product::whereHas('stocks', function($query){
            $query->where('qty','>' , 0)
            ->where('store_id', session()->get('check_store_session'));
        })->inRandomOrder()->/*get()*/paginate(3);

        // limit the no of products to be displayed to 20
        /*if (count($products) > 2){
            $products = $products->take(20);
        }*/
        return $products;
    }

    public static function getProduct($token){
        // get product using the product token
        return Product::where('token', $token)->first();
    }

    public static function getRelatedProducts($category_id){
        //select all other products with the same category but in random order
        $products = Product::whereHas('stocks', function($query){
            $query->where('qty','>' , 0);
        })->where('drink_type_id', $category_id)->inRandomOrder()->get();

        // pick on 8 out the pproducts if the total number is greater than 8
        if (count($products) > 8){
            $products = $products->take(8);
        }
        // return the products back to the user
        return $products;
    }

    public static function getOtherProducts(){
        //select all other products with the same category but in random order
        $products = Product::whereHas('stocks', function($query){
            $query->where('qty','>' , 0);
        })->inRandomOrder()->get();

        // pick on 8 out the pproducts if the total number is greater than 8
        if (count($products) > 8){
            $products = $products->take(8);
        }
        // return the products back to the user
        return $products;
    }

    public static function getAllProducts(){
        //get all product that are still in stock and the response should be paginated
        $products = Product::whereHas('stocks', function($query){
            $query->where('qty','>' , 0);
        })->inRandomOrder()->paginate(3);
        return $products;

    }

    public static function getProductByName($name){
        //search for a product that has a name close to the name being searched for
        $products = Product::whereHas('stocks', function($query){
            $query->where('qty','>' , 0);
        })->where('name', 'LIKE', '%' . $name . '%')->inRandomOrder()->get();
        return $products;
    }

    public static function getProductByCategory($category){
        //retrieve product drink type to get the id
        $drink_category = DrinkType::where('name', $category)->first();
        // search products for drink type match
        $products = Product::whereHas('stocks', function($query){
            $query->where('qty','>' , 0);
        })->where('drink_type_id', $drink_category->id)->inRandomOrder()->paginate(3);
        //return result
        return $products;
    }

    public static function filterProductByCategory($word, $category){
        $category = DrinkType::where('name', $category)->first();
        $products = Product::whereHas('stocks', function($query){
            $query->where('qty','>' , 0);
        })->where('drink_type_id', $category->id)
            ->where('name', 'LIKE', '%' . $word . '%')
            ->inRandomOrder()->get();
        return $products;
    }

    public static function filterProductByBrand($word, $brand_name){
        $brand = Brand::where('brand_name', $brand_name)->first();
        $products = Product::whereHas('stocks', function($query){
            $query->where('qty','>' , 0);
        })->where('brand_id', $brand->id)
            ->where('name', 'LIKE', '%' . $word . '%')
            ->inRandomOrder()->get();
        return $products;
    }

    public static function filterProductByType($word, $drink_type){
        $value = $drink_type == 'alcoholic' ? 1 : 0 ;
        $products = Product::whereHas('stocks', function($query){
            $query->where('qty','>' , 0);
        })->where('alcoholic', $value)
            ->where('name', 'LIKE', '%' . $word . '%')
            ->inRandomOrder()->get();
        return $products;
    }

    public static function getProductByBrand($brand_name){
        //retrieve product drink type to get the id
        $brand = Brand::where('brand_name', $brand_name)->first();
        // search products for drink type match
        $products = Product::whereHas('stocks', function($query){
            $query->where('qty','>' , 0);
        })->where('brand_id', $brand->id)->inRandomOrder()->paginate(3);
        //return result
        return $products;
    }

    public static function getProductByType($drink_type){
        $value = $drink_type == 'alcoholic' ? 1 : 0 ;
        // search products for drink type match
        $products = Product::whereHas('stocks', function($query){
            $query->where('qty','>' , 0);
        })->where('alcoholic', $value)->inRandomOrder()->paginate(3);
        //return result
        return $products;
    }

}
