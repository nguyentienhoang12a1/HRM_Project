<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $roles = session('user_roles', []);
        if (empty($roles) && method_exists($user, 'vaiTros')) {
            $roles = $user->vaiTros()
                ->where('VaiTro.trang_thai', true)
                ->pluck('VaiTro.ma_vai_tro')
                ->toArray();
            session(['user_roles' => $roles]);
        }

        $allowedRoles = ['VT_Admin', 'VT_HR'];
        $hasAccess = !empty(array_intersect($roles, $allowedRoles))
            || (method_exists($user, 'hasRole') && $user->hasRole($allowedRoles));

        if (!$hasAccess) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Chỉ tài khoản Admin hoặc HR mới có quyền truy cập chức năng này!',
                ], 403);
            }

            abort(403, 'Chỉ tài khoản Admin hoặc HR mới có quyền đăng ký FaceID.');
        }

        return $next($request);
    }
}