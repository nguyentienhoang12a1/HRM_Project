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
 */
class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm(): View
    {
        return view('auth.forgot-password');
    }

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

        if (!(bool) $taiKhoan->trang_thai) {
            return back()
                ->withInput()
                ->withErrors(['forgot_error' => 'Tài khoản này đang bị tạm khóa, không thể khôi phục mật khẩu.']);
        }

        $nhanVien = $taiKhoan->nhanVien;
        $email = $nhanVien ? trim((string) $nhanVien->email) : '';

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return back()
                ->withInput()
                ->withErrors(['forgot_error' => 'Không tìm thấy địa chỉ Email hợp lệ để gửi mã OTP.']);
        }

        // Vô hiệu hóa mã OTP cũ chưa sử dụng
        MaOTP::where('tai_khoan_id', $taiKhoan->id)
            ->where('da_su_dung', false)
            ->update(['da_su_dung' => true]);

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
            $employeeName = trim((string) ($nhanVien->ho_va_ten
                ?: trim((string) $nhanVien->ho . ' ' . (string) $nhanVien->ten)
                ?: $taiKhoan->ten_tai_khoan));

            Mail::to($email)->send(new OtpMail($otpCode, $employeeName));

            return redirect()->route('password.reset.form')
                ->with('success_message', 'Mã OTP đã được gửi đến Email của bạn.');
        } catch (Throwable $e) {
            Log::error('Lỗi gửi Email OTP khôi phục mật khẩu: ' . $e->getMessage());

            return redirect()->route('password.reset.form')
                ->withErrors(['otp_error' => 'Không thể gửi mã OTP. Vui lòng thử lại sau.']);
        }
    }

    public function showResetForm(Request $request): View|RedirectResponse
    {
        if (!$request->session()->has('password_reset_tai_khoan_id')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $taiKhoanId = $request->session()->get('password_reset_tai_khoan_id');
        if (!$taiKhoanId) {
            return redirect()->route('password.request');
        }

        $otpValidator = Validator::make($request->all(), [
            'ma_otp' => ['required', 'regex:/^[0-9]{6}$/'],
        ]);

        if ($otpValidator->fails()) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['otp_error' => 'Vui lòng nhập mã OTP hợp lệ (6 chữ số).']);
        }

        if (!$request->filled('new_password') || !$request->filled('new_password_confirmation')) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['password_error' => 'Thông báo thiếu dữ liệu: Vui lòng nhập đầy đủ mật khẩu mới và xác nhận mật khẩu.']);
        }

        $otpRecord = MaOTP::where('tai_khoan_id', $taiKhoanId)
            ->where('ma_otp', $request->input('ma_otp'))
            ->latest('id')
            ->first();

        if (!$otpRecord) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['otp_error' => 'Mã OTP không chính xác, vui lòng thử lại.']);
        }

        if ($otpRecord->da_su_dung) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['otp_error' => 'Mã OTP này đã được sử dụng.']);
        }

        if ($otpRecord->isExpired()) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['otp_error' => 'Mã OTP này đã hết hạn sử dụng.']);
        }

        $newPassword = (string) $request->input('new_password');
        $policyPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        if (!preg_match($policyPattern, $newPassword)) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['password_error' => 'Mật khẩu mới không đạt yêu cầu: Phải từ 8 ký tự, gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt.']);
        }

        if ($newPassword !== (string) $request->input('new_password_confirmation')) {
            return back()->withInput($request->only('ma_otp'))
                ->withErrors(['password_error' => 'Mật khẩu không trùng khớp: Vui lòng xác nhận lại mật khẩu mới.']);
        }

        try {
            $taiKhoan = TaiKhoan::findOrFail($taiKhoanId);

            if (Hash::check($newPassword, $taiKhoan->mat_khau) || $newPassword === $taiKhoan->mat_khau) {
                return back()->withInput($request->only('ma_otp'))
                    ->withErrors(['password_error' => 'Mật khẩu mới không được trùng với mật khẩu hiện tại.']);
            }

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