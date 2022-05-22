<?php

namespace App\Http\Controllers\Admin;

use App\Models\departments;
use App\Models\levels;
use App\Models\professors;
use App\Models\students;
use App\Models\subjects;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Login extends BaseController
{
    public function login_view(){
        return view('AdminPanel.login');
    }//end login view

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (auth('admin')->attempt($credentials)) {
            session()->flash('success','done');
            return redirect()->route('admin.dashboard.view');
            // end login admin logic 
        }else if(auth('professor')->attempt($credentials)){
            session()->flash('success','done');
            return redirect()->route('professor.dashboard.view');
            // end login professor logic 
        }else if(auth('student')->attempt($credentials)){
            session()->flash('success','done');
            return redirect()->route('student.dashboard.view');
            // end login student logic
        }
        else{
            session()->flash('error',__('login_register.login.Oppes!_You_have_entered_invalid_credentials'));
            return redirect()->route('login.view');
        }
    }// end post login func

    public function dashboard_view(){

        $levels= levels::all();
        $departments= departments::all();
        $subjects= subjects::all();
        $professors= professors::all();
        $students= students::all();
        $students_pending= students::where('Is_active',0)->get();
        return view('AdminPanel.dashboard',compact(['levels','departments','subjects','professors','students_pending','students']));
    }// end dashboard view func
    
    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('login.view');
    }// end logout func
    
}
