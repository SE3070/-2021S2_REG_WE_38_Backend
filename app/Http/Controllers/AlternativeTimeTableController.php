<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use Illuminate\Support\Facades\DB;
use App\Models\AlternativeTimeTable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AlternativeTimeTableController extends Controller
{
    public function createAlternativeTimeTable(Request $request, $id){
        try {
           $validator = validator::make($request->all(), [
                "b_number" => "required",
           ]);

           if($validator->fails()){
                return response()->json(['message' => 'Alternative time table validation fails']);    
           }else {
                $bus = DB::table('buses')->where('bus_number', request('b_number'))->first();
                $timetable = DB::table('time_tables')->where('bus_id', $bus->id)->first();
                $altTimeTable = DB::table('alternative_time_tables')->where('bus_id', $bus->id)->first();
                echo('what the fuck');

                if(!empty($timetable) && !empty($altTimeTable)){
                    if($timetable->bus_id == $bus->id && $altTimeTable->bus_id == $bus->id){
                        return response()->json(['message' => 'Bus is already taken by both'], 403);
                    }
                } else if(!empty($timetable)){
                    if($timetable->bus_id == $bus->id){
                        return response()->json(['message' => 'Bus is already taken by time table'], 403);
                    }
                } else if(!empty($altTimeTable)){
                    if($altTimeTable->bus_id == $bus->id){
                        return response()->json(['message' => 'Bus is already taken by alternative time table'], 403);
                    }
                }else{
                    $alterTable = AlterNativeTimeTable::getAlternativeTimeTable();
                    $alterTable->bus_id = $bus->id;
                    $alterTable->timetable_id = $id;
                    $alterTable->save();
                }
                return $alterTable;
           }

        } catch (Exception $e) {
            return response()->json(['message' => 'Foreign passenger routings validation fails']);
        }
    }
}
