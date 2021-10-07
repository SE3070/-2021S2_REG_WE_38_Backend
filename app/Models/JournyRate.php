<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournyRate extends Model
{
    use HasFactory;

    protected $table = 'journy_rates';
    protected $guarded  = ['*'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
