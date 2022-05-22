<?php

namespace App\Http\Controllers\Student\API;

use Carbon\Carbon;
use App\Models\exam;
use App\Models\levels;
use App\Models\students;
use App\Models\subjects;
use App\Models\departments;
use App\Models\student_exam;
use Illuminate\Http\Request;
use App\Models\student_grade;
use App\Http\Traits\ResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Traits\ResponseTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class student_account_API extends BaseController
{
    use ResponseTrait;
    public function view_exams(){
        try{
            if(auth('student_api')->id() != null){
                    $student_exams= student_grade::where('student_id',auth('student_api')->id())
                    ->with(['exam'=>function($exam){
                        $exam->select(
                            'id',
                            'exam_name',
                            'subject_id',
                            'prof_id'
                            )->with(
                    'professors:id,name',
                    'subjects:id,name_'.LaravelLocalization::getCurrentLocale().' as subject_name')->get();
                }])->get();
                return $this->returnData('Exams Student',$student_exams); 
            }else{
                return $this->returnError('E500', 'Please login to your account');
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function view_exam(Request $request){
        try{
            if(auth('student_api')->id() != null){
                if(!$request->exam_id){
                    return $this->returnError('E332','Please send the exam id');
                }else{ // end the validate
                    $if_exam_exists= exam::where([
                        ['id',$request->exam_id],
                        ['Is_available',0],
                        ['start_at','>=', Carbon::now()->timestamp]
                        ])->count();
                    if($if_exam_exists == 0) // check if this exam is expired or not
                    {
                        $questions_exam= student_exam::where(
                            ['exam_id'=>$request->exam_id],
                            ['student_id'=>auth('student_api')->id()]
                            )->with('mcq')->get();
                            // return $questions_exam;
                            return $this->returnData('Exam Questions',$questions_exam);
                    }else{
                        return $this->returnError('E4332','You cannot open this exam after finished it only');
                    }
                }
            }else{
                return $this->returnError('E500', 'Please login to your account');
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
