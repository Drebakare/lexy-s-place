<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id', 'name', 'token'
    ];

    public function inventorySupplies(){
        return $this->hasMany(InventorySupply::class);
    }
    public function inventoryTransfers(){
        return $this->hasMany(InventoryTransfer::class);
    }
    public function itemInventories(){
        return $this->hasMany(ItemInventory::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
