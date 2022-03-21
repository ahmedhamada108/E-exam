<?php

namespace App\Http\Controllers\Admin;

use App\Models\professors;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ProfessorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professors= professors::all();
        return view('AdminPanel.professors.index',compact('professors'));

    }// end index view funcation 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel.professors.create');
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
        professors::create($data);
        session()->flash('success', 'the professor has been added');
        return redirect()->route('professors.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\professors  $professors
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $professors= professors::find($id);
        return view('AdminPanel.professors.show',compact('professors'));
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
            'email' => ['required', Rule::unique('professors')->ignore($id)],
            'password' => 'required|min:6| confirmed',
            'activation'=>'required'
        ]);
             $professors= professors::find($id);
             $professors->update($data);
             session()->flash('success', 'the professor has been edited');
             return redirect()->route('professors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\professors  $professors
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        professors::destroy($id);
        session()->flash('success','the professor has been deleted');
        return redirect()->route('professors.index');
    }
}
