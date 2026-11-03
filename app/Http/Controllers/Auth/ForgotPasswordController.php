<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\MaOTP;
use App\Models\TaiKhoan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Throwable;

/**
 * ForgotPasswordController: Khôi phục mật khẩu qua mã xác thực Email OTP (6 số, hạn 5 phút).
 * Đồng bộ hoàn toàn với bảng TaiKhoan (ten_tai_khoan, mat_khau) và NhanVien (ho_va_ten, email) trong HRM.sql.
 */
class ForgotPasswordController extends Controller
{
    /**
     * Hiển thị giao diện nhập Tên tài khoản / Email để nhận OTP khôi phục mật khẩu.
     */
    public function showLinkRequestForm(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Tìm tài khoản theo ten_tai_khoan hoặc email nhân viên, sinh OTP 6 số (hạn 5 phút) và gửi Gmail.
     */
    public function sendResetOtp(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'login_identifier' => ['required', 'string', 'max:150'],
        ], [
            'login_identifier.required' => 'Vui lòng nhập Tên tài khoản hoặc địa chỉ Email nhân viên.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $identifier = trim((string) $request->input('login_identifier'));

        // Tìm theo cột ten_tai_khoan (bảng TaiKhoan) hoặc email (bảng NhanVien)
        $taiKhoan = TaiKhoan::with('nhanVien')
            ->where('ten_tai_khoan', $identifier)
            ->orWhereHas('nhanVien', function ($query) use ($identifier) {
                $query->where('email', $identifier);
            })
            ->first();

        if (!$taiKhoan) {
            return back()
                ->withInput()
                ->withErrors(['forgot_error' => 'Không tìm thấy tài khoản nào khớp với thông tin bạn vừa nhập.']);
        }

        $nhanVien = $taiKhoan->nhanVien;
        $email = $nhanVien ? trim((string) $nhanVien->email) : '';

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return back()
                ->withInput()
                ->withErrors(['forgot_error' => 'Không tìm thấy địa chỉ Email để gửi mã OTP']);
        }

        // Tạo ngẫu nhiên mã OTP gồm 6 chữ số có hiệu lực 5 phút
        $otpCode = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $now = now();

        MaOTP::create([
            'tai_khoan_id'      => $taiKhoan->id,
            'ma_otp'            => $otpCode,
            'thoi_gian_tao'     => $now,
            'thoi_gian_het_han' => $now->copy()->addMinutes(5),
            'da_su_dung'        => false,
        ]);

        $request->session()->put('password_reset_tai_khoan_id', $taiKhoan->id);

        try {
            Mail::to($email)->send(new OtpMail($otpCode, $nhanVien->ho_va_ten));

            return redirect()->route('password.reset.form')
                ->with('success_message', 'Mã OTP đã được gửi đến Email của bạn');
        } catch (Throwable $e) {
            Log::error('Lỗi gửi Email OTP khôi phục mật khẩu: ' . $e->getMessage());

            return redirect()->route('password.reset.form')
                ->withErrors(['otp_error' => 'Không thể gửi mã OTP. Vui lòng thử lại sau']);
        }
    }

    /**
     * Hiển thị giao diện nhập mã OTP và mật khẩu mới.
     */
    public function showResetForm(Request $request): View|RedirectResponse
    {
        if (!$request->session()->has('password_reset_tai_khoan_id')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    /**
     * Kiểm tra mã OTP (6 số, chưa dùng, còn hạn 5 phút) và cập nhật mật khẩu mới theo chính sách UC-AUTH-03.
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        $taiKhoanId = $request->session()->get('password_reset_tai_khoan_id');
        if (!$taiKhoanId) {
            return redirect()->route('password.request');
        }

        // Bước B7: Kiểm tra định dạng mã OTP 6 chữ số
        $otpValidator = Validator::make($request->all(), [
            'ma_otp' => ['required', 'regex:/^[0-9]{6}$/'],
        ]);

        if ($otpValidator->fails()) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['otp_error' => 'Vui lòng nhập mã OTP hợp lệ']);
        }

        // Nhánh E1 (UC-AUTH-03): Kiểm tra thiếu dữ liệu mật khẩu
        if (!$request->filled('new_password') || !$request->filled('new_password_confirmation')) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['password_error' => 'Thông báo thiếu dữ liệu: Vui lòng nhập đầy đủ mật khẩu mới và xác nhận mật khẩu.']);
        }

        // Bước B8-B9: Truy vấn mã OTP trong CSDL
        $otpRecord = MaOTP::where('tai_khoan_id', $taiKhoanId)
            ->where('ma_otp', $request->input('ma_otp'))
            ->latest('id')
            ->first();

        if (!$otpRecord) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['otp_error' => 'Mã OTP không chính xác, vui lòng thử lại']);
        }

        // Bước B10: Kiểm tra trạng thái sử dụng và thời hạn 5 phút
        if ($otpRecord->da_su_dung) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['otp_error' => 'Mã OTP này đã được sử dụng']);
        }

        if ($otpRecord->isExpired()) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['otp_error' => 'Mã OTP này đã hết hạn sử dụng']);
        }

        // Nhánh E3 (UC-AUTH-03): Kiểm tra chính sách mật khẩu mới
        $newPassword = (string) $request->input('new_password');
        $policyPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        if (!preg_match($policyPattern, $newPassword)) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['password_error' => 'Mật khẩu mới không đạt yêu cầu: Phải từ 8 ký tự, gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt.']);
        }

        // Nhánh E4 (UC-AUTH-03): So sánh mật khẩu xác nhận
        if ($newPassword !== (string) $request->input('new_password_confirmation')) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['password_error' => 'Mật khẩu không trùng khớp: Vui lòng xác nhận lại mật khẩu mới.']);
        }

        // Bước B11 & Bước 21-27 (UC-AUTH-03): Đánh dấu OTP đã sử dụng và cập nhật mật khẩu băm
        try {
            $taiKhoan = TaiKhoan::findOrFail($taiKhoanId);

            $otpRecord->update(['da_su_dung' => true]);
            $taiKhoan->update(['mat_khau' => Hash::make($newPassword)]);

            $request->session()->forget('password_reset_tai_khoan_id');

            return redirect()->route('login')
                ->with('status', 'Đặt lại mật khẩu thành công! Vui lòng đăng nhập bằng mật khẩu mới.');
        } catch (Throwable $e) {
            Log::error('Lỗi đặt lại mật khẩu: ' . $e->getMessage());
            return back()->withErrors(['password_error' => 'Không thể đổi mật khẩu do lỗi hệ thống.']);
        }
    }

    /**
     * Gửi lại mã OTP khôi phục mật khẩu mới.
     */
    public function resendResetOtp(Request $request): RedirectResponse
    {
        $taiKhoanId = $request->session()->get('password_reset_tai_khoan_id');
        if (!$taiKhoanId) {
            return redirect()->route('password.request');
        }

        $taiKhoan = TaiKhoan::with('nhanVien')->findOrFail($taiKhoanId);
        $request->merge(['login_identifier' => $taiKhoan->ten_tai_khoan]);

        return $this->sendResetOtp($request);
    }
}