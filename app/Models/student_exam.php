<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student_exam extends Model
{
    protected $table= 'student_exam';
    protected $fillable = [
        'id',
        'exam_id',
        'student_id',
        'mcq_id',
        'correct_answer',
        'student_answer',
        'created_at',
        'updated_at'
    ];
    public function exam_id(){
        return $this->hasOne(exam::class,'id','exam_id');
    }
    public function exam(){
        return $this->hasOne(exam::class,'id','exam_id');
    }
    public function mcq(){
        return $this->hasone(mcq::class,'id','mcq_id');
    }
}
