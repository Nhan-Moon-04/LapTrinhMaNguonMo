<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ví dụ: ứng dụng có cột is_admin trong bảng users
        $user = $request->user();
        
        if (!$user || !$user->is_admin) {
            // Có thể redirect về trang chủ hoặc trả 403
            abort(403, 'Bạn không có quyền truy cập khu vực quản trị.');
        }
        
        return $next($request);
    }
}
