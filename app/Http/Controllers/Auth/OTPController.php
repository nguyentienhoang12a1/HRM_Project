<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\MaOTP;
use App\Models\TaiKhoan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Throwable;

/**
 * OTPController: Xử lý xác thực người dùng bằng mã OTP 6 số qua Email (Hiệu lực 5 phút).
 */
class OTPController extends Controller
{
    /**
     * Lấy Email từ bảng NhanVien, vô hiệu hóa OTP cũ, tạo OTP 6 số mới và gửi Email.
     */
    public function sendOtp(Request $request, TaiKhoan $taiKhoan): RedirectResponse
    {
        $nhanVien = $taiKhoan->nhanVien;
        $email = $nhanVien ? trim((string) $nhanVien->email) : '';

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $request->session()->forget('otp_pending_tai_khoan_id');
            return redirect()->route('login')
                ->withErrors(['otp_error' => 'Không tìm thấy địa chỉ Email hợp lệ để gửi mã OTP.']);
        }

        // Vô hiệu hóa các mã OTP cũ chưa sử dụng của tài khoản này
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

        try {
            $employeeName = trim((string) ($nhanVien->ho_va_ten
                ?: trim((string) $nhanVien->ho . ' ' . (string) $nhanVien->ten)
                ?: $taiKhoan->ten_tai_khoan));

            Mail::to($email)->send(new OtpMail($otpCode, $employeeName));

            return redirect()->route('otp.form')
                ->with('success_message', 'Mã OTP đã được gửi đến Email của bạn.');
        } catch (Throwable $e) {
            Log::error('Lỗi gửi Email OTP: ' . $e->getMessage());

            return redirect()->route('otp.form')
                ->withErrors(['otp_error' => 'Không thể gửi mã OTP. Vui lòng thử lại sau.']);
        }
    }

    /**
     * Hiển thị giao diện nhập mã OTP.
     */
    public function showVerifyForm(Request $request): View|RedirectResponse
    {
        if (!$request->session()->has('otp_pending_tai_khoan_id')) {
            return redirect()->route('login');
        }

        return view('auth.verify-otp');
    }

    /**
     * Kiểm tra mã OTP, khởi tạo Session đăng nhập và điều hướng theo vai trò.
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $taiKhoanId = $request->session()->get('otp_pending_tai_khoan_id');
        if (!$taiKhoanId) {
            return redirect()->route('login');
        }

        $validator = Validator::make($request->all(), [
            'ma_otp' => ['required', 'regex:/^[0-9]{6}$/'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['otp_error' => 'Vui lòng nhập mã OTP hợp lệ (6 chữ số).']);
        }

        $otpRecord = MaOTP::where('tai_khoan_id', $taiKhoanId)
            ->where('ma_otp', $request->input('ma_otp'))
            ->latest('id')
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp_error' => 'Mã OTP không chính xác, vui lòng thử lại.']);
        }

        if ($otpRecord->da_su_dung) {
            return back()->withErrors(['otp_error' => 'Mã OTP này đã được sử dụng.']);
        }

        if ($otpRecord->isExpired()) {
            return back()->withErrors(['otp_error' => 'Mã OTP này đã hết hạn sử dụng.']);
        }

        $otpRecord->update(['da_su_dung' => true]);

        $taiKhoan = TaiKhoan::with(['vaiTros.chucNangs', 'nhanVien'])->findOrFail($taiKhoanId);
        Auth::login($taiKhoan);

        $request->session()->forget('otp_pending_tai_khoan_id');
        $request->session()->regenerate();

        $activeRoles = $taiKhoan->vaiTros->where('trang_thai', true);
        $roleKeys = $activeRoles->pluck('ma_vai_tro')->toArray();

        $userPermissions = $activeRoles
            ->flatMap(fn ($vaiTro) => $vaiTro->chucNangs)
            ->filter(fn ($chucNang) => $chucNang->trang_thai && $chucNang->pivot->duoc_thuc_hien)
            ->pluck('ma_chuc_nang')
            ->unique()
            ->values()
            ->toArray();

        $userScope = $activeRoles
            ->flatMap(fn ($vaiTro) => $vaiTro->chucNangs)
            ->filter(fn ($chucNang) => $chucNang->trang_thai && $chucNang->pivot->duoc_thuc_hien)
            ->map(fn ($chucNang) => [
                'ma_chuc_nang' => $chucNang->ma_chuc_nang,
                'ma_pham_vi'   => $chucNang->pivot->ma_pham_vi,
            ])
            ->values()
            ->toArray();

        $request->session()->put([
            'tai_khoan_id'            => $taiKhoan->id,
            'ten_tai_khoan'           => $taiKhoan->ten_tai_khoan,
            'ma_nhan_vien'            => $taiKhoan->ma_nhan_vien,
            'ho_va_ten'               => optional($taiKhoan->nhanVien)->ho_va_ten,
            'user_roles'              => $roleKeys,
            'user_permissions'        => $userPermissions,
            'user_scope'              => $userScope,
            'last_activity_timestamp' => time(),
        ]);

        return match (true) {
            in_array('VT_Admin', $roleKeys, true) => redirect()->route('pages.admin')
                ->with('status', 'Đăng nhập Quản trị viên thành công!'),

            in_array('VT_GiamDoc', $roleKeys, true) => redirect()->route('pages.giamdoc')
                ->with('status', 'Chào mừng Ban Giám Đốc!'),

            in_array('VT_HR', $roleKeys, true) => redirect()->route('pages.hr')
                ->with('status', 'Chào mừng bộ phận Nhân sự (HR)!'),

            in_array('VT_TruongPhong', $roleKeys, true) => redirect()->route('pages.truongphong')
                ->with('status', 'Chào mừng Trưởng phòng!'),

            default => redirect()->route('pages.nhanvien')
                ->with('status', 'Đăng nhập thành công!'),
        };
    }

    /**
     * Gửi lại mã OTP mới.
     */
    public function resendOtp(Request $request): RedirectResponse
    {
        $taiKhoanId = $request->session()->get('otp_pending_tai_khoan_id');
        if (!$taiKhoanId) {
            return redirect()->route('login');
        }

        $taiKhoan = TaiKhoan::with('nhanVien')->findOrFail($taiKhoanId);
        return $this->sendOtp($request, $taiKhoan);
    }
}