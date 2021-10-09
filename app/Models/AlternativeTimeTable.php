<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativeTimeTable extends Model
{
    use HasFactory;

    private static $obj;
    protected $table = "alternative_time_tables";
    protected $guarded = ['*'];

    private final function __construct() {

    }

    public static function getAlternativeTimeTable() {
        if(!isset(self::$obj)) {
            self::$obj = new AlternativeTimeTable();
        }

        return self::$obj;
    }

    public function timetable(){
        return $this->belongsTo(TimeTable::class);
    }

    public function bus(){
        return $this->hasOne(Bus::class);
    }

}
