<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class subjects extends Model
{
    protected $table= 'subjects';
    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'subject_image',
        'dept_id',
        'level_id',
        'prof_id',
        'çreated_at',
        'updated_at'
    ];

    public function levels(){
        return $this->hasOne(levels::class,'id','level_id');
    }
    public function departments(){
        return $this->hasOne(departments::class,'id','dept_id');
    }
    
    public function professors(){
        return $this->hasOne(professors::class,'id','prof_id');
    }
}
