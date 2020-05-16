<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventorySupply extends Model
{
    protected $fillable = [
        'user_id', 'item_id', 'qty' , 'total_price', 'price',  'token'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function item(){
        return $this->belongsTo(Item::class);
    }
}
