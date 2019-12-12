<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdminOnly
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
        if (auth()->user()->hasRole('superadmin')) {
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unauthorized access',
        ]);
    }
}
