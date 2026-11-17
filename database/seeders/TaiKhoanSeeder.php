<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;

class TaiKhoanSeeder extends Seeder
{
    public function run(): void
    {
        $taiKhoans = [
            [
                'ten_tai_khoan' => 'admin@vnpt.vn',
                'mat_khau' => Hash::make('Admin@12345'),
                'trang_thai' => 1,
            ],
            [
                'ten_tai_khoan' => 'giamdoc@vnpt.vn',
                'mat_khau' => Hash::make('Giamdoc@12345'),
                'trang_thai' => 1,
            ],
            [
                'ten_tai_khoan' => 'hr@vnpt.vn',
                'mat_khau' => Hash::make('Hr@12345'),
                'trang_thai' => 1,
            ],
            [
                'ten_tai_khoan' => 'truongphong@vnpt.vn',
                'mat_khau' => Hash::make('Truongphong@12345'),
                'trang_thai' => 1,
            ],
            [
                'ten_tai_khoan' => 'nhanvien@vnpt.vn',
                'mat_khau' => Hash::make('Nhanvien@12345'),
                'trang_thai' => 1,
            ],
        ];

        foreach ($taiKhoans as $taiKhoan) {
            DB::table('TaiKhoan')->updateOrInsert(
                ['ten_tai_khoan' => $taiKhoan['ten_tai_khoan']],
                $taiKhoan
            );
        }
    }
}