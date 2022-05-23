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
            if(auth('admin')->id() == null){
                return view('ProfessorPanel.chapters.index',compact(['chapters','subject_id']));

            }else{
                return view('AdminPanel.chapters.index',compact(['chapters','subject_id']));
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($subject_id)
    {
        if(auth('admin')->id() == null){
            return view('ProfessorPanel.chapters.create',compact('subject_id'));

        }else{
            return view('AdminPanel.chapters.create',compact('subject_id'));
        }
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

        if(auth('admin')->id() == null){
            session()->flash('success',__('panel.chapters.the_chapter_has_been_added'));
            return redirect()->route('professor.chapters.index',$subject_id);  
        }else{
            session()->flash('success',__('panel.chapters.the_chapter_has_been_added'));
            return redirect()->route('chapters.index',$subject_id);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chapters  $chapters
     * @return \Illuminate\Http\Response
     */
    public function edit($subject_id,$id)
    {

        if(auth('admin')->id() == null){
            $chapters= chapters::find($id);
            return view('ProfessorPanel.chapters.show',compact(['chapters','subject_id']));
        }else{
            $chapters= chapters::find($id);
            return view('AdminPanel.chapters.show',compact(['chapters','subject_id']));
        }

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
        if(auth('admin')->id() == null){
            session()->flash('success','this item has been edited');
            return redirect()->route('professor.chapters.index',$subject_id);
        }else{
            session()->flash('success',__('panel.chapters.this_chapter_has_been_edited'));
            return redirect()->route('chapters.index',$subject_id);
        }

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

        if(auth('admin')->id() == null){
            session()->flash('success',__('panel.chapters.this_chapter_has_been_deleted'));
            return redirect()->route('professor.chapters.index',$subject_id);  
        }else{
            session()->flash('success',__('panel.chapters.this_chapter_has_been_deleted'));
            return redirect()->route('chapters.index',$subject_id);
        }
    }
}
