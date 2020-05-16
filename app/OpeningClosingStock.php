<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpeningClosingStock extends Model
{
    protected $fillable = [
         'product_id', 'opening_stock' , 'supplies', 'total_opening_stock', 'promo',
        'total_closing_stock', 'sales',  'token'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
