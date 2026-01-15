<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth('api')->user();

        if($user && $user->role === 'admin'){
            return $next($request);
        }else{
            return response()->json(['error' => 'No eres administrador'], 403);
        }
    }
}
