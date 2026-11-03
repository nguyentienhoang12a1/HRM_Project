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
    public function handle(Request $request, Closure $next, ?string $requiredPermission = null): Response
    {
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

        // SỬA LỖI 2: Sử dụng hàm getRoleKey() thay vì hasPermission()
        // Kiểm tra xem user có quyền admin, hoặc có vai trò khớp với $requiredPermission không
        if ($requiredPermission !== null) {
            $userRole = $user->getRoleKey();
            
            // Nếu không phải là admin VÀ không khớp với quyền được yêu cầu -> chặn lại
            if ($userRole !== 'admin' && $userRole !== $requiredPermission) {
                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Mã lỗi 403: Không đủ quyền truy cập tài nguyên.'], 403);
                }
                return response()->view('errors.403', [
                    'message' => 'Mã lỗi 403: Bạn không có quyền thực hiện thao tác hoặc truy cập chức năng này.'
                ], 403);
            }
        }

        return $next($request);
    }
}