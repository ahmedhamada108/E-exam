<?php

namespace App\Http\Controllers\Admin;

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
            return redirect('/admin/Dashboard');
        }else if(auth('professor')->attempt($credentials)){
            session()->flash('success','done');
            return redirect('/professor/Dashboard');
        }
        else{
            session()->flash('error','Oppes! You have entered invalid credentials');
            return redirect("login");
        }
    }// end post login func

    public function dashboard_view(){
        if(auth('admin')->user()->id){
            return 'dashboard';
        }else if(auth('professor')->user()->id){
            return 'dashboard prof';
        }
    }// end dashboard view func
    
    public function logout()
    {
        auth('admin')->logout();
        return redirect('/login');
    }// end logout func
    
}
