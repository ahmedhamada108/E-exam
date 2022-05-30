<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student_grade extends Model
{
    protected $table= 'student_grade';
    protected $fillable = [
        'id',
        'exam_id',
        'student_id',
        'exam_grade',
        'student_grade',
        'created_at',
        'updated_at'
    ];
    public function exam(){
        return $this->hasOne(exam::class,'id','exam_id');
    }
    public function student(){
        return $this->hasOne(students::class,'id','student_id');
    }
}
