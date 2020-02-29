<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminMiddleware
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
        if(Auth::check())
            {
                $user = Auth::user();
                if($user->right == 1 || $user->right == 2)
                {
                    session('userRole', $user->right);
                    return $next($request);

                }
                else
                    return redirect('admin/login')->with('thongbao','Vui lòng đăng nhập quyền Quản trị viên');              
            }
            
        else 
            return redirect('admin/login')->with('thongbao','Bạn chưa đăng nhập');
    }
}
