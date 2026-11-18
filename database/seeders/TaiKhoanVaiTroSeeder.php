<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TaiKhoanVaiTro;

class TaiKhoanVaiTroSeeder extends Seeder
{
    public function run(): void
    {
        $nhom = ['hoang', 'hieu', 'khang'];

        $vaiTros = [
            'admin' => 'VT_Admin',
            'giamdoc' => 'VT_GiamDoc',
            'hr' => 'VT_HR',
            'truongphong' => 'VT_TruongPhong',
            'nhanvien' => 'VT_NhanVien',
        ];

        foreach ($nhom as $prefix) {
            foreach ($vaiTros as $ten => $maVaiTro) {

                $tenTaiKhoan = $prefix . $ten . '@vnpt.vn';

                $taiKhoanId = DB::table('TaiKhoan')
                    ->where('ten_tai_khoan', $tenTaiKhoan)
                    ->value('id');

                if (!$taiKhoanId) {
                    continue;
                }

                DB::table('TaiKhoanVaiTro')->updateOrInsert(
                    [
                        'tai_khoan_id' => $taiKhoanId,
                        'ma_vai_tro' => $maVaiTro,
                    ],
                    [
                        'tai_khoan_id' => $taiKhoanId,
                        'ma_vai_tro' => $maVaiTro,
                    ]
                );
            }
        }
    }
}
