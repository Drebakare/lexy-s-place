<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'table_name',  'token'
    ];
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
