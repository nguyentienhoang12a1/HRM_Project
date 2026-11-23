<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TaiKhoan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Hiển thị giao diện đăng nhập.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('pages.login');
    }

    /**
     * Xử lý đăng nhập bước 1 (tài khoản + mật khẩu) và chuyển sang gửi mã OTP 6 chữ số.
     */
    public function login(Request $request): RedirectResponse
    {
        // Hỗ trợ tên input của giao diện gốc và tên field trong controller.
        if (!$request->filled('ten_tai_khoan') && $request->filled('username')) {
            $request->merge(['ten_tai_khoan' => $request->input('username')]);
        }
        if (!$request->filled('ten_tai_khoan') && $request->filled('ten_dang_nhap')) {
            $request->merge(['ten_tai_khoan' => $request->input('ten_dang_nhap')]);
        }
        if (!$request->filled('mat_khau') && $request->filled('password')) {
            $request->merge(['mat_khau' => $request->input('password')]);
        }

        $credentials = $request->validate([
            'ten_tai_khoan' => ['required', 'string', 'max:50'],
            'mat_khau'      => ['required', 'string'],
        ], [
            'ten_tai_khoan.required' => 'Vui lòng nhập tên tài khoản.',
            'mat_khau.required'      => 'Vui lòng nhập mật khẩu.',
        ]);

        $taiKhoan = TaiKhoan::with('nhanVien')
            ->where('ten_tai_khoan', trim($credentials['ten_tai_khoan']))
            ->first();

        if (!$taiKhoan) {
            return back()
                ->withInput($request->only('ten_tai_khoan', 'ten_dang_nhap'))
                ->withErrors(['login_error' => 'Tên tài khoản hoặc mật khẩu không chính xác.']);
        }

        // Kiểm tra mật khẩu (hỗ trợ cả Bcrypt lẫn mật khẩu mẫu thuần nếu nhập tay)
        $isValidPassword = Hash::check($credentials['mat_khau'], $taiKhoan->mat_khau)
            || hash_equals((string) $taiKhoan->mat_khau, (string) $credentials['mat_khau']);

        if (!$isValidPassword) {
            return back()
                ->withInput($request->only('ten_tai_khoan', 'ten_dang_nhap'))
                ->withErrors(['login_error' => 'Tên tài khoản hoặc mật khẩu không chính xác.']);
        }

        // Kiểm tra trạng thái hoạt động trên cả TaiKhoan (boolean) và NhanVien
        $blockedStatuses = [
            'nghi viec', 'nghỉ việc',
            'da nghi viec', 'đã nghỉ việc',
            'khoa', 'khóa',
            'tam khoa', 'tạm khóa',
            'locked', 'disabled',
        ];

        $employeeStatus = Str::lower(trim((string) optional($taiKhoan->nhanVien)->trang_thai_nhan_vien));

        if (!(bool) $taiKhoan->trang_thai || in_array($employeeStatus, $blockedStatuses, true)) {
            return back()
                ->withInput($request->only('ten_tai_khoan', 'ten_dang_nhap'))
                ->withErrors(['login_error' => 'Tài khoản hoặc hồ sơ nhân viên của bạn đang bị tạm khóa hoặc đã nghỉ việc.']);
        }

        // Lưu ID tài khoản chờ xác thực OTP và chuyển sang OTPController gửi mã
        $request->session()->put('otp_pending_tai_khoan_id', $taiKhoan->id);

        return app(OTPController::class)->sendOtp($request, $taiKhoan);
    }

    /**
     * Đăng xuất và hủy phiên làm việc.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'Bạn đã đăng xuất khỏi hệ thống.');
    }
}