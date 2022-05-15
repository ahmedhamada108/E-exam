<?php

namespace App\Http\Controllers\Student\API;

use App\Models\mcq;
use App\Models\exam;
use App\Models\answer;
use App\Models\levels;
use App\Models\students;
use App\Models\departments;
use App\Models\student_exam;
use Illuminate\Http\Request;
use App\Models\student_grade;
use App\Models\exam_structure;
use App\Http\Traits\ResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Traits\ResponseTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ExamStudent_API extends BaseController
{
    use ResponseTrait;

    public function exam_view(Request $request){
        try{
            if(auth('student_api')->id() != null){
            // start validate the parameters     
                $validator = Validator::make($request->all(), [
                    'exam_id' => 'required',
                    'subject_id' => 'required',
                ]);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                }
            // end the validate the parameters 
            
                $if_opened= student_exam::where('exam_id',$request->exam_id)->get();
                // check the exam is opened before or not             
                if($if_opened->count()==0 || $if_opened[0]->exam_id==null){ 

                    // if the student open the exam to the first time
                    $exam=exam::where('subject_id', $request->subject_id)->get();
                    $exam_structure = exam_structure::with('exam')->where('exam_id', $exam[0]->id)->get();
        
                    foreach ($exam_structure as $exam) {
                        $questions= mcq::select('id', 'question_name','correct_answer', 'subject_id', 'model_type_id', 'chapter_id')->where([
                                ['subject_id',$exam['exam']->subject_id],
                                ['chapter_id',$exam->chapter_id]
                                ])->with(
                                    ['subjects:id,name_'.LaravelLocalization::getCurrentLocale().' as subject_name',
                                    'model_type:id,type']
                                )->inRandomOrder()
                                ->limit($exam->number_quest)->get();
                        // return the questions for this student
                        foreach ($questions as $question) {
                            student_exam::create([
                                'exam_id'=>$exam->exam_id,
                                'student_id'=>auth('student_api')->user()->id,
                                'mcq_id'=>$question->id,
                                'correct_answer'=>$question->correct_answer
                        ]);
                        }// end the second foreach loop and storing the question to the student question table

                        $questions_exam = student_exam::select('id','exam_id','mcq_id')->
                        where('exam_id',$request->exam_id)->with([
                            'mcq:id,question_name,correct_answer'
                            ])->get();
                        // end the first foreach loop and return questions
                    }
                }else{
                    // return message if the user opend the exam before
                    return $this->returnError('E431','You cannot open the exam again');
                }
                return $this->returnData('The Questions Exam',$questions_exam);

            }else{
                return $this->returnError('E500', 'Please login to your account');
                // check login student
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function Return_options(Request $request){
        try{
            if(auth('student_api')->id() != null){
                if(isset($request->mcq_id)){

                    $options =answer::select('id','mcq_id','answer')->where('mcq_id',$request->mcq_id)->inRandomOrder()->limit(4)->get();
                    return $this->returnData('Options',$options);
                }else{
                    return $this->returnError('E400','Please send MCQ ID');
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
    public function Submit_exam(Request $request){
        try{
            if(auth('student_api')->id() != null){

                $validator = Validator::make($request->all(), [
                    'exam_id'=>'required',
                    'student_answer'=>'required'
                ]);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                }
                $count=0;
                foreach ($request['student_answer'] as $student_answer) {
                    $mcq= student_exam::where(['exam_id'=>$request->exam_id],['student_id'=>auth('student')->id()])->get();
                    $mcq[$count]->update([
                        'student_answer'=>$student_answer
                    ]);
                    $count++;
                }
                $student_grade= student_exam::where(['exam_id'=>$request->exam_id],['student_id'=>auth('student')->id()])
                ->whereRaw('correct_answer = student_answer')->count();
                $exam_grade= count($request['student_answer']);

                student_grade::create([
                    'exam_id'=>$request->exam_id,
                    'student_id'=> auth('student_api')->id(),
                    'exam_grade'=>$exam_grade,
                    'student_grade'=>$student_grade
                ]);
                return $this->returnData('grade_info',[
                    'exam_grade'=>$exam_grade,
                    'student_grade'=>$student_grade
                ]);
            }else{
                return $this->returnError('E500', 'Please login to your account');
                // check login student
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function Delete_questions(Request $request)
    {
        // start validate the parameters     
        $validator = Validator::make($request->all(), [
            'exam_id' => 'required',
            'student_id' => 'required',
        ]);
        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        // end the validate the parameters 

        $studen_exam=student_exam::where('exam_id',$request->exam_id)->where('student_id',$request->student_id)->delete();
        return $this->returnSuccessMessage('delete questions have been deleted');
    }
}

