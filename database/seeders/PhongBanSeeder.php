<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhongBan;

class PhongBanSeeder extends Seeder
{
    public function run(): void
    {
        $phongBans = [
            [
                'ma_phong_ban' => 'PB_TongHop',
                'ten_phong_ban' => 'Phòng Tổng hợp',
                'ma_truong_phong' => null,
                'mo_ta' => 'Phụ trách công tác nhân sự, kế toán và hành chính tổng hợp.',
                'trang_thai' => 1,
            ],
            [
                'ma_phong_ban' => 'PB_KinhDoanh',
                'ten_phong_ban' => 'Phòng Kinh doanh',
                'ma_truong_phong' => null,
                'mo_ta' => 'Phụ trách hoạt động kinh doanh và hỗ trợ dự án.',
                'trang_thai' => 1,
            ],
            [
                'ma_phong_ban' => 'PB_GiaiPhap1',
                'ten_phong_ban' => 'Phòng Giải pháp 1',
                'ma_truong_phong' => null,
                'mo_ta' => 'Phụ trách phát triển các giải pháp phần mềm.',
                'trang_thai' => 1,
            ],
            [
                'ma_phong_ban' => 'PB_GiaiPhap2',
                'ten_phong_ban' => 'Phòng Giải pháp 2',
                'ma_truong_phong' => null,
                'mo_ta' => 'Phụ trách quản trị hệ thống, cơ sở dữ liệu, an toàn thông tin và tích hợp giải pháp.',
                'trang_thai' => 1,
            ],
        ];

        foreach ($phongBans as $phongBan) {
            PhongBan::updateOrCreate(
                ['ma_phong_ban' => $phongBan['ma_phong_ban']],
                $phongBan
            );
        }
    }
}
