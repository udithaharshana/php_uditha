<?php

namespace App\Http\Middleware;

use Closure;

class CheckRequestType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if( $request->method() == $type){
            return $next($request);
        }else{
            return abort(404);
        }
    }
}
