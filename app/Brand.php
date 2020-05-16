<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
