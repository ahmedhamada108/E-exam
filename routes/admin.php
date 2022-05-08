<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => LaravelLocalization::setLocale(),'namespace'=>'Admin','middleware' => ['web']], function(Router $router)
{
    Route::get('login','Login@login_view')->name('login.view');
    Route::post('login_post','Login@postLogin')->name('login.post');
    //  end login routes

    Route::group(['prefix'=>'admin','middleware' => ['check.login']], function()
    {
        Route::get('Dashboard','Login@dashboard_view')->name('dashboard.view');
        
        Route::get('logout','Login@logout')->name('logout');
        // end dashboard & logout routes

        Route::resource('levels','LevelsController')->except('show');
        // end of levels routes

        Route::resource('departments','DepartmentsController')->except('show');
        // end of departments routes
        
        Route::resource('subjects','SubjectsController')->except('show');
        // end of subjects routes 

        Route::resource('professors','ProfessorsController')->except('show');
        // end of the professors routes

        Route::resource('admins','AdminsController')->except('show');
        // end of the manage admins routes
        Route::resource('subjects/{subject_id?}/chapters','ChaptersController')->except('show');
        // end of the chapters routes 
        Route::resource('subjects/{subject_id?}/chapters/{chapter_id?}/questions','QuestionsController')->except('show');
        // end of the questions routes 
        Route::resource('exams','ExamController')->except('show');
        // end of the exams routes 
        Route::resource('exams/{exam_id?}/exam_structure','Exam_StructureController')->except('show');

        Route::resource('students','StudentsController')->except('show');


        Route::get('test','testController@test');

    });// end admin routes group


});// end localization routes group 