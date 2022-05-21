<?php

namespace App\Http\Controllers\Admin;

use App\Models\students;
use App\Models\subjects;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
        
        if(auth('admin')->id() == null){ 
        ######## Get the students by the following professor ########
                $students = students::select('id','level_id','dept_id')->get();
                foreach($students as $student){
                    $subjects= subjects::where(['dept_id'=>$student->dept_id],['level_id'=>$student->level_id],['prof_id',auth('professor')->id() ])->get();
                    // return $subjects;
                    foreach ($subjects as $subject) {
                        $query_students_prof= students::where(['dept_id'=>$subject->dept_id],['level_id'=>$subject->level_id]);
                        
                        $students='';
                        if($request->get('sort') == "pending_status")
                        {
                            $students = $query_students_prof->where('Is_active',0)->get();
                        }
                        else if($request->get('sort')=='accepted_status')
                        {
                            $students = $query_students_prof->where('Is_active',1)->get();
                        }
                        else
                        {
                            $students= $query_students_prof->get();
                        }
                    }
                }
        ######## Get the students by the following professor ########
            return view('ProfessorPanel.students.index',compact('students'));
        }else{
            $students='';
            if($request->get('sort') == "pending_status")
            {
                $students = students::where('Is_active',0)->get();
            }
            else if($request->get('sort')=='accepted_status')
            {
                $students = students::where('Is_active',1)->get();
            }
            else
            {
                $students= students::all();
            }
            return view('AdminPanel.students.index',compact('students'));
        }

    }// end index view funcation 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth('admin')->id() == null){
            return view('ProfessorPanel.students.create');

        }else{
            return view('AdminPanel.students.create');

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required| email |unique:professors',
            'password' => 'required|min:6| confirmed',
        ]);
        $data= $request->except('password');
        $data['password']= bcrypt($request->password);
        students::create($data);

        if(auth('admin')->id() == null){
            session()->flash('success', 'the students has been added');
            return redirect()->route('professor.students.index');
        }else{
            session()->flash('success', 'the students has been added');
            return redirect()->route('students.index');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\professors  $professors
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students= students::find($id);
        if(auth('admin')->id() == null){
            return view('ProfessorPanel.students.show',compact('students'));

        }else{
            return view('AdminPanel.students.show',compact('students'));

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\professors  $professors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('students')->ignore($id)],
            'Is_active'=>'required'
        ]);
        if($request->password){
            $data +=$request->validate([
                'password' => 'required|min:6| confirmed',
                'activation'=>'required'
            ]);
        }
             $students= students::find($id);
             $students->update($data);
             if(auth('admin')->id() == null){
                session()->flash('success', 'the students has been edited');
                return redirect()->route('professor.students.index');
            }else{
                session()->flash('success', 'the students has been edited');
                return redirect()->route('students.index');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\professors  $professors
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        students::destroy($id);
        if(auth('admin')->id() == null){
            session()->flash('success','the students has been deleted');
            return redirect()->route('professor.students.index');
        }else{
            session()->flash('success','the students has been deleted');
            return redirect()->route('students.index');
        }

    }
}
