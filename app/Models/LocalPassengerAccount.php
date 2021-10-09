<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalPassengerAccount extends Model
{
    use HasFactory;

    private static $obj;
    protected $table = "local_passenger_accounts";
    protected $guarded = ['*'];

    private final function __construct() {

    }

    public static function getLocalPassengerAccount () {
        if(!isset(self::$obj)){
            self::$obj = new LocalPassengerAccount();
        }
        return self::$obj;
    }

    public function localPassenger(){
        return $this->belongsTo(LocalPassenger::class);
    }
}
