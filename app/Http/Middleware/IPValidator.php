<?php

namespace App\Http\Middleware;

use Closure;

class IPValidator
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
        if (is_null(\App\Node::where('ip', $request->data['ip'])->first())) {
            return response()->json([
                'success' => false,
                'message' => "IP not recognized",
            ]);
        }
        
        return $next($request);
    }
}