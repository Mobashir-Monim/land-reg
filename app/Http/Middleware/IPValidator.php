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
        try {
            if (!is_null(\App\Node::where('ip', $request->data->ip)->first())) {
                return $next($request);
            }
        } catch (\Exception $e) {
            // do notthing
        }
        
        return response()->json([
            'success' => false,
            'message' => "IP not recognized",
        ]);
    }
}
