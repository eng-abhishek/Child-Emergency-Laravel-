<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
use Illuminate\Http\Request;

class AdminLoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

     if(Auth::check())
        {
            if(auth::user()->role_id == 1){
                return redirect()->route('admin-dashboard');
            }else{
                Auth::logout();
                return redirect()->route('admin-logout');
            }
        }
    
        return $next($request);
    }
}