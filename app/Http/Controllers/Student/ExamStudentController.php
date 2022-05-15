<?php

namespace App\Http\Controllers\Student;

use App\Models\answer;
use App\Models\mcq;
use App\Models\exam;
use App\Models\subjects;
use App\Models\student_exam;
use Illuminate\Http\Request;
use App\Models\exam_structure;
use App\Models\student_grade;
use App\Models\students;
use Illuminate\Routing\Controller as BaseController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ExamStudentController extends BaseController 
{
    public function exam_view($exam_id,$subject_id){

        $if_opened= student_exam::where('exam_id',$exam_id)->get();
        // check the exam is opened before or not

        if(0==0){ 

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
                with(['exam_id','mcq'])->get();
                // end the return questions
            }
        }else{
            // return message if the user opend the exam before
            session()->flash('error', 'You cannot open the exam again');
            return redirect('student/subjects');
        }
        // return $questions_exam;
        return view('StudentPanel.exam',compact(['questions_exam','exam_id']));
    }



    public function submit_exam(Request $request,$exam_id){

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
        session()->flash('success_exam',"Your final grade for this exam is");
        session()->flash('student_grade',$student_grade);
        session()->flash('exam_grade',$exam_grade);
        // return view('Studentpanel.dashboard',compact(['student_grade','exam_grade']));
        return redirect('student/Dashboard');
    }
}
