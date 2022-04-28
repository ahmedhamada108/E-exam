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

Route::get('/', function () {
    return view('AdminPanel.dashboard');
});
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['web']], function(Router $router)
{
    Route::get('student/register','Student\Auth@Register_view')->name('student.register.view');
    Route::post('student/register_post','Student\Auth@postRegistration')->name('student.register.post');
    //  end login routes

    Route::group(['prefix'=>'student','middleware' => ['check.login.student']], function()
    {
        Route::get('Dashboard','Student\Auth@dashboard_view')->name('dashboard.view');
        Route::get('logout','Student\Auth@logout')->name('logout.prof');
        // end auth routes
        
        
    });// end admin routes group


});// end localization routes group 