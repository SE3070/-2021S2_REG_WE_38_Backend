<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForeignPassengerController extends Controller
{
    public function getForeignPassengerHistory(){
        try{
            $foreignHistory = DB::table('foreign_passenger_routines')->get();
            return $foreignHistory;
        }catch(Exception $e){
            return response()->json(['message' => 'Something went wrong']);
        }
    }

    public function getLocalPassengerHistory(){
        try{
            $localHistory = DB::table('local_passenger_routines')->get();
            return $localHistory;
        }catch(Exception $e){
            return response()->json(['message' => 'Something went wrong']);
        }
    }
}
