<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmptyOut extends Model
{
    protected $fillable = [
        'user_id', 'receipt_no', 'qty', 'product_id' , 'token'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
