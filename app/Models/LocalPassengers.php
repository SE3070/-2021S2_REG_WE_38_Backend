<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalPassengers extends Model
{
    use HasFactory;

    private static $obj;
    protected $table = "local_passengers";
    protected $guarded = ['*'];

    private final function __construct() {

    }

    public static function getLocalPassenger() {
        if (!isset(self::$obj)) {
            self::$obj = new LocalPassengers();
        }
         
        return self::$obj;
    }

    public function passenger(){
        return $this->belongsTo(Passenger::class);
    }

    public function localPassengerRoutines(){
        return $this->hasMany(LocalPassengerRoutines::class);
    }

    public function localPassengerAccount(){
        return $this->hasOne(LocalPassengerAccount::class);
    }
}
