<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    private static $obj;
    protected $table = "buses";
    protected $guarded = ['*'];

    private final function __construct() {
        
    }

    public static function getBus(){
        if(!isset(self::$obj)){
            self::$obj = new Bus();
        }
        return self::$obj;
    }

}
