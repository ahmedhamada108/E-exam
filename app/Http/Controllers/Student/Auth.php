<?php

namespace App\Http\Controllers\Student;

use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ResponseTraits;
use App\Models\departments;
use App\Models\levels;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\students;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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
        if (auth('student')->user()->Is_active==0) {
            return 'reurn 0';
        }else{
            return 'error';
        }
    }
    public function logout()
    {
        auth('student')->logout();
        return redirect('/login');
    }// end logout func

}
