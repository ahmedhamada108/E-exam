<?php

namespace App\Http\Controllers\Admin;

use App\Models\admins;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins= admins::all();
        return view('AdminPanel.admins.index',compact('admins'));

    }// end index view funcation 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel.admins.create');
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
            'email' => 'required| email |unique:admins',
            'password' => 'required|min:6| confirmed',
        ]);
        $data= $request->except('password');
        $data['password']= bcrypt($request->password);
        admins::create($data);
        session()->flash('success', 'the admin has been added');
        return redirect()->route('admins.index');
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admins= admins::find($id);
        return view('AdminPanel.admins.show',compact('admins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('admins')->ignore($id)],
            'password' => 'required|min:6| confirmed',
        ]);
             $admins= admins::find($id);
             $admins->update($data);
             session()->flash('success', 'the admin has been edited');
             return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        admins::destroy($id);
        session()->flash('success','the admin has been deleted');
        return redirect()->route('admins.index');
    }
}
