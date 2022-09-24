<?php

namespace App\Http\Middleware;


use App\User;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Validator;
use Closure;

class CheckTokenExpires 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle($request, Closure $next)
    {
        
        $user = $request->user();
        $expires_at = $user->expires_at;
        $nowdate = Carbon::now();
        if($expires_at < $nowdate){
            return response()->json(['message' => "Login expired please login again"], 401);
        }else{
            return $next($request);
        }
      
        
    }
}
