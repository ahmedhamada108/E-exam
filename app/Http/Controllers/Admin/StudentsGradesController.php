<?php

namespace App\Http\Controllers\Admin;

use App\Models\mcq;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\exam_structure;
use App\Http\Controllers\Controller;
use App\Models\student_exam;
use App\Models\student_grade;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StudentsGradesController extends Controller
{
    public function StudentsGrades($exam_id){
        $student_grades = student_grade::with('student:id,name,email')->where('exam_id',$exam_id)->get();
        if(auth('admin')->id() == null){
            return view('ProfessorPanel.students_grades.index',compact(['student_grades','exam_id']));
        }else{
            return view('AdminPanel.students_grades.index',compact(['student_grades','exam_id']));
        }
    }
}
