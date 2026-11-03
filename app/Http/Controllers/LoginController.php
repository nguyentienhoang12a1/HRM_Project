<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\OTPController;
use App\Models\TaiKhoan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

/**
 * LoginController: Đặt tại namespace App\Http\Controllers theo đúng cấu trúc nhóm.
 * Thực thi UC-AUTH-01 và kích hoạt xác thực OTP qua Email.
 */
class LoginController extends Controller
{
    /**
     * Hiển thị giao diện đăng nhập của nhóm (resources/views/pages/login.blade.php).
     */
    public function showLoginForm(): View
    {
        return view('pages.login');
    }

    /**
     * Xử lý yêu cầu đăng nhập (UC-AUTH-01) và chuyển tiếp sang gửi mã OTP (Bước B1).
     */
    public function login(Request $request, OTPController $otpController): RedirectResponse
    {
        // Tương thích với mọi tên thẻ input mà giao diện nhóm có thể đặt
        $loginInput = trim((string) ($request->input('ten_tai_khoan')
            ?? $request->input('ten_dang_nhap')
            ?? $request->input('username')
            ?? $request->input('email')));

        $passwordInput = (string) ($request->input('mat_khau')
            ?? $request->input('password'));

        // Bước 6-8 (UC-AUTH-01 - Nhánh E1: Dữ liệu không hợp lệ)
        if ($loginInput === '' || $passwordInput === '') {
            return back()
                ->withInput()
                ->withErrors(['login_error' => 'Dữ liệu không hợp lệ: Vui lòng nhập đầy đủ tài khoản và mật khẩu.']);
        }

        try {
            // Bước 9-10 (UC-AUTH-01): Tìm tài khoản theo ten_tai_khoan hoặc email trong bảng NhanVien
            $taiKhoan = TaiKhoan::with(['nhanVien', 'phanQuyen'])
                ->where('ten_tai_khoan', $loginInput)
                ->orWhereHas('nhanVien', function ($query) use ($loginInput) {
                    $query->where('email', $loginInput);
                })
                ->first();

            // Bước 11-13 (UC-AUTH-01 - Nhánh E2: Sai tài khoản hoặc mật khẩu)
            // Hỗ trợ kiểm tra cả mật khẩu đã băm (Bcrypt) lẫn mật khẩu thuần nếu nhóm nhập tay trong SQL
            $isPasswordValid = false;
            if ($taiKhoan) {
                $isPasswordValid = Hash::check($passwordInput, $taiKhoan->mat_khau)
                    || $passwordInput === $taiKhoan->mat_khau;
            }

            if (!$taiKhoan || !$isPasswordValid) {
                return back()
                    ->withInput()
                    ->withErrors(['login_error' => 'Đăng nhập không thành công: Tên tài khoản hoặc mật khẩu không chính xác.']);
            }

            // Bước 14-16 (UC-AUTH-01 - Nhánh E3: Kiểm tra trạng thái hoạt động của nhân viên)
            $trangThaiNV = mb_strtolower(trim(optional($taiKhoan->nhanVien)->trang_thai ?? ''));
            if (in_array($trangThaiNV, ['nghi viec', 'nghỉ việc', 'khoa', 'khóa', 'locked', 'disabled'], true)) {
                return back()
                    ->withInput()
                    ->withErrors(['login_error' => 'Tài khoản không được phép đăng nhập (Nhân viên đã nghỉ việc hoặc bị khóa).']);
            }

            // Lưu tạm ID tài khoản vào Session để chờ xác thực OTP (Bước B1)
            $request->session()->put('otp_pending_tai_khoan_id', $taiKhoan->id);

            // Chuyển sang OTPController để lấy Email nhân viên, tạo mã OTP 6 số và gửi mail
            return $otpController->sendOtp($request, $taiKhoan);

        } catch (Throwable $e) {
            // Bước 23-24 (UC-AUTH-01 - Nhánh E4: Lỗi hệ thống)
            Log::error('Lỗi đăng nhập: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['login_error' => 'Không thể xử lý yêu cầu lúc này. Vui lòng thử lại.']);
        }
    }

    /**
     * Đăng xuất và xóa sạch Session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Đã đăng xuất khỏi hệ thống.');
    }
}