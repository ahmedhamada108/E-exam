<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class professors extends Authenticatable
{
    protected $table= 'professors';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'remember_token',
        'activation',
        'created_at',
        'updated_at'
    ];
}
