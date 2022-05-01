<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;


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

Route::group(['prefix'=>'student','middleware'=>['change.lang']], function(Router $router)
{
    Route::get("GetLevelsAndDept","Student\API\AuthAPI@LevelsAndDept");
    Route::post("Register","Student\API\AuthAPI@postRegistration");
    Route::post("Login","Student\API\AuthAPI@Login");
    Route::post("Logout","Student\API\AuthAPI@logout");


});
