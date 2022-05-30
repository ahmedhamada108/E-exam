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
            'name_'.LaravelLocalization::getCurrentLocale().' as name'
        )->get();
        $departments= departments::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name'
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
        session()->flash('success',__('student.auth.The_Registeraion_request_has_been_sent_to_the_admin'));
        return redirect()->route('student.register.view');
    }

    public function dashboard_view(){
        return view('StudentPanel.dashboard');
    }

    public function logout()
    {
        auth('student')->logout();
        return redirect()->route('login.view');
    }// end logout func

}
