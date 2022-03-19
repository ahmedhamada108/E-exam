<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admins extends Authenticatable
{
    protected $table= 'admins';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'remember_token',
        'çreated_at',
        'updated_at'
    ];
    
}
