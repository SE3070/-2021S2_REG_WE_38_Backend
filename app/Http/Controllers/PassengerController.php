<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passenger;
use App\Models\LocalPassengers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PassengerController extends Controller
{
    public function createLocalPassenger(Request $request){
        try {
            $validator = validator::make($request->all(), [
                "firstname" => "required",
                "lastname" => "required",
                "email" => "required",
                "nic" => "required"
            ]);

            if($validator -> fails()){
                return response()->json(['message' => 'time table validation fails']);
            }else {
                $passenger = new Passenger;
                $passenger->firstname = request('firstname');
                $passenger->lastname = request('lastname');
                $passenger->email = request('email');
                $passenger->save();

                if (request('nic')){
                    $localPassenger = new LocalPassengers;
                    $localPassenger->nic = request('nic');
                    $localPassenger->psngr_id = $passenger->id;
                    $localPassenger->save();
                }else {
                    return response()->json(['message' => 'NIC not found', 'error' => $e], 403);
                }
                return response()->json(['passenger' => $passenger, 'local_passenger' => $localPassenger], 201);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong', 'error' => $e], 500);
        }        
    }
}
