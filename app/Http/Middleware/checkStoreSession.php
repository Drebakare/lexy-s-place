<?php

namespace App\Http\Middleware;

use Closure;

class checkStoreSession
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
        if(session()->get('check_store_session')){
            return $next($request);
        }
        else{
            return redirect(route('store_session'))->with('You need to Select the store before you continue');
        }

    }
}
