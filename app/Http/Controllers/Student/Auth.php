<?php

namespace App\Http\Controllers\Student;

use App\Models\mcq;
use App\Models\exam;
use App\Models\levels;
use App\Models\students;
use App\Models\subjects;
use App\Models\departments;
use App\Models\student_exam;
use Illuminate\Http\Request;
use App\Models\exam_structure;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ResponseTraits;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Auth extends BaseController 
{
    public function Register_view()
    {
        $levels= levels::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
        )->get();
        $departments= departments::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
        )->get();
        return view('StudentPanel.register',compact(['levels','departments']));
    }

    public function postRegistration(Request $request)
    {  
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required| email |unique:students',
            'password' => 'required|min:6| confirmed',
            'level_id'=>'required',
            'dept_id'=>'required',
            'terms'=>'accepted'
        ]);
        $data= $request->except('password');
        $data['password']= bcrypt($request->password);
        students::create($data);
        session()->flash('success','The Registeraion request has been sent to the admin');
        return redirect()->route('student.register.view');
    }

    public function dashboard_view(){
        $subjects= subjects::where([
            ['level_id','=',auth('student')->user()->level_id],
            ['dept_id','=', auth('student')->user()->dept_id]
            ])->get();
        return view('Studentpanel.dashboard',compact('subjects'));
    }

    public function exam($subject_id){

        $exam=exam::where('subject_id',$subject_id)->get();
        $exam_structure = exam_structure::with('exam')->where('exam_id', $exam[0]->id)->get();
        if($exam_structure->count()==0){
            return 'no exam';
        }
        // return $exam_structure;
        foreach ($exam_structure as $exam) {
                $questions= mcq::select('id', 'question_name', 'subject_id', 'model_type_id', 'chapter_id')->where([
                    ['subject_id',$exam['exam']->subject_id],
                    ['chapter_id',$exam->chapter_id]
                    ])->with(
                        ['subjects:id,name_'.LaravelLocalization::getCurrentLocale().' as subject_name',
                        'model_type:id,type']
                    )->inRandomOrder()
                    ->limit($exam->number_quest)->get();
                // echo $questions ;
            foreach ($questions as $question) {
                student_exam::create([
                    'exam_id'=>$exam->exam_id,
                    'student_id'=>auth('student')->user()->id,
                    'mcq_id'=>$question->id
            ]);
            }
        }
    }
    public function logout()
    {
        auth('student')->logout();
        return redirect('/login');
    }// end logout func

}
