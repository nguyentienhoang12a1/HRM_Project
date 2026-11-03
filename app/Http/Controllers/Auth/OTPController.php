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
     * Bước B2 -> B5 & B13: Lấy Email từ bảng NhanVien, tạo OTP 6 số và gửi Email.
     */
    public function sendOtp(Request $request, TaiKhoan $taiKhoan): RedirectResponse
    {
        // Bước B2: Lấy địa chỉ Email từ trường email trong bảng NhanVien
        $nhanVien = $taiKhoan->nhanVien;
        $email = $nhanVien ? trim((string) $nhanVien->email) : '';

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $request->session()->forget('otp_pending_tai_khoan_id');
            return redirect()->route('login')
                ->withErrors(['otp_error' => 'Không tìm thấy địa chỉ Email để gửi mã OTP']);
        }

        // Bước B3: Tạo ngẫu nhiên mã OTP gồm 6 chữ số và thiết lập thời gian hiệu lực 5 phút
        $otpCode = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $now = now();

        MaOTP::create([
            'tai_khoan_id'      => $taiKhoan->id,
            'ma_otp'            => $otpCode,
            'thoi_gian_tao'     => $now,
            'thoi_gian_het_han' => $now->copy()->addMinutes(5),
            'da_su_dung'        => false,
        ]);

        // Bước B4, B5 & B13: Gửi Email chứa mã OTP
        try {
            Mail::to($email)->send(new OtpMail($otpCode, $nhanVien->ho_va_ten));

            // Bước B5: Chuyển đến giao diện nhập OTP kèm thông báo chuẩn
            return redirect()->route('otp.form')
                ->with('success_message', 'Mã OTP đã được gửi đến Email của bạn');
        } catch (Throwable $e) {
            // Bước B13: Ghi nhận lỗi khi gửi Email thất bại
            Log::error('Lỗi gửi Email OTP: ' . $e->getMessage());

            return redirect()->route('otp.form')
                ->withErrors(['otp_error' => 'Không thể gửi mã OTP. Vui lòng thử lại sau']);
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
     * Bước B6 -> B12: Kiểm tra mã OTP, khởi tạo Session đăng nhập và điều hướng về đúng trang của nhóm.
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $taiKhoanId = $request->session()->get('otp_pending_tai_khoan_id');
        if (!$taiKhoanId) {
            return redirect()->route('login');
        }

        // Bước B7: Kiểm tra dữ liệu đầu vào (bỏ trống hoặc không đúng định dạng 6 chữ số)
        $validator = Validator::make($request->all(), [
            'ma_otp' => ['required', 'regex:/^[0-9]{6}$/'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['otp_error' => 'Vui lòng nhập mã OTP hợp lệ']);
        }

        // Bước B8: Truy vấn CSDL kiểm tra mã OTP có tồn tại và tương ứng với tài khoản đang xác thực
        $otpRecord = MaOTP::where('tai_khoan_id', $taiKhoanId)
            ->where('ma_otp', $request->input('ma_otp'))
            ->latest('id')
            ->first();

        // Bước B9: Không tìm thấy mã OTP tương ứng
        if (!$otpRecord) {
            return back()->withErrors(['otp_error' => 'Mã OTP không chính xác, vui lòng thử lại']);
        }

        // Bước B10: Kiểm tra trạng thái sử dụng và thời gian hiệu lực (5 phút)
        if ($otpRecord->da_su_dung) {
            return back()->withErrors(['otp_error' => 'Mã OTP này đã được sử dụng']);
        }

        if ($otpRecord->isExpired()) {
            return back()->withErrors(['otp_error' => 'Mã OTP này đã hết hạn sử dụng']);
        }

        // Bước B11: Cập nhật trạng thái mã OTP thành đã sử dụng
        $otpRecord->update(['da_su_dung' => true]);

        // Bước B12: Khởi tạo Session đăng nhập và điều hướng theo vai trò tài khoản
        $taiKhoan = TaiKhoan::with(['nhanVien.chucVu.phongBan', 'phanQuyen'])->findOrFail($taiKhoanId);
        Auth::login($taiKhoan);

        $request->session()->forget('otp_pending_tai_khoan_id');
        $request->session()->regenerate();

        // Lưu đầy đủ các biến Session cho cả hệ thống của nhóm và Middleware Timeout 10 phút
        $roleKey = $taiKhoan->getRoleKey();
        $request->session()->put([
            'tai_khoan_id'            => $taiKhoan->id,
            'ten_tai_khoan'           => $taiKhoan->ten_tai_khoan,
            'ma_nhan_vien'            => $taiKhoan->ma_nhan_vien,
            'ho_va_ten'               => optional($taiKhoan->nhanVien)->ho_va_ten,
            'ma_quyen'                => $taiKhoan->ma_quyen,
            'ten_quyen'               => optional($taiKhoan->phanQuyen)->ten_quyen,
            'user_role'               => $roleKey,
            'user_scope'              => $taiKhoan->getDataScope(),
            'last_activity_timestamp' => time(),
        ]);

        // Điều hướng về đúng 5 trang Index theo vai trò mà nhóm đã dựng trong resources/views/pages/
        return match ($roleKey) {
            'admin'       => redirect()->route('pages.admin')->with('status', 'Đăng nhập Quản trị viên thành công!'),
            'giamdoc'     => redirect()->route('pages.giamdoc')->with('status', 'Chào mừng Ban Giám Đốc!'),
            'hr'          => redirect()->route('pages.hr')->with('status', 'Chào mừng bộ phận Nhân sự (HR)!'),
            'truongphong' => redirect()->route('pages.truongphong')->with('status', 'Chào mừng Trưởng phòng!'),
            default       => redirect()->route('pages.nhanvien')->with('status', 'Đăng nhập thành công!'),
        };
    }

    /**
     * Giai đoạn 3: Gửi lại mã OTP mới.
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