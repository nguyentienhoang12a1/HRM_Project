<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChucVu;

class ChucVuSeeder extends Seeder
{
    public function run(): void
    {
        $chucVus = [
            [
                'ma_chuc_vu' => 'CV001',
                'ten_chuc_vu' => 'Phó giám đốc phòng',
            ],
            [
                'ma_chuc_vu' => 'CV002',
                'ten_chuc_vu' => 'Nhân viên tổng hợp (HR)',
            ],
            [
                'ma_chuc_vu' => 'CV003',
                'ten_chuc_vu' => 'Nhân viên kế toán',
            ],
            [
                'ma_chuc_vu' => 'CV004',
                'ten_chuc_vu' => 'Nhân viên lái xe',
            ],
            [
                'ma_chuc_vu' => 'CV005',
                'ten_chuc_vu' => 'Chuyên viên kinh doanh',
            ],
            [
                'ma_chuc_vu' => 'CV006',
                'ten_chuc_vu' => 'Chuyên viên hỗ trợ dự án',
            ],
            [
                'ma_chuc_vu' => 'CV007',
                'ten_chuc_vu' => 'Kỹ sư lập trình',
            ],
            [
                'ma_chuc_vu' => 'CV008',
                'ten_chuc_vu' => 'Kỹ sư quản trị hệ thống',
            ],
            [
                'ma_chuc_vu' => 'CV009',
                'ten_chuc_vu' => 'Kỹ sư cơ sở dữ liệu',
            ],
            [
                'ma_chuc_vu' => 'CV010',
                'ten_chuc_vu' => 'Kỹ sư an toàn thông tin',
            ],
            [
                'ma_chuc_vu' => 'CV011',
                'ten_chuc_vu' => 'Chuyên viên tư vấn giải pháp',
            ],
            [
                'ma_chuc_vu' => 'CV012',
                'ten_chuc_vu' => 'Chuyên viên tích hợp',
            ],
            [
                'ma_chuc_vu' => 'CV013',
                'ten_chuc_vu' => 'Chuyên viên hỗ trợ phát triển',
            ],
        ];

        foreach ($chucVus as $chucVu) {
            ChucVu::updateOrCreate(
                ['ma_chuc_vu' => $chucVu['ma_chuc_vu']],
                ['ten_chuc_vu' => $chucVu['ten_chuc_vu']]
            );
        }
    }
}