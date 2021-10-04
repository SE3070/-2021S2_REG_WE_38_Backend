<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassengerAccount extends Model
{
    use HasFactory;

    private static $obj;
    protected $table = "passenger_accounts";
    protected $guarded = ['*'];

    private final function __construct() {

    }

    public static function getPassengerAccount() {
        if (!isset(self::$obj)) {
            self::$obj = new PassengerAccount();
        }
         
        return self::$obj;
    }

    public function passenger(){
        return $this->belongsTo(Passenger::class);
    }
}
