<?php

namespace App\Http\Controllers\Student;

use App\Models\answer;
use App\Models\mcq;
use App\Models\exam;
use App\Models\subjects;
use App\Models\student_exam;
use Illuminate\Http\Request;
use App\Models\exam_structure;
use Illuminate\Routing\Controller as BaseController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ExamStudentController extends BaseController 
{
    public function exam_view($exam_id,$subject_id){

        $if_opened= student_exam::where('exam_id',$exam_id)->get();
        // check the exam is opened before or not

        if($if_opened->count()==0 || $if_opened[0]->exam_id==null ){ 

            // if the studen open the exam to first time 
            $exam=exam::where('subject_id',$subject_id)->get();
            $exam_structure = exam_structure::with('exam')->where('exam_id', $exam[0]->id)->get();

            foreach ($exam_structure as $exam) {
                    $questions= mcq::select('id', 'question_name', 'subject_id', 'model_type_id', 'chapter_id')->where([
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
                        'mcq_id'=>$question->id
                ]);
                }
                //end storing the question to the student question table 

                $questions_exam = student_exam::where('exam_id',$exam_id)->with([
                    'exam_id',
                'mcq'
                ])->get();
                // end the return questions 
            }
        }else{
            // return message if the user opend the exam before
            session()->flash('error', 'You cannot open the exam again');
            return redirect('student/subjects');
        }
        return view('Studentpanel.exam',compact(['questions_exam'])); 
    }

}
