<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ChamCongController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\EnsureUserIsAdmin;
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
| Nhóm Route Đã Xác Thực OTP + Phân Quyền Hệ Thống
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'permission.scope'])->group(function () {

    // Đăng xuất
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Điều hướng Dashboard theo vai trò
    Route::get('/dashboard', function () {
        $roleKeys = session('user_roles', []);

        return match (true) {
            in_array('VT_Admin', $roleKeys, true) => redirect()->route('pages.admin'),
            in_array('VT_GiamDoc', $roleKeys, true) => redirect()->route('pages.giamdoc'),
            in_array('VT_HR', $roleKeys, true) => redirect()->route('pages.hr'),
            in_array('VT_TruongPhong', $roleKeys, true) => redirect()->route('pages.truongphong'),
            in_array('VT_NhanVien', $roleKeys, true) => redirect()->route('pages.nhanvien'),
            default => redirect()->route('dashboard.general'),
        };
    })->name('dashboard');

    // Trang tổng quan chung
    Route::get('/general-dashboard', [DashboardController::class, 'index'])->name('dashboard.general');

    // 5 Trang chủ theo vai trò
    Route::get('/admin/home', [DashboardController::class, 'admin'])->name('pages.admin');
    Route::get('/giam-doc/home', [DashboardController::class, 'giamdoc'])->name('pages.giamdoc');
    Route::get('/hr/home', [DashboardController::class, 'hr'])->name('pages.hr');
    Route::get('/truong-phong/home', [DashboardController::class, 'truongphong'])->name('pages.truongphong');
    Route::get('/nhan-vien/home', [DashboardController::class, 'nhanvien'])->name('pages.nhanvien');

    // Đổi mật khẩu cá nhân (UC-AUTH-03)
    Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/change-password', [PasswordController::class, 'updatePassword'])->name('password.change.submit');

    // Nhóm route Quản lý Nhân viên
    Route::prefix('nhan-vien')->name('nhanvien.')->group(function () {
        Route::get('/', [NhanVienController::class, 'index'])
            ->middleware('permission.scope:NS_012')
            ->name('index');

        Route::get('/create', [NhanVienController::class, 'create'])
            ->middleware('permission.scope:NS_013')
            ->name('create');
        Route::post('/', [NhanVienController::class, 'store'])
            ->middleware('permission.scope:NS_013')
            ->name('store');

        Route::get('/{ma_nhan_vien}', [NhanVienController::class, 'show'])
            ->middleware('permission.scope:NS_012')
            ->name('show');

        Route::get('/{ma_nhan_vien}/edit', [NhanVienController::class, 'edit'])
            ->middleware('permission.scope:NS_014')
            ->name('edit');
        Route::put('/{ma_nhan_vien}', [NhanVienController::class, 'update'])
            ->middleware('permission.scope:NS_014')
            ->name('update');
        Route::delete('/{ma_nhan_vien}', [NhanVienController::class, 'destroy'])
            ->middleware('permission.scope:NS_014')
            ->name('destroy');
    });

    // Nhóm Quản lý Phân quyền (tham số {id} khớp khóa chính TaiKhoan.id)
    Route::middleware('permission.scope:QT_001')
        ->prefix('admin/roles')
        ->name('admin.roles.')
        ->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::put('/{id}', [RoleController::class, 'updateUserRole'])->name('update');
        });
});

/*
|--------------------------------------------------------------------------
| Nhóm Route quản lý chấm công
|--------------------------------------------------------------------------
*/
// Máy Chấm Công Độc Lập - KHÔNG Cần Đăng Nhập
Route::get('/cham-cong', [ChamCongController::class, 'index'])->name('chamcong.index');
Route::get('/cham-cong/face-database', [ChamCongController::class, 'getFaceDatabase'])->name('chamcong.face.database');
Route::get('/cham-cong/face-data', [ChamCongController::class, 'getFaceDatabase'])->name('chamcong.facedata');
Route::post('/cham-cong/checkin', [ChamCongController::class, 'storeCheckin'])->name('chamcong.checkin');
Route::post('/cham-cong/luu', [ChamCongController::class, 'storeCheckin'])->name('chamcong.luu');

// Quét mặt kiểm tra có phải Admin, HR để hiện nút mở trang đăng ký FaceID
Route::post('/cham-cong/kiem-tra-admin-faceid', [ChamCongController::class, 'verifyAdminByFace'])
    ->name('chamcong.verify.admin.face');

// Lịch Sử Chấm Công - Đăng Nhập Hệ Thống Mới Xem Được
Route::middleware(['auth'])->group(function () {
    Route::get('/cham-cong/lich-su', [ChamCongController::class, 'lichSuChamCong'])->name('chamcong.lichsu');
});

// Đăng Ký FaceID - Chỉ Admin, HR Mới Được Truy Cập & Lưu
Route::middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
    Route::get('/cham-cong/dang-ky-faceid', [ChamCongController::class, 'showFaceRegister'])->name('chamcong.face.register.form');
    Route::post('/cham-cong/dang-ky-faceid', [ChamCongController::class, 'saveFaceVector'])->name('chamcong.face.register');
    Route::post('/nhan-vien/save-face', [ChamCongController::class, 'saveFaceVector'])->name('nhanvien.save_face');
});