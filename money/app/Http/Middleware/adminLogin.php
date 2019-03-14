<?php

namespace App\Http\Middleware;


use Closure;

class adminLogin
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
        // dd($request->route()->name('aa'));
        // if ($request->route()->named('profile')) {
        //
        // }
        //判断用户是否登录
        // if(session('adminUserInfo'))
        // {
            return $next($request);
        // }else
        // {
        //     return redirect('/admin/login');
        // }
    }
}
