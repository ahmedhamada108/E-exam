<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class students extends Authenticatable implements JWTSubject
{  
      use Notifiable;

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
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function level(){
        return $this->hasOne(levels::class,'id','level_id');
    }
    public function department(){
        return $this->hasOne(departments::class,'id','dept_id');
    }
    public function getRanking(){
        $collection = collect(student_grade::orderBy('student_grade', 'DESC')->get());
        $data       = $collection->where('student_id', $this->id);
        $value      = $data->keys()->first() + 1;
        return $value;
     }
}
