<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chapters extends Model
{
    protected $table= 'chapters';
    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'subject_id',
        'created_at',
        'updated_at'
    ];

    public function subjects(){
        return $this->hasOne(subjects::class,'id','subject_id');
    }
}
