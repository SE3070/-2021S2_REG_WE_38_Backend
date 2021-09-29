<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){


        try {
            $fields = $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password'=> 'required|string|confirmed'
            ]);
    
            $user = User::create([
                'firstname' => $fields['firstname'],
                'lastname' => $fields['lastname'],
                'email' => $fields['email'],
                'password' => bcrypt($fields['password'])
            ]);

            
        } catch (Throwable $e) {
            report($e);
            return response()->json(['message' => 'Something went wrong'], 500);
        }

        $token = $user->createToken('token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function logout(Request $request){
        try {
            auth()->user()->tokens()->delete();
            $response = [
                'message' => 'logged out',
            ];
            return response($response, 200);
        } catch (Throwable $e) {
            report($e);
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function login(Request $request){

        try {
            $fields = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string'
            ]);
    
            $user = User::where('email', $fields['email'])->first();

                
            if(!$user || !Hash::check($fields['password'], $user->password)){
                return response ([
                    'message' => 'Bad Creds'
                ], 401);
            }

            $token = $user->createToken('token')->plainTextToken;  
            
            $response = [
                'user' => $user,
                'token' => $token
            ];
    
            return response($response, 200);

        } catch (Throwable $e) {
            return response()->json(['message' => 'Something went wrong', 'error' => $e], 500);
        }
        
    }
}
