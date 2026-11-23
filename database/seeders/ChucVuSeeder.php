<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucVuSeeder extends Seeder
{
    public function run(): void
    {
        $chucVus = [
            ['ma_chuc_vu' => 'CV_GiamDoc',     'ten_chuc_vu' => 'Giám đốc'],
            ['ma_chuc_vu' => 'CV_PhoGiamDoc',  'ten_chuc_vu' => 'Phó giám đốc'],
            ['ma_chuc_vu' => 'CV_TruongPhong', 'ten_chuc_vu' => 'Trưởng phòng'],
            ['ma_chuc_vu' => 'CV_PhoPhong',    'ten_chuc_vu' => 'Phó phòng'],
            ['ma_chuc_vu' => 'CV_NhanVien',    'ten_chuc_vu' => 'Nhân viên'],
        ];

        foreach ($chucVus as $chucVu) {
            DB::table('ChucVu')->updateOrInsert(
                ['ma_chuc_vu' => $chucVu['ma_chuc_vu']],
                $chucVu
            );
        }
    }
}