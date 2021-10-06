<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverCrowdedDetails extends Model
{
    use HasFactory;

    protected $table = 'over_crowded_details';
    protected $guarder = ['*'];
}
