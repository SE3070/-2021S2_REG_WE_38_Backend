<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalPassengers extends Model
{
    use HasFactory;

    protected $table = "local_passengers";
    protected $guarded = ['*'];

    public function passenger(){
        return $this->belongsTo(Passenger::class);
    }

    public function localPassengerRoutines(){
        return $this->hasMany(LocalPassengerRoutines::class);
    }
}
