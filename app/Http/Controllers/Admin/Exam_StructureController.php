<?php

namespace App\Http\Controllers\Admin;

use App\Models\exam;
use App\Models\chapters;
use App\Models\model_type;
use Illuminate\Http\Request;
use App\Models\exam_structure;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Exam_StructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($exam_id)
    {
        $exam_structures = exam_structure::where('exam_id',$exam_id)->with([
            'exam:id,exam_name,subject_id',
            'chapter:id,name_'.LaravelLocalization::getCurrentLocale().' as name',
            'model_type:id,type'
            ])->get();
            // return $exam_structures[0]->exam->id;
            if(auth('admin')->id() == null){
                return view('ProfessorPanel.exam_structure.index',compact(['exam_structures','exam_id']));
            }else{
                return view('AdminPanel.exam_structure.index',compact(['exam_structures','exam_id']));
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($exam_id)
    {
       $exam= exam::where('id',$exam_id)->get();
        $subject_id = $exam[0]->subject_id ;
        $models_type = model_type::all();
        $chapters = chapters::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name'
            )->where('subject_id',$subject_id)->get();
            if(auth('admin')->id() == null){
                return view('ProfessorPanel.exam_structure.create',compact(['chapters','models_type','subject_id','exam_id']));
            }else{
                return view('AdminPanel.exam_structure.create',compact(['chapters','models_type','subject_id','exam_id']));
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$exam_id)
    {
        $data = $request->validate([
            'chapter_id'=>'required',
            'model_type_id'=>'required',
            'Is_TrueFalse'=>'required',
            'number_quest'=>'required'
        ]);
        $data['exam_id']=$exam_id;
        exam_structure::create($data);

        if(auth('admin')->id() == null){
            session()->flash('success','the exam structure has been added');
            return redirect()->route('professor.exam_structure.index',$exam_id);
        }else{
            session()->flash('success','the exam structure has been added');
            return redirect()->route('exam_structure.index',$exam_id);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\exam_structure  $exam_structure
     * @return \Illuminate\Http\Response
     */
    public function edit($exam_id,$id)
    {
        $exam_structure= exam_structure::with([
            'exam:id,exam_name,subject_id',
            'chapter:id,name_'.LaravelLocalization::getCurrentLocale().' as name',
            'model_type:id,type'
        ])->find($id);
        $subject_id = $exam_structure['exam']->subject_id;
        $models_type = model_type::all();
        $chapters = chapters::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name'
            )->where('subject_id',$subject_id)->get();   
            if(auth('admin')->id() == null){
                return view('ProfessorPanel.exam_structure.show',compact(['chapters','exam_structure','models_type','subject_id','exam_id']));
            }else{
                return view('AdminPanel.exam_structure.show',compact(['chapters','exam_structure','models_type','subject_id','exam_id']));
            }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\exam_structure  $exam_structure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $exam_id,$id)
    {
        $data = $request->validate([
            'chapter_id'=>'required',
            'model_type_id'=>'required',
            'Is_TrueFalse'=>'required',
            'number_quest'=>'required'
        ]);
        $data['exam_id']=$exam_id;
        $data;
        exam_structure::find($id)->update($data);
        if(auth('admin')->id() == null){
            session()->flash('success','this item has been edited');
            return redirect()->route('professor.exam_structure.index',$exam_id);
        }else{
            session()->flash('success','this item has been edited');
            return redirect()->route('exam_structure.index',$exam_id);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\exam_structure  $exam_structure
     * @return \Illuminate\Http\Response
     */
    public function destroy($exam_id,$id)
    {
        exam_structure::destroy($id);
        if(auth('admin')->id() == null){
            session()->flash('success','this item has been deleted');
            return redirect()->route('professor.exam_structure.index',$exam_id);
        }else{
            session()->flash('success','this item has been deleted');
            return redirect()->route('exam_structure.index',$exam_id);
        }

    }
}
