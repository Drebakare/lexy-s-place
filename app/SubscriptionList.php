<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SubscriptionList extends Model
{
    protected $fillable = [
      'user_id', 'amount', 'status', 'authorization_key'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function createOrUpdate($authorization_key){
        $check_user = SubscriptionList::where('user_id', Auth::user()->id)->first();
        if ($check_user){
            $check_user->status = 1;
            $check_user->authorization_key = Crypt::encryptString($authorization_key);
            $check_user->save();
        }
        else{
            SubscriptionList::create([
               'user_id' => Auth::user()->id,
                'authorization_key' => Crypt::encryptString($authorization_key)
            ]);
        }
        return Crypt::decryptString($check_user->authorization_key);
    }

    public static function getActiveUsers(){
        return SubscriptionList::where('status', 1)->get();
    }
}
