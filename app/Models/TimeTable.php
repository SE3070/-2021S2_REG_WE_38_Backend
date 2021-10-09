<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    private static $obj;
    protected $table = "time_tables";
    protected $guarded = ['*'];

    private final function __construct() {

    }

    public static function getTimeTable(){
        if(!isset(self::$obj)) {
            self::$obj = new TimeTable();
        }
        return self::$obj;
    }

    public function route(){
        return $this->hasOne(Route::class);
    }

    public function bus(){
        return $this->hasOne(Bus::class);
    }

    public function alternativeTimeTables(){
        return $this->hasMany(AlternativeTimeTables::class);
    }

}
