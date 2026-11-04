<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. PHÂN QUYỀN
        $maQuyenAdmin = DB::table('PhanQuyen')->insertGetId([
            'ten_quyen' => 'Quản trị viên',
            'mo_ta'     => 'Toàn quyền hệ thống'
        ]);

        $maQuyenUser = DB::table('PhanQuyen')->insertGetId([
            'ten_quyen' => 'Nhân viên',
            'mo_ta'     => 'Quyền nhân viên thông thường'
        ]);

        // 2. PHÒNG BAN
        DB::table('PhongBan')->insert([
            [
                'ma_phong'   => 'PB_IT',
                'ten_phong'  => 'Phòng IT',
                'trang_thai' => 'Hoat dong'
            ],
            [
                'ma_phong'   => 'PB_KT',
                'ten_phong'  => 'Phòng Kế toán',
                'trang_thai' => 'Hoat dong'
            ]
        ]);

        // 3. CHỨC VỤ
        DB::table('ChucVu')->insert([
            [
                'ma_chuc_vu'  => 'CV_TRUONGPHONG',
                'ten_chuc_vu' => 'Trưởng phòng',
                'ma_phong'    => 'PB_IT'
            ],
            [
                'ma_chuc_vu'  => 'CV_NHANVIEN_IT',
                'ten_chuc_vu' => 'Lập trình viên',
                'ma_phong'    => 'PB_IT'
            ],
            [
                'ma_chuc_vu'  => 'CV_NHANVIEN_KT',
                'ten_chuc_vu' => 'Kế toán viên',
                'ma_phong'    => 'PB_KT'
            ]
        ]);

        // 4. NHÂN VIÊN
        DB::table('NhanVien')->insert([
            // Admin / Trưởng phòng
            [
                'ma_nhan_vien' => 'NV_001',
                'ho_va_ten'    => 'Công Hiếu',
                'email'        => 'hieudc205@gmail.com',
                'ma_chuc_vu'   => 'CV_TRUONGPHONG',
                'trang_thai'   => 'Hoat dong'
            ],
            // Nhân viên thường 1
            [
                'ma_nhan_vien' => 'NV_002',
                'ho_va_ten'    => 'Nguyễn Văn A',
                'email'        => 'nguyenlonglbdt@gmail.com',
                'ma_chuc_vu'   => 'CV_NHANVIEN_IT',
                'trang_thai'   => 'Hoat dong'
            ],
            // Nhân viên thường 2
            [
                'ma_nhan_vien' => 'NV_003',
                'ho_va_ten'    => 'Trần Thị B',
                'email'        => 'stu735105034@hnue.edu.vn',
                'ma_chuc_vu'   => 'CV_NHANVIEN_KT',
                'trang_thai'   => 'Hoat dong'
            ]
        ]);

        // 5. TÀI KHOẢN
        DB::table('TaiKhoan')->insert([
            // Tài khoản Admin
            [
                'ten_tai_khoan' => 'conghieu',
                'mat_khau'      => Hash::make('123456'),
                'ma_nhan_vien'  => 'NV_001',
                'ma_quyen'      => $maQuyenAdmin
            ],
            // Tài khoản Thường 1
            [
                'ten_tai_khoan' => 'nguyenlong',
                'mat_khau'      => Hash::make('123456'),
                'ma_nhan_vien'  => 'NV_002',
                'ma_quyen'      => $maQuyenUser
            ],
            // Tài khoản Thường 2
            [
                'ten_tai_khoan' => 'hieuhnue',
                'mat_khau'      => Hash::make('123456'),
                'ma_nhan_vien'  => 'NV_003',
                'ma_quyen'      => $maQuyenUser
            ]
        ]);
    }
}