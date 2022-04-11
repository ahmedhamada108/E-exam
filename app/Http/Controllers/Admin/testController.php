<?php

namespace App\Http\Controllers\Admin;

use App\Models\mcq;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\exam_structure;
use App\Http\Controllers\Controller;
use App\Models\student_exam;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class testController extends Controller
{
    public function test(){
       $exams = exam_structure::with('exam')->where('exam_id',2)->get();
    //    return $exams->count();
        foreach($exams as $exam){
            foreach ($exam['exam'] as $exam_object) {

                $questions= mcq::select('id','question_name','subject_id','model_type_id','chapter_id')->where([
                    ['subject_id',$exam_object->subject_id],
                    ['chapter_id',$exam->chapter_id] 
                    ])->with(
                        ['subjects:id,name_'.LaravelLocalization::getCurrentLocale().' as subject_name',
                        'model_type:id,type'])->get();
                        // echo $questions ;
            }
            foreach ($questions as $question) {
                student_exam::create([
                    'exam_id'=>$exam->exam_id,
                    'mcq_id'=>$question->id
            ]);
            }
            echo view('test',compact(['questions','exams']));

        }
    }
}
