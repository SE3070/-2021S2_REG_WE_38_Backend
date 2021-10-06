<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\PassengerMissBehave;

class PassengerMissBehaveController extends Controller
{
    public function createMissBehaveReport(Request $request){

        try {
            $validator =  validator::make($request->all(), [
                "route" => "required",
                "no_of_passengers" => "required",
                "date" => "required"
            ]);
    
            if($validator->fails()){
                return response()->json(['message' => 'Foreign passenger routings validation fails']);
            } else {
                $missBehave = new PassengerMissBehave();
                $missBehave->route = request('route');
                $missBehave->no_of_passengers = request('no_of_passengers');
                $missBehave->date = request('date');
                $missBehave->save();
            }

            return $missBehave;

        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong']);
        }

    }
}
