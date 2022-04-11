<?php

namespace App\Http\Controllers\Admin;

use App\Models\chapters;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ChaptersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($subject_id)
    {
        $chapters= chapters::select([
            'id',
            'subject_id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name'
            ])->with([
            'subjects:id,name_'.LaravelLocalization::getCurrentLocale().' as subject_name'
            ])->where('subject_id',$subject_id)->get();

        return view('AdminPanel.chapters.index',compact(['chapters','subject_id']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($subject_id)
    {
        return view('AdminPanel.chapters.create',compact('subject_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request,$subject_id)
    {

        $data = $request->validate([
            'name_ar'=>'required| unique:chapters,name_ar',
            'name_en'=>'required| unique:chapters,name_en',
        ]);

        $data['subject_id']=$subject_id;
        chapters::create($data);
        session()->flash('success','the chapter has been added');
        return redirect()->route('chapters.index',$subject_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chapters  $chapters
     * @return \Illuminate\Http\Response
     */
    public function edit($subject_id,$id)
    {
        $chapters= chapters::find($id);
        return view('AdminPanel.chapters.show',compact(['chapters','subject_id']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\chapters  $chapters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subject_id,$id)
    {
        $data = $request->validate([
            'name_ar'=>['required', Rule::unique('chapters')->ignore($id)],
            'name_en'=>['required', Rule::unique('chapters')->ignore($id)]
        ]);
        chapters::find($id)->update($data);
        session()->flash('success','this item has been edited');
        return redirect()->route('chapters.index',$subject_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chapters  $chapters
     * @return \Illuminate\Http\Response
     */
    public function destroy($subject_id,$id)
    {
        chapters::destroy($id);
        session()->flash('success','this item has been deleted');
        return redirect()->route('chapters.index',$subject_id);
    }
}
