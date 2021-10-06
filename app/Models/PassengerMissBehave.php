<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassengerMissBehave extends Model
{
    use HasFactory;
    protected $table = "passenger_miss_behaves";
    protected $guarded = ['*'];
}
