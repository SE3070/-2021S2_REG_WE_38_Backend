<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BusController extends Controller
{
    /**
     * This function is using to create buses for the system
     * 
     * @param request
     * @return json
     */
    public function createBus(Request $request) {

        try{
            $validator = validator::make($request->all(), [
                "bus_number" => "required",
                "bus_type" => "required"
            ]);
    
            if($validator->fails()){
                return response()->json(['message' => 'Foreign passenger routings validation fails']);
            } else {
                $bus = Bus::getBus();
                $bus->bus_number = request('bus_number');
                $bus->bus_type = request('bus_type');
                $bus->save();
            }
            return $bus;

        } catch (Exception $e){
            return response()->json(['message' => 'Something went wrong', 'error' => $e], 500);
        }
    }
}
