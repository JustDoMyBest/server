<?php

namespace App\Http\Middleware;

use Closure;

class CheckSuperuser
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
        // dd($request->user()->usergroup->name == '超级教师');
        if($request->user() != null && $request->user()->usergroup->name !== '超级教师'){
            // dd('Hello');
            return redirect()->intended('/frontend');
        }
        return $next($request);
    }
}
