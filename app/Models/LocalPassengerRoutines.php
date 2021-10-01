<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalPassengerRoutines extends Model
{
    use HasFactory;

    protected $table = "local_passenger_routines";
    protected $guarded = ['*'];

    public function localPassenger(){
        return $this->belongsTo(LocalPassenger::class);
    }

}
