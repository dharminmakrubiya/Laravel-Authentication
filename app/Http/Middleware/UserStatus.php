<?php

namespace App\Http\Middleware;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class UserStatus
{
    protected $auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     
    public function handle(Request $request, Closure $next)
    {

        // echo "This is UserStatus Middleware";
         

        // $user = Auth::user();
        // dd($user);

        //  if(!empty($user) && $user->status == 1){
        //     return $next($request);
        // } else {
        //     return redirect(route('login'));
        // }
        

        return $next($request);
    }
}
