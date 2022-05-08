<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\professors;
use App\Models\students;
use App\Models\subjects;
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
        $subjects= subjects::where('prof_id',auth('professor')->id())->get();
        ######## Get the students by the following professor ########
            $students = students::select('id','level_id','dept_id')->get();
            foreach($students as $student){
                $subjects= subjects::where(['dept_id'=>$student->dept_id],['level_id'=>$student->level_id],['prof_id',auth('professor')->id() ])->get();
                // return $subjects;
                foreach ($subjects as $subject) {
                    $query_students_prof= students::where(['dept_id'=>$subject->dept_id],['level_id'=>$subject->level_id]);
                    $students_prof= $query_students_prof->get();
                    $pending_students= $query_students_prof->where('Is_active',0)->get();
                }
        }
        ######## Get the students by the following professor ########

        return view('ProfessorPanel.dashboard',compact(['subjects','students_prof','pending_students']));
    }
    public function logout()
    {
        auth('professor')->logout();
        return redirect('/login');
    }// end logout func

}
