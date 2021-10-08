<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\LocalPassengerRoutinesController;
use App\Http\Controllers\ForeignPassengerRoutineController;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\AlternativeTimeTableController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OverCrowdedDetailsController;
use App\Http\Controllers\LocalPassengerAccountController;
use App\Http\Controllers\ForeignPassengerAccountController;
use App\Http\Controllers\JourneyRouteController;


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
| Get Time table
|--------------------------------------------------------------------------
*/
Route::get('/get-time-tables' , [TimeTableController::class, 'getTimeTables']);
/*
|--------------------------------------------------------------------------
| Get Routes
|--------------------------------------------------------------------------
*/
Route::get('/get-routes', [RoutesController::class, 'getRoute']);
/*
|--------------------------------------------------------------------------
| passenger Routes - Register
|--------------------------------------------------------------------------
*/
Route::post('/reg-passenger-local' , [PassengerController::class,'createLocalPassenger']);
Route::post('/reg-passenger-foreign' , [PassengerController::class,'createForeignPassenger']);
/*
|--------------------------------------------------------------------------
| passenger Routes - login
|--------------------------------------------------------------------------
*/
Route::post('/login-passenger-local' , [PassengerController::class,'localPassengerLogin']);
Route::post('/login-passenger-foreign' , [PassengerController::class,'foreignPassengerLogin']);
/*
|--------------------------------------------------------------------------
| passenger Routes - History
|--------------------------------------------------------------------------
*/
Route::get('/local-history',[LocalPassengerRoutinesController::class,'getLocalRouteHistory']);
Route::get('/foreign-history',[ForeignPassengerAccountController::class,'getForeignRouteHistory']);
/*
|--------------------------------------------------------------------------
| passenger Routes - Routines
|--------------------------------------------------------------------------
*/
Route::post('/local-passenger-route' , [LocalPassengerRoutinesController::class,'createLocalPassengerRoutines']);
Route::post('/foreign-passenger-route' , [ForeignPassengerRoutineController::class,'createForeignPassengerRoutines']);
/*
|--------------------------------------------------------------------------
| passenger Routes - Reload
|--------------------------------------------------------------------------
*/
Route::post('/reload-local', [LocalPassengerAccountController::class, 'reloadTotalAmount']);
Route::post('/reload-foreign', [ForeignPassengerAccountController::class, 'foreignReload']);
/*
|--------------------------------------------------------------------------
| passenger Routes - Get Balance
|--------------------------------------------------------------------------
*/
Route::get('get-balance-local', [PassengerController::class, 'getBalanceLocal']);
Route::get('get-balance-foreign', [PassengerController::class, 'getBalanceForeign']);
/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/creat-route', [RoutesController::class, 'createRoute']);
    Route::post('/creat-bus', [BusController::class, 'createBus']);
    Route::post('/creat-time-table', [TimeTableController::class, 'createTimeTable']);
    Route::post('/creat-alt-time-table/{id}', [AlternativeTimeTableController::class, 'createAlternativeTimeTable']);
    Route::post('/create-overcrowd-report', [OverCrowdedDetailsController::class, 'createOverCrowdReport']);
    Route::post('/create-miss-behave-report', [OverCrowdedDetailsController::class, 'createOverCrowdReport']);
    Route::post('/create-rate', [JourneyRouteController::class, 'createJourneyRate']);
    Route::post('/create-employee', [EmployeeController::class, 'createEmployee']);
});