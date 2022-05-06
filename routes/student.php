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

    Route::group(['prefix'=>'student','namespace'=>'Student','middleware' => ['check.login.student']], function()
    {
        Route::get('Dashboard','Auth@dashboard_view')->name('dashboard.view');
        Route::get('logout','Auth@logout')->name('logout.student');
        // end auth routes
        Route::get('exam/{subject_id?}','Auth@exam');

        Route::get('subjects/','StudentSubjectController@subject_view');

        Route::get('subjects/exam/{exam_id}/{subject_id}','ExamStudentController@exam_view')->name('student.exam');

        Route::get('subjects/exam/{exam_name}','ExamStudentController@Return_Questions');
        Route::post('subjects/exam/{exam_name}/post','ExamStudentController@submit_exam')->name('post_exam');

    });// end admin routes group


});// end localization routes group 