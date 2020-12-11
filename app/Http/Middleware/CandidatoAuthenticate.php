<?php

namespace Dialer\Http\Middleware;

use Dialer\Models\UserLog;

use Closure;
use Event;
use Session;
use Illuminate\Support\Facades\Auth;

class CandidatoAuthenticate
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
        if (Auth::check() && Auth::user()->user_type == 'candidato' && Auth::user()->status == 1)
        {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
