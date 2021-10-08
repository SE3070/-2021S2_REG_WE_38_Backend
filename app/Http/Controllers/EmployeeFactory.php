<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspector;
use App\Models\Driver;

class EmployeeFactory {

    /**
     * This function is using to create Inspector object
     * @return new Inspector()
     */
    public static function setInspector(){
        return new Inspector();
    }

    /**
     * This function is using to create Driver object
     * 
     */
    public static function setDriver(){
        return new Driver();
    }
}
