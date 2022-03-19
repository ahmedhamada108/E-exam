<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class levels extends Model
{
    
    protected $table ='levels';
    protected $fillable = ['id','name_ar','name_en','created_at','updated_at'];
}
