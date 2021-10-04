<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    private static $obj;
    protected $table = "routes";
    protected $guarded = ['*'];

    private final function __contruct() {

    }

    public static function getRoute() {
        if (!isset(self::$obj)) {
            self::$obj = new Route();
        }
        return self::$obj;
    }
}
