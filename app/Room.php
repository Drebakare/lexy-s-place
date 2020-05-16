<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_name',  'token'
    ];
    public function periods(){
        return $this->hasMany(Period::class);
    }
}
