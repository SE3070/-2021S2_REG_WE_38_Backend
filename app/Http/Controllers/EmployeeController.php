<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\EmployeeFactory;

class EmployeeController extends Controller
{
    /**
     * This functuion is using to create employees
     * In here createEmployee function is using Factory pattern to create objects for inspectors and drivers
     * 
     * @param request
     * @return json
     * 
     * @see EmployeeFactory::setInspectors()
     * @see EmployeeFactory::setDrivers()
     */

    public function createEmployee(Request $request){

        try {
            $validator = validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'obj' => 'required'
            ]);
            if($validator->fails()){
                return response()->json(['message' => 'Time Table validation failed'], 403);
            } else {
                if(request('obj') == 'i'){

                    $empFactory = EmployeeFactory::setInspector();
                    $empFactory->firstname = request('firstname');
                    $empFactory->lastname = request('lastname');
                    $empFactory->email = request('email');
                    $empFactory->save();

                } elseif(request('obj') == 'd'){

                    $empFactory = EmployeeFactory::setDriver();
                    $empFactory->firstname = request('firstname');
                    $empFactory->lastname = request('lastname');
                    $empFactory->email = request('email');
                    $empFactory->save();

                } else {
                    return response()->json(['message' => 'Something went wrong', 'error' => $e], 403);
                }
                return $empFactory;
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong', 'error' => $e], 500);
        }
    }
}
