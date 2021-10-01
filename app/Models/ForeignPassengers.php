<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignPassengers extends Model
{
    use HasFactory;

    protected $table = "foreign_passengers";
    protected $guarded = ['*'];

    public function passenger(){
        return $this->belongsTo(Passenger::class);
    }

    public function foreignPassengerRoutines() {
        return $this->hasMany(ForeignPassengerRoutines::class);
    }
}
