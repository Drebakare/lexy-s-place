<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    protected $fillable = [
        'brand_name', 'token'
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }
    public static function getAllBrands(){
        return Brand::get();
    }

    public static function checkBrand($token){
        $brand = Brand::where('token', $token)->first();
        if ($brand){
            return true;
        }
        else{
            return false;
        }
    }
    public static function updateBrandDetails($request, $token){
        $brand = Brand::where('token', $token)->update([
            'brand_name' => $request->brand_name,
            'token' => Str::random(15)
        ]);
        if ($brand){
            return true;
        }
        else{
            return false;
        }
    }
}
