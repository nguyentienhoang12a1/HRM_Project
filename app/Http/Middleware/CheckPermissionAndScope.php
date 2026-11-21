<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware xác thực phiên đăng nhập (401) và kiểm tra quyền thao tác + phạm vi dữ liệu (403).
 * Ánh xạ trực tiếp Phần B của biểu đồ UC-ROLE-01.
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

    public function handle(Request $request, Closure $next, ?string $requiredPermission = null): Response
    {
        // Cho phép luồng máy chấm công công khai chạy mà không yêu cầu đăng nhập
        if ($this->isPublicChamCongRequest($request)) {
            return $next($request);
        }

        // Bước 36-40: Trả về lỗi 401 nếu chưa đăng nhập
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Mã lỗi 401: Chưa đăng nhập hoặc phiên không hợp lệ.'], 401);
            }
            return redirect()->route('login')
                ->withErrors(['auth_error' => 'Phiên đăng nhập không hợp lệ (401). Vui lòng đăng nhập lại.']);
        }

        /** @var \App\Models\TaiKhoan $user */
        $user = Auth::user();

        // SỬA LỖI 1: Lấy trạng thái từ bảng NhanVien thông qua relationship
        $trangThaiNV = mb_strtolower(trim(optional($user->nhanVien)->trang_thai ?? ''));
        if (in_array($trangThaiNV, ['nghi viec', 'nghỉ việc', 'khoa', 'khóa', 'locked', 'disabled'], true)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->withErrors(['auth_error' => 'Tài khoản không được phép đăng nhập (Nhân viên đã nghỉ việc hoặc bị khóa).']);
        }

        // Kiểm tra quyền truy cập chức năng
        if ($requiredPermission !== null) {
            // ==========================================
            // 1. LẤY DANH SÁCH VAI TRÒ VÀ CHỨC NĂNG
            // ==========================================
            $userRoles = session('user_roles', []);
            $userPermissions = session('user_permissions', []);

            $userRoles = is_array($userRoles) ? $userRoles : [];
            $userPermissions = is_array($userPermissions) ? $userPermissions : [];

            // ==========================================
            // 2. KIỂM TRA TÀI KHOẢN CÓ VAI TRÒ HỢP LỆ
            // ==========================================
            $validRoles = [
                'VT_Admin',
                'VT_HR',
                'VT_GiamDoc',
                'VT_NhanVien',
                'VT_TruongPhong',
            ];

            $hasValidRole = !empty(array_intersect($userRoles, $validRoles));

            // ==========================================
            // 3. KIỂM TRA QUYỀN CHỨC NĂNG
            // ==========================================
            $hasPermission = in_array(
                $requiredPermission,
                $userPermissions,
                true
            );

            // ==========================================
            // 4. KIỂM TRA QUYỀN TRUY CẬP
            // ==========================================
            if (!$hasValidRole || !$hasPermission) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Mã lỗi 403: Không đủ quyền truy cập tài nguyên.'
                    ], 403);
                }

                return response()->view('errors.403', [
                    'message' => 'Mã lỗi 403: Bạn không có quyền thực hiện thao tác hoặc truy cập chức năng này.'
                ], 403);
            }
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
