<?php

namespace App\Http\Middleware;

use Closure;

class CheckLoginStudent
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
        if (auth('student')->guest()) {

            auth('student')->logout();
            session()->flash('error','You need to login to your account. from student');
            return redirect()->route('login.view');

        }else if( auth('student')->user()->Is_active == 0){

            auth('student')->logout();
            session()->flash('error','Your request still pending.');
            return redirect()->route('login.view');
        }
        return $next($request);
    }
}
