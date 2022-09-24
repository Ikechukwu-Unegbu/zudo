<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AgentAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->access == 'admin' || auth()->user()->access == 'channel'){
            return $next($request);
        }
        return redirect()->route('admin.home');
        // return $next($request);
    }
}
