<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null $role
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        if (!$request->user() || ($role && $request->user()->role !== $role)) {
            abort(403); // forbidden
        }
        return $next($request);
    }
}
