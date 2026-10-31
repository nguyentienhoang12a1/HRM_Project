
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\LoginController;

// =====================================
// NHÓM ROUTE CHƯA ĐĂNG NHẬP (GUEST)
// =====================================

Route::middleware('guest')->group(function () {

    // Trang đăng nhập
    Route::get('/login', [LoginController::class, 'showLogin'])
        ->name('login');

    // Xử lý đăng nhập
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.submit');

});

// =====================================
// NHÓM ROUTE BẮT BUỘC ĐĂNG NHẬP (AUTH)
// =====================================

Route::middleware('auth')->group(function () {

    // Đăng xuất
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Dashboard nhân viên
    Route::get('/nhan-vien', function () {
        return view('pages.Index_NhanVien');
    })->name('dashboard');

    // Các chức năng quản lý nhân viên
    Route::resource('nhanvien', NhanVienController::class)
        ->except(['show']);

    // Dashboard Trưởng phòng
    Route::get('/truong-phong', function () {
        return view('pages.Index_TruongPhong');
    })->name('truongphong');

    // Dashboard HR
    Route::get('/HR', function () {
        return view('pages.Index_HR');
    })->name('HR');

    // Dashboard Giám đốc
    Route::get('/giam-doc', function () {
        return view('pages.Index_GiamDoc');
    })->name('giamdoc');

});

// =====================================
// ROUTE MẶC ĐỊNH
// =====================================

Route::get('/', function () {
    return redirect()->route('login');
});
