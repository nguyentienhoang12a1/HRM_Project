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
        $nhom = [
            'hoang' => [
                'hoangadmin@vnpt.vn',
                'hoanggiamdoc@vnpt.vn',
                'hoanghr@vnpt.vn',
                'hoangtruongphong@vnpt.vn',
                'hoangnhanvien@vnpt.vn',
            ],
            'hieu' => [
                'hieuadmin@vnpt.vn',
                'hieugiamdoc@vnpt.vn',
                'hieuhr@vnpt.vn',
                'hieutruongphong@vnpt.vn',
                'hieunhanvien@vnpt.vn',
            ],
            'khang' => [
                'khangadmin@vnpt.vn',
                'khanggiamdoc@vnpt.vn',
                'khanghr@vnpt.vn',
                'khangtruongphong@vnpt.vn',
                'khangnhanvien@vnpt.vn',
            ],
        ];

        $matKhau = [
            'Admin@12345',
            'Giamdoc@12345',
            'Hr@12345',
            'Truongphong@12345',
            'Nhanvien@12345',
        ];

        $stt = 1;

        foreach ($nhom as $taiKhoans) {
            foreach ($taiKhoans as $index => $email) {

                $maNhanVien = 'VNPT' . str_pad($stt, 4, '0', STR_PAD_LEFT);

                DB::table('TaiKhoan')->updateOrInsert(
                    ['ten_tai_khoan' => $email],
                    [
                        'ma_nhan_vien' => $maNhanVien,
                        'mat_khau' => Hash::make($matKhau[$index]),
                        'trang_thai' => 1,
                    ]
                );

                $stt++;
            }
        }
    }
}
