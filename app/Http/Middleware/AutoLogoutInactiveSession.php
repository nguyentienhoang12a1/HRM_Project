<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware kiểm tra thời gian không hoạt động của phiên đăng nhập.
 * Tự động hủy Session và đăng xuất nếu quá 10 phút (600 giây) không thao tác.
 */
class AutoLogoutInactiveSession
{
    private const MAX_IDLE_SECONDS = 600;

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $lastActivity = $request->session()->get('last_activity_timestamp');
            $currentTime = time();

            if ($lastActivity !== null && ($currentTime - $lastActivity) > self::MAX_IDLE_SECONDS) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->withErrors(['timeout' => 'Phiên đăng nhập đã hết hạn sau 10 phút không hoạt động. Hệ thống đã tự động đăng xuất.']);
            }

            $request->session()->put('last_activity_timestamp', $currentTime);
        }

        return $next($request);
    }
}