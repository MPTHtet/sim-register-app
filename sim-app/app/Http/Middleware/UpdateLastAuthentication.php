<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UpdateLastAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            // Update last authentication time and IP
            $user->update([
                'last_authentication_at' => now(),
                'last_authentication_ip' => $request->ip(),
            ]);
        }

        return $next($request);
    }
}
