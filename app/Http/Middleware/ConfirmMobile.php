<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConfirmMobile
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
        
        if (is_null(auth()->user()->mobile)) {
            $requestURI = trim(str_replace(url()->to('/'),"", $request->getUri()), "/");
            session()->put('request-uri', $requestURI);
            return to_route("confirm-mobile.create");
        }
        return $next($request);
    }
}
