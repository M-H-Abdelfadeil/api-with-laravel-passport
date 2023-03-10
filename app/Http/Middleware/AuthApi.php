<?php

namespace App\Http\Middleware;

use App\Http\Helpers\MessagesHelper;
use App\Http\Helpers\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthApi
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
        if(auth('api')->check()){
            return $next($request);

        }else{
            abort(ResponseHelper::sendResponseError([],Response::HTTP_UNAUTHORIZED));
        }



    }
}
