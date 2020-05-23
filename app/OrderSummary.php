<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderSummary extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'qty' , 'price', 'sub_total', 'token'
    ];
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public static function getOrderSummaries($id){
        $summaries = OrderSummary::where('order_id', $id)->get();
        return $summaries;
    }
}
