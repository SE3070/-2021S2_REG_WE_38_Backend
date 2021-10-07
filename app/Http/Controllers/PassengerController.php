<?php

namespace App\Http\Controllers;

use \stdClass;
use Illuminate\Http\Request;
use App\Models\Passenger;
use App\Models\LocalPassengers;
use App\Models\LocalPassengerAccount;
use App\Models\ForeignPassengerAccount;
use App\Models\ForeignPassengers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PassengerController extends Controller
{
    /**
     * This function is using to regiter a local passenger
     * 
     * @param request 
     * @return json 
     * 
     * @see getPassenger()
     * @see getLocalPassenger
     */
    public function createLocalPassenger(Request $request){
        try {
            $validator = validator::make($request->all(), [
                "firstname" => "required",
                "lastname" => "required",
                "email" => "required",
                "nic" => "required",
                "tot_amount" => "required"
            ]);

            if($validator -> fails()){
                return response()->json(['message' => 'local passenger validation fails']);
            }else {
                $passenger = Passenger::getPassenger();
                $passenger->firstname = request('firstname');
                $passenger->lastname = request('lastname');
                $passenger->email = request('email');
                $passenger->save();

                if (request('nic')){
                    $localPassenger = LocalPassengers::getLocalPassenger();
                    $localPassenger->nic = request('nic');
                    $localPassenger->psngr_id = $passenger->id;
                    $localPassenger->save();

                    $localPassngerAccount = LocalPassengerAccount::getLocalPassengerAccount();
                    $localPassngerAccount->psngr_id = $localPassenger->id;
                    $localPassngerAccount->tot_amount = request('tot_amount');
                    $localPassngerAccount->balance = request('tot_amount');
                    echo(request('tot_amount'));
                    $localPassngerAccount->save();

                }else {
                    return response()->json(['message' => 'NIC not found', 'error' => $e], 403);
                }

                $resObj = new stdClass();
                $resObj->firstname = $passenger->firstname;
                $resObj->lastname = $passenger->lastname;
                $resObj->email = $passenger->email;
                $resObj->passenger_id = $passenger->id;
                $resObj->nic = $localPassenger->nic;
                $resObj->psngr_id = $localPassenger->psngr_id;
                $resObj->local_passenger_id  = $localPassenger->id;

                return $resObj;
        }
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong', 'error' => $e], 500);
        }        
    }

    /**
     * This function is using to create foreign passenger
     * 
     * @param request
     * @return json
     * 
     * @see getPassenger()
     * @see getForeignPassenger()
     */

    public function createForeignPassenger(Request $request) {

        try{
            $validator = validator::make($request->all(), [
                "firstname" => "required",
                "lastname" => "required",
                "email" => "required",
                "passport" => "required",
                "tot_amount" => "required"
            ]);
    
            if ($validator->fails()){
                return response()->json(['message' => 'foreign passenger fails']);
            }else{
                $passenger = Passenger::getPassenger();
                $passenger->firstname = request('firstname');
                $passenger->lastname = request('lastname');
                $passenger->email = request('email');
                $passenger->save();
    
                if (request('passport')){
                    $foreignPassenger = ForeignPassengers::getForeignPassenger();
                    $foreignPassenger->passport = request('passport');
                    $foreignPassenger->psngr_id = $passenger->id;
                    $foreignPassenger->save();

                    $foreignPassngerAccount = ForeignPassengerAccount::getForeignPassengerAccount();
                    $foreignPassngerAccount->psngr_id = $foreignPassenger->id;
                    $foreignPassngerAccount->tot_amount = request('tot_amount');
                    $foreignPassngerAccount->balance = request('tot_amount');
                    
                    $foreignPassngerAccount->save();
                }else{
                    return response()->json(['message' => 'Passport not found', 'error' => $e], 403);
                }
            }
            
            $resObj = new stdClass();
            $resObj->firstname = $passenger->firstname;
            $resObj->lastname = $passenger->lastname;
            $resObj->email = $passenger->email;
            $resObj->passenger_id = $passenger->id;
            $resObj->nic = $foreignPassenger->passport;
            $resObj->psngr_id = $foreignPassenger->psngr_id;
            $resObj->local_passenger_id  = $foreignPassenger->id;

            return $resObj;
            
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong', 'error' => $e], 500);
        }
    }

}
