<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionList extends Model
{
    protected $fillable = [
      'user_id', 'amount', 'status'
    ];
}
