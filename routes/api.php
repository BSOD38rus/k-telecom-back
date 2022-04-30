<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    // API EquipmentController routes
    Route::get('/equipment', [App\Http\Controllers\API\EquipmentController::class, 'index']);
    Route::post('/equipment', [App\Http\Controllers\API\EquipmentController::class, 'store']);
    Route::get('/equipment/{id}', [App\Http\Controllers\API\EquipmentController::class, 'show']);
    Route::match(['put', 'patch'],'/equipment/{id}', [App\Http\Controllers\API\EquipmentController::class, 'update']);
    Route::delete('/equipment/{id}', [App\Http\Controllers\API\EquipmentController::class, 'destroy']);
    // API EquipmentTypeController route
    Route::get('/equipment-type', [App\Http\Controllers\API\EquipmentTypeController::class, 'index']);
});
