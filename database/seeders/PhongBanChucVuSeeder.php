<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PhongBanChucVu;

class PhongBanChucVuSeeder extends Seeder
{
    public function run(): void
    {
        $phongBanChucVus = [
            // PHÒNG TỔNG HỢP
            ['ma_phong_ban' => 'PB_TongHop', 'ma_chuc_vu' => 'CV_TruongPhong'],
            ['ma_phong_ban' => 'PB_TongHop', 'ma_chuc_vu' => 'CV_PhoPhong'],
            ['ma_phong_ban' => 'PB_TongHop', 'ma_chuc_vu' => 'CV_NhanVien'],

            // PHÒNG KINH DOANH
            ['ma_phong_ban' => 'PB_KinhDoanh', 'ma_chuc_vu' => 'CV_TruongPhong'],
            ['ma_phong_ban' => 'PB_KinhDoanh', 'ma_chuc_vu' => 'CV_PhoPhong'],
            ['ma_phong_ban' => 'PB_KinhDoanh', 'ma_chuc_vu' => 'CV_NhanVien'],

            // PHÒNG GIẢI PHÁP 1
            ['ma_phong_ban' => 'PB_GiaiPhap1', 'ma_chuc_vu' => 'CV_TruongPhong'],
            ['ma_phong_ban' => 'PB_GiaiPhap1', 'ma_chuc_vu' => 'CV_PhoPhong'],
            ['ma_phong_ban' => 'PB_GiaiPhap1', 'ma_chuc_vu' => 'CV_NhanVien'],

            // PHÒNG GIẢI PHÁP 2
            ['ma_phong_ban' => 'PB_GiaiPhap2', 'ma_chuc_vu' => 'CV_TruongPhong'],
            ['ma_phong_ban' => 'PB_GiaiPhap2', 'ma_chuc_vu' => 'CV_PhoPhong'],
            ['ma_phong_ban' => 'PB_GiaiPhap2', 'ma_chuc_vu' => 'CV_NhanVien'],
        ];

        foreach ($phongBanChucVus as $item) {
            DB::table('phongbanchucvu')->updateOrInsert(
                [
                    'ma_phong_ban' => $item['ma_phong_ban'],
                    'ma_chuc_vu' => $item['ma_chuc_vu'],
                ],
                $item
            );
        }
    }
}
