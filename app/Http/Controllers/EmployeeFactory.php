<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspector;
use App\Models\Driver;

class EmployeeFactory {

    public static function setInspector(){
        return new Inspector();
    }

    public static function setDriver(){
        return new Driver();
    }
}
