<?php

use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\VehicleMakeController;
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

Route::get('/', function () {
    return 'Welcome to VehicleStore API';
})->name("welcomeApi");

Route::group(['prefix' => 'v1'], function ()
    {
        Route::group(['prefix' => '/vehicle'], function(){
            Route::apiResource('/makes', VehicleMakeController::class);
        });

        Route::group(['prefix' => '/auth'], function(){
            Route::get('/login/.well-known/openid-configuration', [AuthController::class, 'getLoginConfiguration']);
            Route::any('/login', [AuthController::class, 'authenticate']);
            Route::post('/register', [AuthController::class, 'register']);
            Route::get('/user', [AuthController::class, 'getUser']);
        });
    }
);
