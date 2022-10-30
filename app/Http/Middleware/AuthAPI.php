<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;
class AuthAPI
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
        if ($request->hasHeader('token') && User::where(['token' => $request->header('token')])->exists()){
            return $next($request);
        }else{
            return response()->json(['message' => "unauthneticated"]);
        }   
    }
}
