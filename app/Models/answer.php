<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    protected $table= 'answer';
    protected $fillable = [
        'id',
        'mcq_id',
        'answer',
        'created_at',
        'updated_at'
    ];
}
