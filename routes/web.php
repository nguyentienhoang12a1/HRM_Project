<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ChamCongController;
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
Route::middleware(['auth', 'permission.scope'])->group(function () {

    // Đăng xuất
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Điều hướng Dashboard theo vai trò
    Route::get('/dashboard', function () {
        $user = \App\Models\TaiKhoan::with('vaiTros')
            ->findOrFail(\Illuminate\Support\Facades\Auth::id());

        $roleKeys = session('user_roles', []);

        return match (true) {
            in_array('VT_Admin', $roleKeys, true) =>
            redirect()->route('pages.admin'),

            in_array('VT_GiamDoc', $roleKeys, true) =>
            redirect()->route('pages.giamdoc'),

            in_array('VT_HR', $roleKeys, true) =>
            redirect()->route('pages.hr'),

            in_array('VT_TruongPhong', $roleKeys, true) =>
            redirect()->route('pages.truongphong'),

            in_array('VT_NhanVien', $roleKeys, true) =>
            redirect()->route('pages.nhanvien'),

            default => abort(403, 'Tài khoản chưa được phân công vai trò.')
        };
    })->name('dashboard');

    // 5 Trang chủ theo vai trò trong resources/views/pages/ của nhóm
    // Trang chủ Admin
    Route::get('/admin/home', function () {
        abort_unless(in_array('VT_Admin', session('user_roles', []), true), 403);
        return view('pages.Index_Admin');
    })->name('pages.admin');

    // Trang chủ Giám đốc
    Route::get('/giam-doc/home', function () {
        abort_unless(in_array('VT_GiamDoc', session('user_roles', []), true), 403);
        return view('pages.Index_GiamDoc');
    })->name('pages.giamdoc');

    // Trang chủ HR
    Route::get('/hr/home', function () {
        abort_unless(in_array('VT_HR', session('user_roles', []), true), 403);
        return view('pages.Index_HR');
    })->name('pages.hr');

    // Trang chủ Trưởng phòng
    Route::get('/truong-phong/home', function () {
        abort_unless(in_array('VT_TruongPhong', session('user_roles', []), true), 403);
        return view('pages.Index_TruongPhong');
    })->name('pages.truongphong');

    // Trang chủ Nhân viên
    Route::get('/nhan-vien/home', function () {
        abort_unless(in_array('VT_NhanVien', session('user_roles', []), true), 403);
        return view('pages.Index_NhanVien');
    })->name('pages.nhanvien');

    // Đổi mật khẩu cá nhân (UC-AUTH-03)
    Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/change-password', [PasswordController::class, 'updatePassword'])->name('password.change.submit');

    // CRUD Quản lý Nhân viên & Cấp Tài khoản (Dành cho Admin, Giám đốc, HR, Trưởng phòng)
    // Quản lý nhân viên - Kiểm tra quyền chức năng
    Route::middleware('permission.scope:MA_CHUC_NANG_NHAN_VIEN')
        ->group(function () {
            Route::resource('nhanvien', NhanVienController::class)
                ->parameters([
                    'nhanvien' => 'ma_nhan_vien',
                ]);
        });

    // Quản lý phân quyền truy cập (UC-ROLE-01 - Dành cho Admin)
    // Quản lý vai trò - Kiểm tra quyền chức năng
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('permission.scope:NS_011')
        ->group(function () {
            Route::get('/roles', [RoleController::class, 'index'])
                ->name('roles.index');

            Route::put('/roles/{id}', [RoleController::class, 'update'])
                ->name('roles.update');
        });

    /*
    |--------------------------------------------------------------------------
    | CHẤM CÔNG FACEID, ĐĂNG KÝ FACEID & LỊCH SỬ CHẤM CÔNG
    |--------------------------------------------------------------------------
    */
    // Giao diện Đăng ký FaceID cho Nhân viên
    Route::get('/dang-ky-faceid', [NhanVienController::class, 'showFaceRegister'])->name('nhanvien.face_register');
    // API Lưu dữ liệu Vector 128 tham số khuôn mặt
    Route::post('/luu-faceid', [NhanVienController::class, 'saveFaceVector'])->name('nhanvien.save_face');

    // Các route Chấm công khác
    Route::get('/cham-cong', [ChamCongController::class, 'index'])->name('chamcong.index');
    Route::get('/face-database', [ChamCongController::class, 'getFaceDatabase'])->name('chamcong.facedata');
    Route::post('/luu-cham-cong', [ChamCongController::class, 'storeCheckin'])->name('chamcong.luu');
    Route::get('/lich-su-cham-cong', [ChamCongController::class, 'lichSuChamCong'])->name('chamcong.lich_su');
});
