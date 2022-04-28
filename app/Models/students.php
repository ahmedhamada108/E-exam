<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class students extends Authenticatable
{
    protected $table= 'students';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'level_id',
        'dept_id',
        'remember_token',
        'Is_active',
        'created_at',
        'updated_at'
    ];
}
