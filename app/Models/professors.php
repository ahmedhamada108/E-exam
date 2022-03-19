<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class professors extends Model
{
    protected $table= 'professors';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'remember_token',
        'activation',
        'çreated_at',
        'updated_at'
    ];
}
