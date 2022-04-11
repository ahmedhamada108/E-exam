<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exam_structure extends Model
{
    protected $table= 'exam_structure';
    protected $fillable = [
        'id',
        'exam_id',
        'chapter_id',
        'model_type_id',
        'Is_TrueFalse',
        'number_quest',
        'created_at',
        'updated_at'
    ];
    protected $hidden= ['created_at','updated_at'];
    public function exam(){
        return $this->hasOne(exam::class,'id','exam_id');
    }
    public function chapter(){
        return $this->hasOne(chapters::class,'id','chapter_id');
    }
    public function model_type(){
        return $this->hasOne(model_type::class,'id','model_type_id');
    }
}
