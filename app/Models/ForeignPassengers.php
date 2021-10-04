<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignPassengers extends Model
{
    use HasFactory;

    private static $obj;
    protected $table = "foreign_passengers";
    protected $guarded = ['*'];

    private final function __construct() {
        
    }

    public static function getForeignPassenger() {
        if (!isset(self::$obj)) {
            self::$obj = new ForeignPassengers();
        }
         
        return self::$obj;
    }

    public function passenger(){
        return $this->belongsTo(Passenger::class);
    }

    public function foreignPassengerRoutines() {
        return $this->hasMany(ForeignPassengerRoutines::class);
    }
}
