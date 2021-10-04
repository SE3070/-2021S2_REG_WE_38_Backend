<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignPassengerRoutines extends Model
{
    use HasFactory;

    private static $obj;
    protected $table = "foreign_passenger_routines";
    protected $guarded = ['*'];

    private final function __construct() {
        
    }
     
    public static function getForeignPassengerRoutines() {
        if (!isset(self::$obj)) {
            self::$obj = new ForeignPassengerRoutines();
        }
         
        return self::$obj;
    }

    public function foreignPassengers(){
        return $this->belongsTo(ForeignPassengers::class);
    }
}
