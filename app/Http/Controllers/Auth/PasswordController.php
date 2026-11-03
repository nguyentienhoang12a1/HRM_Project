<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TaiKhoan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Throwable;

/**
 * PasswordController: Bộ điều khiển đổi mật khẩu cá nhân (UC-AUTH-03).
 * Đồng bộ với bảng TaiKhoan (cột mat_khau) trong HRM.sql.
 */
class PasswordController extends Controller
{
    /**
     * Bước 1-2 (UC-AUTH-03): Hiển thị biểu mẫu đổi mật khẩu.
     */
    public function showChangePasswordForm(): View
    {
        return view('auth.change-password');
    }

    /**
     * Bước 5-27 (UC-AUTH-03): Kiểm tra dữ liệu, xác thực mật khẩu hiện tại,
     * kiểm tra chính sách mật khẩu mới và cập nhật vào CSDL.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        // Bước 6-8 (Nhánh E1 - Thiếu dữ liệu): Kiểm tra các trường bắt buộc
        $missingValidator = Validator::make($request->all(), [
            'current_password'          => ['required', 'string'],
            'new_password'              => ['required', 'string'],
            'new_password_confirmation' => ['required', 'string'],
        ]);

        if ($missingValidator->fails()) {
            return back()->withErrors([
                'password_error' => 'Thông báo thiếu dữ liệu: Vui lòng nhập đầy đủ mật khẩu hiện tại, mật khẩu mới và xác nhận mật khẩu mới.'
            ]);
        }

        // Truy vấn trực tiếp từ Model TaiKhoan theo Auth::id() để tránh lỗi P1013 Intelephense
        $user = TaiKhoan::findOrFail(Auth::id());

        $currentPassword = (string) $request->input('current_password');
        $newPassword     = (string) $request->input('new_password');
        $confirmPassword = (string) $request->input('new_password_confirmation');

        // Bước 9-13 (Nhánh E2 - Mật khẩu hiện tại không chính xác):
        // Hỗ trợ kiểm tra cả mật khẩu đã băm (Bcrypt) lẫn mật khẩu thuần nếu DB nhóm nhập tay
        $isCurrentPasswordValid = Hash::check($currentPassword, $user->mat_khau)
            || $currentPassword === $user->mat_khau;

        if (!$isCurrentPasswordValid) {
            return back()->withErrors([
                'current_password' => 'Mật khẩu hiện tại không chính xác. Vui lòng nhập lại mật khẩu hiện tại.'
            ]);
        }

        // Bước 14-17 (Nhánh E3 - Mật khẩu mới không đạt yêu cầu chính sách):
        // Chính sách: Tối thiểu 8 ký tự, gồm chữ hoa, chữ thường, chữ số, ký tự đặc biệt và khác mật khẩu cũ
        $policyPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        $isSameAsOld   = Hash::check($newPassword, $user->mat_khau) || $newPassword === $user->mat_khau;

        if (!preg_match($policyPattern, $newPassword) || $isSameAsOld) {
            return back()->withErrors([
                'new_password' => 'Mật khẩu mới không đạt yêu cầu: Phải từ 8 ký tự trở lên, bao gồm chữ hoa, chữ thường, chữ số, ký tự đặc biệt và không trùng với mật khẩu hiện tại.'
            ]);
        }

        // Bước 18-20 (Nhánh E4 - Mật khẩu xác nhận không khớp): So sánh mật khẩu xác nhận
        if ($newPassword !== $confirmPassword) {
            return back()->withErrors([
                'new_password_confirmation' => 'Mật khẩu không trùng khớp: Vui lòng xác nhận lại mật khẩu mới.'
            ]);
        }

        // Bước 21-27 (Nhánh E5 & Thành công): Băm mật khẩu mới và cập nhật cột mat_khau trong bảng TaiKhoan
        try {
            $updated = $user->update([
                'mat_khau' => Hash::make($newPassword),
            ]);

            if (!$updated) {
                return back()->withErrors([
                    'password_error' => 'Không thể đổi mật khẩu. Vui lòng thử lại.'
                ]);
            }

            // Bước 26-27: Trả về kết quả đổi mật khẩu thành công
            return back()->with('success_message', 'Đổi mật khẩu thành công!');
        } catch (Throwable $e) {
            // Bước 24-25 (Nhánh E5 - Không thể cập nhật mật khẩu)
            Log::error('Lỗi cập nhật mật khẩu cho tài khoản ID ' . $user->id . ': ' . $e->getMessage());

            return back()->withErrors([
                'password_error' => 'Không thể đổi mật khẩu do lỗi hệ thống. Vui lòng thử lại sau.'
            ]);
        }
    }
}