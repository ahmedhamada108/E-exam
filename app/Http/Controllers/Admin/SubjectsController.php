<?php

namespace App\Http\Controllers\Admin;

use App\Models\levels;
use App\Models\subjects;
use App\Models\professors;
use App\Models\departments;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects= subjects::select([
            'id',
            'level_id',
            'dept_id',
            'name_'.LaravelLocalization::getCurrentLocale().' as subject_name'
            // select from subject table 
            ])->with([
            'levels:id,name_'.LaravelLocalization::getCurrentLocale().' as name'
            // select from levels table 
            ,
            'departments:id,name_'.LaravelLocalization::getCurrentLocale().' as dept_name'
            // select from departments table
            ])->get();

        return view('AdminPanel.subjects.index',compact('subjects'));
        // return $subjects;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = levels::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name'
            )->get();
        $deaprtments= departments::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name'
            )->get();
        $professors = professors::all();
        return view('AdminPanel.subjects.create',compact(['levels','deaprtments','professors']));
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
            'name_ar'=>'required|name_ar|unique:subjects',
            'name_en'=>'required|name_en|unique:subjects',
            'level_id'=>'required',
            'dept_id'=>'required',
            'prof_id'=>'required'
        ]);
        subjects::create($data);
        session()->flash('success','the subject has been added');
        return redirect()->route('subjects.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subjects= subjects::with(['levels','departments','professors'])->find($id);
        $levels = levels::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name')->get();

            // return the levels records 

        $departments = departments::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name')->get();

            // return the departments records

        $professors = professors::all();
        return view('AdminPanel.subjects.show',compact(['subjects','levels','departments','professors']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data= $request->validate([
            'name_ar'=>['required', Rule::unique('subjects')->ignore($id)],
            'name_en'=>['required', Rule::unique('subjects')->ignore($id)],
            'level_id'=>'required',
            'dept_id'=>'required',
            'prof_id'=>'required'
        ]);
        subjects::find($id)->update($data);
        session()->flash('success','this item has been edited');
        return redirect()->route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        subjects::find($id)->delete();
        session()->flash('success','this item has been deleted');
        return redirect()->route('subjects.index');
    }
}
