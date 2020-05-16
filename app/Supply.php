<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $fillable = [
        'qty', 'product_id', 'user_id' , 'unit_price', 'price',
        'receipt_no',  'token'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->hasMany(User::class);
    }
}
