<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exam extends Model
{
    protected $table= 'exams';
    protected $fillable = [
        'id',
        'exam_name',
        'subject_id',
        'prof_id',
        'start_at',
        'duration',
        'end_at',
        'created_at',
        'updated_at'
    ];
    protected $hidden=[
        'created_at',
        'updated_at'
    ];
    public function subjects(){
        return $this->hasOne(subjects::class,'id','subject_id');
    }
    public function professors(){
        return $this->hasOne(professors::class,'id','prof_id');
    }
}
