<?php

namespace App\Http\Controllers\Admin;

use App\Models\departments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments= departments::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
        )->get();
        return view('AdminPanel.departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel.departments.create');
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
            'name_ar'=>'required',
            'name_en'=>'required',
        ]);
        departments::create($data);
        session()->flash('success','the department has been added');
        return redirect()->route('departments.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments= departments::find($id)->get();
        return view('AdminPanel.departments.show',compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data= $request->validate([
            'name_ar'=>'required',
            'name_en'=>'required'
        ]);
        departments::find($id)->update($data);
        session()->flash('success','this item has been edited');
        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        departments::destroy($id);
        session()->flash('success','this item has been deleted');
        return redirect()->route('departments.index');
    }
}
