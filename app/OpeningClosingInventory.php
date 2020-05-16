<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpeningClosingInventory extends Model
{
    protected $fillable = [
        'product_id', 'opening_inventory' , 'supplies', 'transfer', 'closing_inventory',
        'total_closing_inventory', 'token'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
