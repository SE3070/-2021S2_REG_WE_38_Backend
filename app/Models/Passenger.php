<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $table = "passengers";
    protected $guarded = ['*'];

    public function passengerAccounts(){
        return $this->hasOne(PassengerAccount::class);
    }

    public function localPassengers(){
        return $this->hasMany(LocalPassengers::class);
    }

    public function foreignPassengers(){
        return $this->hasMany(ForeignPassengers::class);
    }
}
