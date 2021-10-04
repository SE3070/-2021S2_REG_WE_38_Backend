<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalPassengerRoutines extends Model
{
    use HasFactory;

    private static $obj;
    protected $table = "local_passenger_routines";
    protected $guarded = ['*'];

    private final function __construct() {
        
    }

    public static function getLocalPassengerRoutines() {
        if (!isset(self::$obj)) {
            self::$obj = new LocalPassengerRoutines();
        }
         
        return self::$obj;
    }

    public function localPassenger(){
        return $this->belongsTo(LocalPassenger::class);
    }

}
