<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu chưa đăng nhập
        if (!Auth::check()) {
            return redirect('/clients/login')->with('error', 'Bạn cần đăng nhập trước');
        }
        return $next($request);

        // Kiểm tra nếu không phải admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/clients')->with('error', 'Bạn không đủ quyền truy cập');
        }

        return $next($request);
    }
}
