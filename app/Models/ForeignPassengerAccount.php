<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignPassengerAccount extends Model
{
    use HasFactory;

    private static $obj;
    protected $table = 'foreign_passenger_accounts';
    protected $guarded = ['*'];

    private final function __construct() {

    }

    public static function getForeignPassengerAccount() {
        if (!isset(self::$obj)) {
            self::$obj = new ForeignPassengerAccount();
        }
         
        return self::$obj;
    }

    public function foreignPassenger(){
        return $this->belongsTo(ForeignPassenger::class);
    }
}
