<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class departments extends Model
{
    protected $table= 'departments';
    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'created_at',
        'updated_at'
    ];
    
}
