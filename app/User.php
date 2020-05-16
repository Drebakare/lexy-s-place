<?php

namespace App;

use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'role_id', 'email', 'password', 'DOB'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function audits(){
        return $this->hasMany(AuditTrail::class);
    }
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    public function customerDetail(){
        return $this->hasOne(CustomerDetail::class);
    }
    public function emptyOuts(){
        return $this->hasMany(EmptyOut::class);
    }
    public function expenses(){
        return $this->hasMany(Expense::class);
    }
    public function inventorySupplies(){
        return $this->hasMany(InventorySupply::class);
    }
    public function inventoryTransfers(){
        return $this->hasMany(InventoryTransfer::class);
    }
    public function items(){
        return $this->hasMany(Item::class);
    }
    public function itemInventories(){
        return $this->hasMany(ItemInventory::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function promos(){
        return $this->hasMany(Promo::class);
    }
    public function supplies(){
        return $this->hasMany(Supply::class);
    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }

    public static  function getDateOfBirth($date_of_birth){
        $years = Carbon::parse($date_of_birth)->age;
        return $years;
    }

    public static function registerUser($request){
        $user = User::create([
           'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'DOB' => $request->dob,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 1
        ]);
    }

    public static function getUserByEmail($email){
        return User::where('email', $email)->first();
    }

    public static function newUser($email, $password, $name = null){
        $register_user = User::create([
            'role' => 1,
            'password' => bcrypt($password),
            'email' => $email,
            'last_name' => $name == null ? null : $name,
            'DOB' => session('age')
        ]);
    }
}
