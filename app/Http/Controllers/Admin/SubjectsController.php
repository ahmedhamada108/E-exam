<?php

namespace App\Http\Controllers\Admin;

use App\Models\levels;
use App\Models\subjects;
use App\Models\professors;
use App\Models\departments;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
            if(auth('admin')->id() != null){
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

            }else{
                $subjects= subjects::select([
                    'id',
                    'level_id',
                    'prof_id',
                    'dept_id',
                    'name_'.LaravelLocalization::getCurrentLocale().' as subject_name'
                    // select from subject table 
                    ])->where('prof_id',auth('professor')->user()->id)->with([
                    'levels:id,name_'.LaravelLocalization::getCurrentLocale().' as name'
                    // select from levels table 
                    ,
                    'departments:id,name_'.LaravelLocalization::getCurrentLocale().' as dept_name'
                    // select from departments table
                    ])->get();
                return view('ProfessorPanel.subjects.index',compact('subjects'));
            }        // return $subjects;
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
            'name_ar'=>'required| unique:subjects,name_ar',
            'name_en'=>'required| unique:subjects,name_en',
            'level_id'=>'required',
            'dept_id'=>'required',
            'prof_id'=>'required',
            'subject_image'=>'required'
        ]);
        if($request->hasFile('subject_image')){
            $file_extension = $request->subject_image->getClientOriginalExtension();
            $img_name = time() . '.' . $file_extension;
            $path = storage_path('app/public/Subject_images');
            $request->subject_image->move($path, $img_name);
            $data['subject_image']='/storage/Subject_images/'.$img_name;
                // end save image file
            subjects::create($data);
            session()->flash('success',__('panel.subjects.the_subject_has_been_added'));
            return redirect()->route('subjects.index');
        }   
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

        if($request->hasFile('subject_image')){
            $file_extension = $request->subject_image->getClientOriginalExtension();
            $img_name = time() . '.' . $file_extension;
            $path = storage_path('app/public/Subject_images');
            $request->subject_image->move($path, $img_name);
            $data['subject_image']='/storage/Subject_images/'.$img_name;
                // end save image file
            $subject = subjects::find($id);
            $image = $subject->subject_image;
            File::delete(storage_path('app/public/Subject_images/'.$image));
            // delete image from the storage path
            $subject->update($data);
        }else{
            subjects::find($id)->update($data);
        }
        session()->flash('success',__('panel.subjects.this_subject_has_been_edited'));
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
        $subjects = subjects::find($id);
        $image = $subjects->subject_image;
        File::delete(storage_path('app/public/Subject_images/'.$image));
        // delete image from the storage path
        subjects::find($id)->delete();
        session()->flash('success',__('panel.subjects.this_subject_has_been_deleted'));
        return redirect()->route('subjects.index');
    }
}
