<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
use App\Models\Inspector;

class EmployeeFactory extends Model
{
    use HasFactory;

    public function __constructor(){

    }

    public static function getEmployee($obj){

        if($obj == 'd'){
            return new \Driver();
        } else if($obj == 'i'){
            return new \Inspector();
        }
        return null;
    }
}
