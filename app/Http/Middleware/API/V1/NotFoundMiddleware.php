<?php

namespace App\Http\Middleware\API\V1;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotFoundMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $id = $request->route()->parameter("cart");
        if($response->getStatusCode() === 500){
            return  \response()->json(["error"=> "true","message"=>"ID: $id not found"],);
        }
        return $next($request);
    }
}
