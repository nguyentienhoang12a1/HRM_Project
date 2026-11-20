<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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

            // Sau đó mới tạo tài khoản và phân quyền
            TaiKhoanSeeder::class,
            TaiKhoanVaiTroSeeder::class,
            VaiTroChucNangSeeder::class,
        ]);
    }
}
