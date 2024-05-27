<?php

namespace App\Http\Middleware\API\V1;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user->roles != "1") {
            return \response()->json([
                'data'=>null,
                "message"=>"Not Admin",
                "status_code"=>401
            ],
                401
            );
        }
        return $next($request);
    }
}
