<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user(); // guard web por defecto

        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        return redirect()->route('dashboard')
            ->withErrors(['error' => 'No tienes permisos para acceder a esta sección']);
    }
}
