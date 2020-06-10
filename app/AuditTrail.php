<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AuditTrail extends Model
{
    protected $fillable = [
      'user_id', 'action', 'token'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function createLog($user_id, $action){
        AuditTrail::create([
            'user_id' => $user_id,
            'action' => $action,
            'token' => Str::random(15),
        ]);
    }

    public static function getSystemLogs(){
        $logs = AuditTrail::orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        return $logs;
    }
}
