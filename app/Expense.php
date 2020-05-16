<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'user_id', 'qty', 'receipt_no' , 'price', 'item_or_service', 'token'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
