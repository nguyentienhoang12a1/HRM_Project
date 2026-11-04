<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ChamCongController; // <-- 1. IMPORT CONTROLLER CHẤM CÔNG
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NhanVienController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Điều hướng trang gốc '/'
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Nhóm Route Khách (Chưa đăng nhập - Guest)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // 1. Đăng nhập (UC-AUTH-01)
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    // 2. Xác thực mã OTP 6 chữ số qua Email (Hiệu lực 5 phút)
    Route::get('/verify-otp', [OTPController::class, 'showVerifyForm'])->name('otp.form');
    Route::post('/verify-otp', [OTPController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/resend-otp', [OTPController::class, 'resendOtp'])->name('otp.resend');

    // 3. Quên mật khẩu & Đặt lại mật khẩu bằng mã OTP
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetOtp'])->name('password.email');
    Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
    Route::post('/reset-password/resend-otp', [ForgotPasswordController::class, 'resendResetOtp'])->name('password.otp.resend');
});

/*
|--------------------------------------------------------------------------
| Nhóm Route Đã Xác Thực OTP + Tự Động Đăng Xuất Sau 10 Phút Không Hoạt Động
|--------------------------------------------------------------------------
*/
Route::middleware(['permission.scope'])->group(function () {
    // Đăng xuất
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Điều hướng Dashboard về đúng 5 trang giao diện theo vai trò của nhóm
    Route::get('/dashboard', function () {
        $user = \App\Models\TaiKhoan::with('phanQuyen')->findOrFail(\Illuminate\Support\Facades\Auth::id());
        return match ($user->getRoleKey()) {
            'admin'       => redirect()->route('pages.admin'),
            'giamdoc'     => redirect()->route('pages.giamdoc'),
            'hr'          => redirect()->route('pages.hr'),
            'truongphong' => redirect()->route('pages.truongphong'),
            default       => redirect()->route('pages.nhanvien'),
        };
    })->name('dashboard');

    // 5 Trang chủ theo vai trò trong resources/views/pages/ của nhóm
    Route::get('/admin/home', fn() => view('pages.Index_Admin'))->name('pages.admin')->middleware('permission.scope:admin');
    Route::get('/giam-doc/home', fn() => view('pages.Index_GiamDoc'))->name('pages.giamdoc')->middleware('permission.scope:giamdoc|admin');
    Route::get('/hr/home', fn() => view('pages.Index_HR'))->name('pages.hr')->middleware('permission.scope:hr|admin');
    Route::get('/truong-phong/home', fn() => view('pages.Index_TruongPhong'))->name('pages.truongphong')->middleware('permission.scope:truongphong|admin');
    Route::get('/nhan-vien/home', fn() => view('pages.Index_NhanVien'))->name('pages.nhanvien');

    // Đổi mật khẩu cá nhân (UC-AUTH-03)
    Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/change-password', [PasswordController::class, 'updatePassword'])->name('password.change.submit');

    // CRUD Quản lý Nhân viên & Cấp Tài khoản (Dành cho Admin, Giám đốc, HR, Trưởng phòng)
    Route::resource('nhanvien', NhanVienController::class)->parameters([
        'nhanvien' => 'ma_nhan_vien',
    ]);

    // Quản lý phân quyền truy cập (UC-ROLE-01 - Dành cho Admin)
    Route::prefix('admin')->name('admin.')->middleware('permission.scope:admin')->group(function () {
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    });

    /*
    |--------------------------------------------------------------------------
    | 2. BỔ SUNG: CHẤM CÔNG FACEID & LỊCH SỬ CHẤM CÔNG
    |--------------------------------------------------------------------------
    */
    // Giao diện máy quét Camera FaceID
    Route::get('/cham-cong', [ChamCongController::class, 'index'])->name('chamcong.index');

    // API trả về danh sách khuôn mặt dạng JSON cho Face API JS
    Route::get('/face-database', [ChamCongController::class, 'getFaceDatabase'])->name('chamcong.facedata');

    // API lưu Check-in / Check-out vào CSDL
    Route::post('/luu-cham-cong', [ChamCongController::class, 'luuChamCong'])->name('chamcong.luu');

    // Trang xem bảng lịch sử chấm công
    Route::get('/lich-su-cham-cong', [ChamCongController::class, 'lichSuChamCong'])->name('chamcong.lich_su');
});