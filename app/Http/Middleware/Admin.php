<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        //dd($user->email);
        if ($user->level == 1){

        }else{
            return redirect(url('/profile'));
        }
        return $next($request);
    }
}
