<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JournyRate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JourneyRouteController extends Controller
{
    /**
     * This function is using to create journey rate 
     * 
     * @param request
     * @return json
     * 
     */
    public function createJourneyRate(Request $request) {
        
        try {
            $validator = validator::make($request->all(), [
                'rate'=>'required'
            ]);

            if($validator->fails()){
                return response()->json(['message' => 'Your balance is insufficient'], 403);
            }else {

                $rate = new JournyRate();
                $rate->admin_id = Auth::user()->id;
                $rate->rate = request('rate');
                $rate->save();
                return $rate;
            }
        }catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
}
