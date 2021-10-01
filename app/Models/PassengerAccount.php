<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassengerAccount extends Model
{
    use HasFactory;

    protected $table = "passenger_accounts";
    protected $guarded = ['*'];

    public function passenger(){
        return $this->belongsTo(Passenger::class);
    }
}
