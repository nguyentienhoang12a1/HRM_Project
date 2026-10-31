<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TaiKhoan;

class LoginController extends Controller
{
    /**
     * Hiển thị trang đăng nhập
     */
    public function showLogin()
    {
        return view('pages.login');
    }

    /**
     * Xử lý đăng nhập bằng Laravel Authentication
     */
    public function login(Request $request)
    {
        // BƯỚC 1: Kiểm tra dữ liệu đầu vào
        $validated = $request->validate(
            [
                'username' => [
                    'required',
                    'string',
                    'regex:/^[A-Za-z0-9._%+-]+@vnpt\.vn$/'
                ],

                'password' => [
                    'required',
                    'string',
                    'min:6'
                ],
            ],
            [
                'username.required' => 'Vui lòng nhập tài khoản.',
                'username.string' => 'Tài khoản phải là chuỗi.',
                'username.regex' => 'Tài khoản phải có định dạng email @vnpt.vn.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.string' => 'Mật khẩu không hợp lệ.',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            ]
        );

        // BƯỚC 2: Đăng nhập bằng Laravel Authentication
        $thanhCong = Auth::attempt([
            'ten_tai_khoan' => $validated['username'],
            'password' => $validated['password'],
        ]);

        // BƯỚC 3: Kiểm tra kết quả đăng nhập
        if (!$thanhCong) {
            return back()
                ->withErrors([
                    'username' => 'Tài khoản hoặc mật khẩu không chính xác.'
                ])
                ->withInput($request->only('username'));
        }

        // BƯỚC 4: Tạo lại Session ID sau đăng nhập
        $request->session()->regenerate();

        // BƯỚC 5: Lấy thông tin tài khoản
        $taiKhoan = Auth::user();

        // BƯỚC 6: Kiểm tra thông tin nhân viên
        if (!$taiKhoan->nhanVien) {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()
                ->withErrors([
                    'username' => 'Tài khoản chưa được liên kết với nhân viên.'
                ])
                ->withInput($request->only('username'));
        }

        // BƯỚC 7: Đăng nhập thành công
        return redirect()->route('dashboard');
    }

    /**
     * Đăng xuất bằng Laravel Authentication
     */
    public function logout(Request $request)
    {
        // Xóa trạng thái đăng nhập của Laravel
        Auth::logout();

        // Hủy Session hiện tại
        $request->session()->invalidate();

        // Tạo lại CSRF token
        $request->session()->regenerateToken();

        // Quay về trang đăng nhập
        return redirect()
            ->route('login')
            ->with('success', 'Bạn đã đăng xuất thành công.');
    }
}