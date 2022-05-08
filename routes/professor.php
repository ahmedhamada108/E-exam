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

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['web']], function(Router $router)
{
    Route::get('professor/register','Professor\Auth@Register_view')->name('professor.register.view');
    Route::post('register_post','Professor\Auth@postRegistration')->name('professor.register.post');
    //  end login routes

    Route::group(['prefix'=>'professor','middleware' => ['check.login.prof']], function()
    {
        Route::get('Dashboard','Professor\Auth@dashboard_view')->name('dashboard.view');
        Route::get('logout','Professor\Auth@logout')->name('logout.prof');
        // end auth routes
        
        Route::resource('subjects','Admin\SubjectsController',['as'=>'professor'])->except('show');
        Route::resource('subjects/{subject_id?}/chapters','Admin\ChaptersController',['as'=>'professor'])->except('show');
        Route::resource(
        'subjects/{subject_id?}/chapters/{chapter_id?}/questions',
        'Admin\QuestionsController',
        ['as'=>'professor'])->except('show');


        Route::resource('students','Admin\StudentsController',['as'=>'professor'])->except('show');
        
    });// end admin routes group


});// end localization routes group 