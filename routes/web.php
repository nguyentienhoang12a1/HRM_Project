
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NhanVienController;

// Trang đăng nhập
Route::get('/login', function () {
    return view('login');
})->name('login');

// Trang chủ chuyển đến đăng nhập
Route::get('/', function () {
    return redirect()->route('login');
});

// Các chức năng quản lý nhân viên vẫn giữ nguyên
Route::resource('nhanvien', NhanVienController::class)
    ->except(['show']);
