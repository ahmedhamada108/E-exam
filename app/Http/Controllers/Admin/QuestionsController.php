<?php

namespace App\Http\Controllers\Admin;

use App\Models\mcq;
use App\Models\models;
use App\models\questions;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\answer;
use App\Models\true_false_mcq;
use Illuminate\Database\Eloquent\Builder;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class QuestionsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index($subject_id,$chapter_id)
    {
        $questions= mcq::select('id','Is_TrueFalse','question_name','subject_id','model_type_id','chapter_id')->where([
                ['subject_id',$subject_id],
                ['chapter_id',$chapter_id]
                ])->with(
                    ['subjects:id,name_'.LaravelLocalization::getCurrentLocale().' as subject_name',
                    'model_type:id,type'])->get();
        //  return $questions[0]->id;
        if(auth('admin')->id() == null){
            return view('ProfessorPanel.questions.index',compact(['questions','subject_id','chapter_id']));
        }else{
            return view('AdminPanel.questions.index',compact(['questions','subject_id','chapter_id']));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subject_id,$chapter_id)
    {
        if(auth('admin')->id() == null){
            return view('ProfessorPanel.questions.create',compact(['subject_id','chapter_id']));
        }else{
            return view('AdminPanel.questions.create',compact(['subject_id','chapter_id']));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$subject_id,$chapter_id)
    {
        $data = $request->validate([
            'question_name'=>'required| unique:mcq,question_name',
            'model_type_id'=> 'required',
            'answer'=>'required',
            'correct_answer'=>'required',
            'Is_TrueFalse'=>'required'
        ]); // end validate the data
        $data += [
            'subject_id'=>$subject_id,
            'chapter_id'=>$chapter_id
        ];// end adding the subject and chapter IDs

        $Is_TrueFalse = $request->Is_TrueFalse;
        switch ($Is_TrueFalse) {
            case (0):
                $question = mcq::create($data);
                $question_id = $question->id;

                foreach ($request['answer'] as $answer) {
                    answer::create([
                    'mcq_id'=> $question_id,
                    'answer'=> $answer
                 ]);
                }
                break; 
                // end the is multi choices case 
            case(1):
                $question = mcq::create($data);
                break;
                // end the is true & false case
        }

        if(auth('admin')->id() == null){
            session()->flash('success','the item has been added');
            return redirect()->route('professor.questions.index',[$subject_id,$chapter_id]);
        }else{
            session()->flash('success','the item has been added');
            return redirect()->route('questions.index',[$subject_id,$chapter_id]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mcq  $questions
     * @return \Illuminate\Http\Response
     */
    public function edit($subject_id,$chapter_id,$id)
    {
        $question= mcq::find($id);
        $answer= answer::where('mcq_id',$id)->get();
        // return $answer;
        if(auth('admin')->id() == null){
            return view('ProfessorPanel.questions.show',compact('chapter_id','subject_id','question','answer'));
        }else{
            return view('AdminPanel.questions.show',compact('chapter_id','subject_id','question','answer'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mcq  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$subject_id,$chapter_id)
    {
        $data = $request->validate([
            'question_name'=>['required', Rule::unique('mcq')->ignore($id)],
            'model_type_id'=> 'required',
            'answer'=>'required',
            'correct_answer'=>'required',
            'Is_TrueFalse'=>'required'
        ]); // end validate the data
        $data += [
            'subject_id'=>$subject_id,
            'chapter_id'=>$chapter_id
        ];// end adding the subject and chapter IDs
        
        $Is_TrueFalse = $request->Is_TrueFalse;
        switch ($Is_TrueFalse) {

            case (0):
                $question= mcq::find($id);
                $question->update($data);
                $question_id = $question->id;

                foreach ($request['answer'] as $answer) {
                    $answer= answer::where('mcq_id',$question_id)->get();
                    $answer->update([
                    'mcq_id'=> $question_id,
                    'answer'=> $answer
                 ]);
                }
                break; 
                // end the is multi choices case 
            case(1):
                $question= mcq::find($id);
                $question->update($data);
                break;
                // end the is true & false case
        }
        if(auth('admin')->id() == null){
            session()->flash('success','the item has been added');
            return redirect()->route('professor.questions.index',[$subject_id,$chapter_id]);
        }else{
            session()->flash('success','the item has been added');
            return redirect()->route('questions.index',[$subject_id,$chapter_id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mcq  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(mcq $questions)
    {
        return redirect()->route('questions.index');
    }
}
