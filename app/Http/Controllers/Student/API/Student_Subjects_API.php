<?php

namespace App\Http\Controllers\Student\API;

use App\Models\exam;
use App\Models\levels;
use App\Models\students;
use App\Models\subjects;
use App\Models\departments;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Traits\ResponseTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Student_Subjects_API extends BaseController
{
    use ResponseTrait;

    public function subjects(){
        try{
            if(auth('student_api')->id() != null){
                $subjects= subjects::select(
                    'id',
                    'name_'.app()->getLocale().' as name',
                    'level_id',
                    'dept_id',
                    'prof_id'
                    )->with(
                        'levels:id,name_'.app()->getLocale().' as name',
                        'departments:id,name_'.app()->getLocale().' as name',
                        'professors:id,name'
                        )->where([
                    ['level_id','=',auth('student_api')->user()->level_id],
                    ['dept_id','=', auth('student_api')->user()->dept_id]
                    ])->get();
                return $this->returnData('Subjects Student',$subjects); 
            }else{
                return $this->returnError('E500', 'Please login to your account');
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function check_exists_exam(Request $request){
        try{
            if(auth('student_api')->id() != null){
                if(isset($request->subject_id)){
                    $check_exists_exam =exam::where('subject_id',$request->subject_id)->get();
                    if($check_exists_exam->count()==0){
                        return $this->returnError('E433','There is no exam for this subject');
                        // exam status
                    }else{
                        return $this->returnData('Exam Info',$check_exists_exam);
                        // return the info of the exam
                    }
                }else{
                    return $this->returnError('E400','Please send subject ID');
                    // check pass the subject id
                }
            }else{
                return $this->returnError('E500', 'Please login to your account');
                // check login student
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
