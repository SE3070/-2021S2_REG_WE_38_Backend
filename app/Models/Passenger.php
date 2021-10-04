<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    
    private static $obj;
    protected $table = "passengers";
    protected $guarded = ['*'];

    private final function __construct() {
    }

    public static function getPassenger() {
        if (!isset(self::$obj)) {
            self::$obj = new Passenger();
        }
         
        return self::$obj;
    }

    public function passengerAccounts(){
        return $this->hasOne(PassengerAccount::class);
    }

    public function localPassengers(){
        return $this->hasMany(LocalPassengers::class);
    }

    public function foreignPassengers(){
        return $this->hasMany(ForeignPassengers::class);
    }

}
