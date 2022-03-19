<?php

namespace App\Http\Middleware;

use Closure;

class LoginRedirect
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
        if (auth('admin')->guest()) {

            auth('admin')->logout();
            session()->flash('error','You need to login to your account.');
            return redirect()->route('login.view');
          }
        return $next($request);
    }
    
}
