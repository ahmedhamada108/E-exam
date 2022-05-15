<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\exam;
use App\Models\subjects;
use App\Models\professors;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = exam::select([
            'id',
            'exam_name',
            'subject_id',
            'prof_id'
            ])->with([
            'subjects:id,name_'.LaravelLocalization::getCurrentLocale().' as name',
            'professors:id,name'
            ])->get();
        return view('AdminPanel.exams.index',compact(['exams']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects= subjects::select([
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name'
            ])->get();
        $professors = professors::select('id','name')->get();
        return view('AdminPanel.exams.create',compact(['subjects','professors']));
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
            'exam_name'=>'required| unique:exams,exam_name',
            'subject_id'=>'required',
            'prof_id'=>'required',
        ]);
        $data+=[
            'duration'=> $request->end_at,
            'start_at'=> Carbon::parse($request->start_at)->timestamp,
            'end_at'=> Carbon::parse($request->start_at)->addMinutes($request->end_at)->timestamp
        ];
        exam::create($data);
        session()->flash('success','the exam has been added');
        return redirect()->route('exams.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(exam $exam)
    {
        $exam= exam::find($exam->id);
        $subjects= subjects::select([
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            ])->get();
        $professors = professors::select('id','name')->get();
        return view('AdminPanel.exams.show',compact(['exam','subjects','professors']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, exam $exam)
    {
        $data = $request->validate([
            'exam_name'=>['required', Rule::unique('exams')->ignore($exam->id)],
            'subject_id'=>'required',
            'prof_id'=>'required',
        ]);
        $data+=[
            'duration'=> $request->end_at,
            'start_at'=> Carbon::parse($request->start_at)->timestamp,
            'end_at'=> Carbon::parse($request->start_at)->addMinutes($request->end_at)->timestamp
        ];
        exam::find($exam->id)->update($data);
        session()->flash('success','this item has been edited');
        return redirect()->route('exams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(exam $exam)
    {
        exam::destroy($exam->id);
        session()->flash('success','this item has been deleted');
        return redirect()->route('exams.index');
    }
}
