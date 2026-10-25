
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NhanVienController;

Route::get('/', function () {
    return redirect()->route('nhanvien.index');
});

Route::resource('nhanvien', NhanVienController::class)
    ->except(['show']);
