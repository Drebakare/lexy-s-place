<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpeningClosingEmpty extends Model
{
    protected $fillable = [
         'product_id', 'opening_empties' , 'supplies', 'total_opening_empties',
        'total_closing_empties', 'empties_out',  'token'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
