<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocalPassenger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LocalPassengerAccountController extends Controller
{
    /**
     * This function is using to reload the amount
     * 
     * @param request
     * @return json
     */
    public function reloadTotalAmount(Request $request) {
        try {
            $validator = validator::make($request->all(), [
                "nic" => "required",
                "tot_amount" => "required",
            ]);
            if($validator->fails()){
                return response()->json(['message' => 'Reload validation failed'], 403);
            }else {
                if(request('nic')){
                    $localPassenger = DB::table('local_passengers')->where('nic',  request('nic'))->first();
                    // echo($localPassenger->id);
                    $affected = DB::table('local_passenger_accounts')->where('psngr_id', $localPassenger->id)->update(['tot_amount' => request('tot_amount'), 'balance' => request('tot_amount')]);

                    return $affected;
                }
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong']);
        }
    }
}
