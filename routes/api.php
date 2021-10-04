<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\LocalPassengerRoutinesController;
use App\Http\Controllers\ForeignPassengerRoutineController;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\BusController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register' , [AuthController::class, 'register']);
Route::post('/login' , [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| passenger Routes - Register
|--------------------------------------------------------------------------
*/
Route::post('/reg-passenger-local' , [PassengerController::class,'createLocalPassenger']);
Route::post('/reg-passenger-foreign' , [PassengerController::class,'createForeignPassenger']);

/*
|--------------------------------------------------------------------------
| passenger Routes - Routines
|--------------------------------------------------------------------------
*/
Route::post('/local-passenger-route' , [LocalPassengerRoutinesController::class,'createLocalPassengerRoutines']);
Route::post('/foreign-passenger-route' , [ForeignPassengerRoutineController::class,'createForeignPassengerRoutines']);

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/creat-route', [RoutesController::class, 'createRoute']);
    Route::post('/creat-bus', [BusController::class, 'createBus']);
});