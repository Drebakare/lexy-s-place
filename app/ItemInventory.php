<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemInventory extends Model
{
    protected $fillable = [
        'user_id', 'item_id', 'qty' ,  'token'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function item(){
        return $this->belongsTo(Item::class);
    }
}
