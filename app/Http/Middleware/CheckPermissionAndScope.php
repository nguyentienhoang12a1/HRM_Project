<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware xác thực phiên đăng nhập (401) và kiểm tra quyền thao tác + phạm vi dữ liệu (403).
 */
class CheckPermissionAndScope
{
    /**
     * Các route name công khai cho phép truy cập không cần đăng nhập
     */
    private array $publicRouteNames = [
        'chamcong.index',
        'chamcong.facedata',
        'chamcong.face.database',
        'chamcong.checkin',
        'chamcong.luu',
        'chamcong.verify.admin.face',
    ];

    /**
     * Các đường dẫn (URI) công khai dự phòng nếu route không đặt tên
     */
    private array $publicPaths = [
        'cham-cong',
        'cham-cong/face-data',
        'cham-cong/face-database',
        'cham-cong/checkin',
        'cham-cong/luu',
        'cham-cong/kiem-tra-admin-faceid',
    ];

    public function handle(Request $request, Closure $next, ?string $maChucNang = null): Response
    {
        if ($this->isPublicChamCongRequest($request)) {
            return $next($request);
        }

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Chuẩn hóa kiểm tra trạng thái tài khoản & hồ sơ nhân viên
        $trangThaiNV = mb_strtolower(trim((string) optional($user->nhanVien)->trang_thai_nhan_vien));
        $blockedStatuses = [
            'da nghi viec', 'đã nghỉ việc',
            'nghi viec', 'nghỉ việc',
            'tam khoa', 'tạm khóa',
            'khoa', 'khóa',
        ];

        if (!(bool) $user->trang_thai || in_array($trangThaiNV, $blockedStatuses, true)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->withErrors(['login' => 'Tài khoản hoặc hồ sơ nhân sự đã ngừng hoạt động.']);
        }

        if ($maChucNang !== null) {
            if (!Gate::forUser($user)->allows($maChucNang)) {
                abort(403, 'Bạn không có quyền truy cập chức năng này.');
            }

            $dataScope = method_exists($user, 'getDataScope')
                ? $user->getDataScope($maChucNang)
                : 'self';

            $request->attributes->set('data_scope', $dataScope);
        }

        return $next($request);
    }

    private function isPublicChamCongRequest(Request $request): bool
    {
        $routeName = $request->route()?->getName();
        if ($routeName && in_array($routeName, $this->publicRouteNames, true)) {
            return true;
        }

        $path = trim($request->path(), '/');
        return in_array($path, $this->publicPaths, true);
    }
}