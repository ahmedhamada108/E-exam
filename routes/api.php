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

Route::group(['prefix'=>'student','namespace'=>'Student\API','middleware'=>['change.lang']], function(Router $router)
{
    Route::get("GetLevelsAndDept","AuthAPI@LevelsAndDept");
    Route::post("Register","AuthAPI@postRegistration");
    Route::post("Login","AuthAPI@Login");
    Route::post("Logout","AuthAPI@logout");

    Route::group([], function()
    {
        Route::get("Get_Student_Subjects","Student_Subjects_API@subjects");
        Route::get("check_exists_exam","Student_Subjects_API@check_exists_exam");
        Route::get("exam_view","ExamStudent_API@exam_view");
        Route::get("return_options","ExamStudent_API@Return_options");
        Route::delete("Delete_questions","ExamStudent_API@Delete_questions");

    });

});
