<?php
namespace App\Helpers;
use App\Store;

class Stores
{
    public static function Stores()
    {
        $stores = Store::all();
        session(['stores' => $stores]);
        return $stores;
    }
}
