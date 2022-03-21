<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\professors;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Auth extends BaseController
{
    public function Register_view()
    {
        return view('ProfessorPanel.register');
    }

    public function postRegistration(Request $request)
    {  
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required| email |unique:professors',
            'password' => 'required|min:6| confirmed',
        ]);
        $data= $request->except('password');
        $data['password']= bcrypt($request->password);
        professors::create($data);
        session()->flash('success','The Registeraion request has been sent to the admin');

        return redirect()->route('login.view');
    }

    public function dashboard_view(){
        if (auth('professor')->user()->activation==0) {
            return 'reurn 0';
        }else{
            return 'error';
        }
    }
    public function logout()
    {
        auth('professor')->logout();
        return redirect('/login');
    }// end logout func

}
