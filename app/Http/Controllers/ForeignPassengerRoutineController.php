<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForeignPassengerRoutines;
use App\Models\ForeignPassengerAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ForeignPassengerRoutineController extends Controller
{
    public function createForeignPassengerRoutines(Request $request) {
        try {
            $validator = validator::make($request->all(), [
                "passport" => "required",
                "start_time" =>"required",
                "start_des" => "required",
                "end_des" => "required",
                "distance"  => "required",
                "amount"  => "required"
            ]);
    
            if($validator->fails()){
                return response()->json(['message' => 'Foreign passenger routings validation fails']);
            } else {
    
                $foreignPassenger = DB::table('foreign_passengers')->where('passport', request('passport') )->first();
                $currentBalance = DB::table('foreign_passenger_accounts')->where('psngr_id', $foreignPassenger->id)->value('balance');

                if($foreignPassenger->passport){
                    if($currentBalance > 0){
                        $foreignPsngrRoutine = ForeignPassengerRoutines::getForeignPassengerRoutines();
                        $foreignPsngrRoutine->start_time = request('start_time');
                        $foreignPsngrRoutine->end_time = request('end_time');
                        $foreignPsngrRoutine->start_des = request('start_des');
                        $foreignPsngrRoutine->end_des = request('end_des');
                        $foreignPsngrRoutine->distance = request('distance');
                        $foreignPsngrRoutine->amount = request('amount');
                        $foreignPsngrRoutine->psngr_id = $foreignPassenger->id;
                        $foreignPsngrRoutine->save();
    
                        $newBalance = $currentBalance - request('amount');

                        $affected = DB::table('foreign_passenger_accounts')->where('psngr_id', $foreignPassenger->id)->update(['balance' => $newBalance]);
                    }else {
                        return response()->json(['message' => 'Your balance is insufficient']);
                    }
                }else {
                    return response()->json(['message' => 'Passenger is not found', 'error' => $e], 403);
                }
                return $foreignPsngrRoutine;
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong']);

        }
    }

}
