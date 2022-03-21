<?php

namespace App\Http\Middleware;

use Closure;

class CheckLoginProf
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
        if (auth('professor')->guest()) {

            auth('professor')->logout();
            session()->flash('error','You need to login to your account. from prof');
            return redirect()->route('login.view');

        }else if( auth('professor')->user()->activation == 0){

            auth('professor')->logout();
            session()->flash('error','Your request still pending.');
            return redirect()->route('login.view');
        }
        return $next($request);
    }
}
