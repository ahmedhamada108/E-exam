<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_type extends Model
{
    protected $table= 'model_type';
    protected $fillable = [
        'id',
        'type',
        'created_at',
        'updated_at'
    ];
    protected $hidden=['created_at','updated_at'];

}
