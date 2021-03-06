<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DrinkCategory extends Model
{
    protected $fillable = [
        'name' , 'token', 'category_image'
    ];

    public function drinkType(){
        return $this->hasMany(DrinkType::class);
    }

    public static function getCategories(){
        $categories = DrinkCategory::get();
        return $categories;
    }

    public static function checkCategory($token){
        $category = DrinkCategory::where('token', $token)->first();
        if ($category){
            return true;
        }
        else{
            return false;
        }
    }
   public static function updateCategoryDetails($request, $token){
       $category = DrinkCategory::where('token', $token)->update([
           'name' => $request->name,
       ]);
       if ($category){
           return true;
       }
       else{
           return false;
       }
   }
}
