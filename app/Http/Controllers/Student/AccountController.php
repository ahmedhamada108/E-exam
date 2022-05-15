<?php

namespace App\Http\Controllers\Student;

use App\Models\student_grade;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AccountController extends BaseController 
{
    public function account_view(){
        $student_exams= student_grade::with(['exam'=>function($exam){
            $exam->with(
                'professors:id,name',
                'subjects:id,name_'.LaravelLocalization::getCurrentLocale().' as subject_name')->get();
        }])->get();
        //  return $student_exams;  
        return view('StudentPanel.account',compact(['student_exams']));
    }

}
