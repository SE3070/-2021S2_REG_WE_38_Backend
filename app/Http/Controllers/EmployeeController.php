<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeFactroy;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{

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
                if(request('obj')){
                    $empFactory = new EmployeeFactory();
                    $emp = $empFactory->getEmployee(request('obj'));
                    $emp->firstname = request('firsname');
                    $emp->lastname = request('lastname');
                    $emp->emp = request('email');
                    $emp->save();
                } else {
                    return response()->json(['message' => 'Something went wrong', 'error' => $e], 403);
                }
                return $emp;
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong', 'error' => $e], 500);
        }
    }
}
