<?php

namespace App\Http\Middleware;

use App\Http\Traits\ResponseTrait;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;


class CheckLoginStudentAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (auth('student_api')->guest()) {

            JWTAuth::setToken($token)->invalidate();
            return $this->returnSuccessMessage('Logout successfully');

        }else if( auth('student')->user()->Is_active == 0){

            auth('student')->logout();
            session()->flash('error','Your request still pending.');
            return redirect()->route('login.view');
        }
        return $next($request);
    }
}
