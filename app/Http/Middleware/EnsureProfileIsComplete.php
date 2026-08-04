<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()->hasCompleteProfile()) {
            return response()->json([
                'message' => 'Silakan lengkapi profil terlebih dahulu.',
                'code' => 'PROFILE_INCOMPLETE',
            ], 403);
        }
        return $next($request);
    }
}
