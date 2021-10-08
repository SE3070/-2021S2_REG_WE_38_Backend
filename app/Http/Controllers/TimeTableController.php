<?php

namespace App\Http\Controllers;

use \stdClass;
use Illuminate\Http\Request;
use App\Models\TimeTable;
use App\Models\Bus;
use App\Models\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TimeTableController extends Controller
{
    public function createTimeTable(Request $request){
        try {
            $validator = validator::make($request->all(), [
                "time" => "required",
                "r_number" => "required",
                "b_number" => "required"
            ]);
            if($validator->fails()){
                return response()->json(['message' => 'Time Table validation failed'], 403);
            } else {
                $bus = DB::table('buses')->where('bus_number', request('b_number'))->first();
                $route = DB::table('routes')->where('r_number', request('r_number'))->first();

                if($bus && $route){
                    $timetable = TimeTable::getTimeTable();
                    $timetable->time = request('time');
                    $timetable->route_id = $route->id;
                    $timetable->bus_id = $bus->id;
                    $timetable->save();
                } else {
                    return response()->json(['message' => 'Something went wrong']);
                }
                
                return $timetable;
            }
        } catch (Exception $e) {
             return response()->json(['message' => 'Something went wrong', 'error' => $e], 500);
        }
    }

    public function getTimeTables(Request $request){
        try{
            $timetable = DB::table('time_tables')
            ->join('buses', 'time_tables.bus_id', '=', 'buses.id')
            ->join('routes', 'time_tables.route_id', '=', 'routes.id')
            ->select('time_tables.*', 'buses.bus_number', 'routes.r_number')
            ->get();

            return $timetable;
            
        }catch(Exception $e){

        }
    }
}
