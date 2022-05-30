<?php

namespace App\Http\Controllers\Student;

use Carbon\Carbon;
use App\Models\mcq;
use App\Models\exam;
use App\Models\answer;
use App\Models\students;
use App\Models\subjects;
use App\Models\student_exam;
use Illuminate\Http\Request;
use App\Models\student_grade;
use App\Models\exam_structure;
use Illuminate\Routing\Controller as BaseController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ExamStudentController extends BaseController 
{
    public function exam_view($exam_id,$subject_id){

        $if_opened= student_exam::where(
            ['exam_id'=>$exam_id],
            ['student_id'=>auth('student')->id()]
            )->get();
        // check the exam is opened before or not

        if($if_opened->count()==0 || $if_opened[0]->exam_id==null){ 

            // if the student open the exam to the first time
            $exam=exam::where('subject_id', $subject_id)->get();
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
                        'student_id'=>auth('student')->user()->id,
                        'mcq_id'=>$question->id,
                        'correct_answer'=>$question->correct_answer
                ]);
                }
                //end storing the question to the student question table

                $questions_exam = student_exam::where('exam_id',$exam_id)->
                with(['exam','mcq'])->get();
                // end the return questions
            }
        }else{
            // return message if the user opend the exam before
            session()->flash('error', __('student.exam.You_cannot_open_the_exam_again'));
            return redirect()->route('student.subjects.index');
        }
        // return $questions_exam;
        return view('StudentPanel.exam',compact(['questions_exam','exam_id']));
    }



    public function submit_exam(Request $request,$exam_id){

        $If_check_submitted= student_grade::where([
            ['exam_id',$exam_id],
            ['student_id',auth('student')->id()]
            ])->count();
            // check if the exam is submitted before or not

        $if_exam_available= exam::where([
            ['id',$exam_id],
            ['Is_available',1],
            ['start_at','<=', Carbon::now()->timestamp]
            ])->count();
        // check if the exam is expired or not 
        if($If_check_submitted ==0){

            if($if_exam_available > 0){
                
                $data = $request->validate([
                    'mcq_id'=>'required'
                ]); // end validate the data
                $data += [
                    'exam_id'=>$exam_id,
                ];// end adding the exam ID
        
                $count=0;
                foreach ($request['student_answer'] as $student_answer) {
                    $mcq= student_exam::where(['exam_id'=>$exam_id],['student_id'=>auth('student')->id()])->get();
                    $mcq[$count]->update([
                        'student_answer'=>$student_answer
                    ]);
                    $count++;
                }
                $student_grade= student_exam::where(['exam_id'=>$exam_id],['student_id'=>auth('student')->id()])
                ->whereRaw('correct_answer = student_answer')->count();
                $exam_grade= count($request['mcq_id']);
        
                student_grade::create([
                    'exam_id'=>$exam_id,
                    'student_id'=> auth('student')->id(),
                    'exam_grade'=>$exam_grade,
                    'student_grade'=>$student_grade
                ]);
                session()->flash('success_exam',__('student.exam.Your_final_grade_for_this_exam_is'));
                session()->flash('student_grade',$student_grade);
                session()->flash('exam_grade',$exam_grade);
                return redirect()->route('student.dashboard.view');
            }else{
                session()->flash('error',__('student.exam.the_exam_is_finished_so_you_cannot_submit_the_exam'));
                return redirect()->route('student.dashboard.view');
            }// end if statement of checking the exam is expired or not  
        }else{
            session()->flash('error',__('student.exam.You_cannot_submit_this_exam_again'));
            return redirect()->route('student.dashboard.view');
        }// end if statement of checking the exam is submiited before or not
    }
}
