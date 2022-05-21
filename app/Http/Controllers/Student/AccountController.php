<?php

namespace App\Http\Controllers\Student;

use Carbon\Carbon;
use App\Models\exam;
use App\Models\student_exam;
use Illuminate\Http\Request;
use App\Models\student_grade;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AccountController extends BaseController 
{
    public function account_view(){
        $student_exams= student_grade::where('student_id',auth('student')->id())
        ->with(['exam'=>function($exam){
            $exam->with(
                'professors:id,name',
                'subjects:id,name_'.LaravelLocalization::getCurrentLocale().' as subject_name')->get();
        }])->get();
        //  return $student_exams;  
        return view('StudentPanel.account',compact(['student_exams']));
    }

    public function exam_view($exam_id){

        $if_exam_exists= exam::where([
            ['id',$exam_id],
            ['Is_available',0],
            ['start_at','>=', Carbon::now()->timestamp]
            ])->count();
        if($if_exam_exists == 0) // check if this exam is expired or not
        {
            $questions_exam= student_exam::where(
                ['exam_id'=>$exam_id],
                ['student_id'=>auth('student')->id()]
                )->with('mcq')->get();
                // return $questions_exam;
            return view('StudentPanel.previous_exam',compact(['questions_exam']));
        }else{
            session()->flash('error','You can open this exam after finished it only');
            return redirect()->route('student.account.index');
        }
    }

}
