<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'receipt_no', 'status' , 'total_price', 'table_id',
        'voucher_id', 'membership_id',  'token'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function table_id(){
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

    public static function calculateTotalOrderPrice(){
        $total = 0.0;
        foreach (session()->get('cart') as $product){
            $total = $total + $product["quantity"] * $product["price"];
        }
        return $total;
    }
}
