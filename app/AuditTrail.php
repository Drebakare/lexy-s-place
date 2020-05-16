<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $fillable = [
      'user_id', 'action', 'token'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
