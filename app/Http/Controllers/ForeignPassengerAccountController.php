<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForeignPassenger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ForeignPassengerAccountController extends Controller
{
    /**
     * This function is using to reload foreign account
     * 
     * @param request
     * @return affected
     */
    public function foreignReload(Request $request){
        try {
            $validator = validator::make($request->all(), [
                "passport" => "required",
                "tot_amount" => "required"
            ]);
            if($validator->fails()){
                return response()->json(['message' => 'Foreign passenger routings validation fails']);
            }else {
                $foreignPassenger = DB::table('foreign_passengers')->where('passport',  request('passport'))->first();
                $affected = DB::table('foreign_passenger_accounts')->where('psngr_id', $foreignPassenger->id)->update(['tot_amount' => request('tot_amount'), 'balance' => request('tot_amount')]);
            }
            return $affected;
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong']);
        }
    }

    /**
     * This function is using to retrieve foreign passenger's routine history
     * 
     * @param request
     * @return json
     */
    public function getForeignRouteHistory(Request $request){
        try{
            $validator = validator::make($request->all(), [
                'passport' => 'required'
            ]);
            if($validator->fails()){
                return response()->json(['message' => 'History validation fails'], 400);
            }else {
                
                $foreignPassengerId = DB::table('foreign_passengers')->where('passport', request('passport'))->value('id');
                $routines = DB::table('foreign_passenger_routines')->where('psngr_id',$foreignPassengerId)->get();
                return response()->json($routines);
                
            }
        } catch(Exception $e){
            return response()->json(['message' => 'Something went wrong', 'error' => $e], 500);
        }
    }
}
