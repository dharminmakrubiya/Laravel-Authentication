<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
class CustomAuth
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

        // echo "Hello this is a middleware";

        // die();

        // $path = $request->path();

    

        // echo $path;
        // if (($path=="login" || $path=="registration" && Session::get('user')) )  {
        //     // die('Middleware worked');
            
        //     return redirect('dashboard')->with('message', 'You are alerady Logged-in!');
            
        // }

        return $next($request);
    }
}
