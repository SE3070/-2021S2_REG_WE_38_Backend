<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OverCrowdedDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class OverCrowdedDetailsController extends Controller
{
    /**
     * This function is using to create over crowd report
     * 
     * @param request
     * @return json
     */
    public function createOverCrowdReport(Request $request) {
        try {
            $validator = validator::make($request->all(), [
                "route" => "required",
                "no_of_passengers" => "required",
            ]);

            if($validator->fails()){
                return response()->json(['message' => 'Over crowd report validation fails']);
 
            }else {
                $overCrowd = new OverCrowdedDetails();
                $overCrowd->route = request('route');
                $overCrowd->no_of_passengers = request('no_of_passengers');
                $overCrowd->save();
            }

            return $overCrowd;
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong']);
        }
    }
}