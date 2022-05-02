<?php

namespace App\Http\Controllers\Student;

use App\Models\exam;
use App\Models\subjects;
use Illuminate\Http\Request;
use App\Models\exam_structure;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StudentSubjectController extends BaseController 
{
    public function subject_view(){

        $subjects= subjects::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            'level_id',
            'dept_id',
            'prof_id'
            )->with(
                'levels:id,name_'.LaravelLocalization::getCurrentLocale().' as name',
                'departments:id,name_'.LaravelLocalization::getCurrentLocale().' as name',
                'professors:id,name'
                )->where([
            ['level_id','=',auth('student')->user()->level_id],
            ['dept_id','=', auth('student')->user()->dept_id]
            ])->get();
        return view('Studentpanel.subjects',compact(['subjects'])); 
    }

}
