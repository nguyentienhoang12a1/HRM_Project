<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $maQuyen = DB::table('PhanQuyen')->insertGetId([
            'ten_quyen' => 'Quản trị viên',
            'mo_ta' => 'Toàn quyền'
        ]);

        DB::table('PhongBan')->insert([
            'ma_phong' => 'PB_IT',
            'ten_phong' => 'Phòng IT',
            'trang_thai' => 'Hoat dong'
        ]);

        DB::table('ChucVu')->insert([
            'ma_chuc_vu' => 'CV_TRUONGPHONG',
            'ten_chuc_vu' => 'Trưởng phòng',
            'ma_phong' => 'PB_IT'
        ]);

        DB::table('NhanVien')->insert([
            'ma_nhan_vien' => 'NV_001',
            'ho_va_ten' => 'Hữu Khang',
            'email' => 'huukhang2k5@gmail.com',
            'ma_chuc_vu' => 'CV_TRUONGPHONG',
            'trang_thai' => 'Hoat dong' 
        ]);

        DB::table('TaiKhoan')->insert([
            'ten_tai_khoan' => 'huukhang',
            'mat_khau' => Hash::make('123456'), // Hash mật khẩu
            'ma_nhan_vien' => 'NV_001', 
            'ma_quyen' => $maQuyen
        ]);
    }
}