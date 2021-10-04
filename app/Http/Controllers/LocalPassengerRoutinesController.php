<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passenger;
use App\Models\LocalPassengerRoutines;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LocalPassengerRoutinesController extends Controller
{
    /**
     * This function is using to store local passenger's routines
     * 
     * @param request
     * @return json
     * 
     * @see getLocalPassengerRoutines()
     */
    public function createLocalPassengerRoutines(Request $request) {
        try {
            $validator = validator::make($request->all(), [
                "nic" => "required",
                "start_time" =>"required",
                "start_des" => "required",
                "end_des" => "required",
                "distance"  => "required",
                "amount"  => "required"
            ]);
    
            if($validator->fails()){
                return response()->json(['message' => 'local passenger routings validation fails']);
            } else {
    
                $localPassenger = DB::table('local_passengers')->where('nic', request('nic') )->first();
                echo($localPassenger->id);
    
                if($localPassenger->id){
                    $localPsngrRoutine = LocalPassengerRoutines::getLocalPassengerRoutines();
                    $localPsngrRoutine->start_time = request('start_time');
                    $localPsngrRoutine->end_time = request('end_time');
                    $localPsngrRoutine->start_des = request('start_des');
                    $localPsngrRoutine->end_des = request('end_des');
                    $localPsngrRoutine->distance = request('distance');
                    $localPsngrRoutine->amount = request('amount');
                    $localPsngrRoutine->psngr_id = $localPassenger->id;
                    $localPsngrRoutine->save();
                    
                }else {
                    return response()->json(['message' => 'Passenger is not found', 'error' => $e], 403);
                }
                return response()->json(['local_passenger_routine' => $localPsngrRoutine], 201);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong', 'error' => $e], 500);
        }   
    }   
}
