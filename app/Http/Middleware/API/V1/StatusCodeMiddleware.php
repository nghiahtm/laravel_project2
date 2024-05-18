<?php

namespace App\Http\Middleware\API\V1;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusCodeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $res = $next($request);
//        if($res->getStatusCode() === 500){
//            return \response()->json(["error"=> true,"message"=>"Wrong URI"],500);
//        }
        return $res;
    }
}
