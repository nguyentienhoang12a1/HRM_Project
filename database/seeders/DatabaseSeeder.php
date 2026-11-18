<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PhongBanSeeder::class,
            ChucVuSeeder::class,
            VaiTroSeeder::class,
            ChucNangSeeder::class,
            PhamViQuyenSeeder::class,

            ViTriCongViecSeeder::class,
            PhongBanChucVuSeeder::class,

            // Tạo nhân viên trước
            NhanVienSeeder::class,

            // Sau đó mới tạo tài khoản
            TaiKhoanSeeder::class,
            TaiKhoanVaiTroSeeder::class,
            VaiTroChucNangSeeder::class,
            
        ]);
    }
}