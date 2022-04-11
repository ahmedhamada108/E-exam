<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mcq extends Model
{
    protected $table= 'mcq';
    protected $fillable = [
        'id',
        'question_name',
        'correct_answer',
        'Is_TrueFalse',
        'subject_id',
        'model_type_id',
        'chapter_id',
        'created_at',
        'updated_at'
    ];
    public function subjects(){
        return $this->hasMany(subjects::class,'id','subject_id');
    }
    public function chapter(){
        return $this->hasMany(chapters::class,'id','chapter_id');
    }
    public function model_type(){
        return $this->hasMany(model_type::class,'id','model_type_id');
    }

}
