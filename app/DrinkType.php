<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrinkType extends Model
{
    protected $fillable = [
        'name', 'category_id', 'token'
    ];

    public function drinkCategory(){
        return $this->belongsTo(DrinkCategory::class, 'category_id');
    }
    public function products(){
        return $this->hasMany(Product::class);
    }

    public static function getAllCategories(){
        return DrinkType::get();
    }

    public static function checkDrink($token){
        $drink = DrinkType::where('token', $token)->first();
        if ($drink){
            return true;
        }
        else{
            return false;
        }
    }
}
