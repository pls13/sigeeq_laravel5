<?php

namespace App\Http\Middleware;

use Closure;

class AdminMW
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
        $user = $request->user();
        if(($user instanceof \App\User)&& $user->profile->name == 'Admin'){
            return $next($request);
        }else{
            //return abort(401);
            throw new \Exception("Acesso NEGADO");
        }
    }
}
