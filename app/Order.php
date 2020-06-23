<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'receipt_no', 'status' , 'total_price', 'table_id',
        'voucher_id', 'membership_id',  'token', 'activated_by'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function activatedBy(){
        return $this->belongsTo(User::class, 'activated_by');
    }
    public function table(){
        return $this->belongsTo(Table::class);
    }
    public function voucher(){
        return $this->belongsTo(Voucher::class);
    }
    public function membership(){
        return $this->belongsTo(Membership::class);
    }
    public function orderSummaries(){
        return $this->hasMany(OrderSummary::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }

    public static function calculateTotalOrderPrice(){
        $total = 0.0;
        foreach (session()->get('cart') as $product){
            $total = $total + $product["quantity"] * $product["price"];
        }
        return $total;
    }

    public static function getUserOrders(){
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id','Desc')->get();
        return $orders;
    }
    public static function getOrder($token){
        $order = Order::where(['user_id'=> Auth::user()->id, 'token' => $token ])->first();
        return $order;
    }
    public static function getFinishedOrders(){
        return Order::where('status', '1')->get();
    }
    public static function calculateTotalSalePrice($sales){
        $total = 0;
        foreach ($sales as $sale){
            $total = $total + ($sale['quantity'] * $sale['price']);
        }
        return $total;
    }
}
