<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\VaiTro;

class VaiTroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vaiTros = [
            [
                'ma_vai_tro' => 'VT_Admin',
                'ten_vai_tro' => 'Admin',
                'mo_ta' => 'Quản trị toàn bộ hệ thống, quản lý tài khoản, phân quyền và cấu hình hệ thống.',
                'trang_thai' => 1,
            ],
            [
                'ma_vai_tro' => 'VT_GiamDoc',
                'ten_vai_tro' => 'Giám đốc',
                'mo_ta' => 'Quản lý và giám sát hoạt động toàn công ty, xem xét và phê duyệt các nghiệp vụ.',
                'trang_thai' => 1,
            ],
            [
                'ma_vai_tro' => 'VT_HR',
                'ten_vai_tro' => 'HR',
                'mo_ta' => 'Quản lý hồ sơ nhân viên, hợp đồng, chấm công, nghỉ phép và các nghiệp vụ nhân sự.',
                'trang_thai' => 1,
            ],
            [
                'ma_vai_tro' => 'VT_TruongPhong',
                'ten_vai_tro' => 'Trưởng phòng',
                'mo_ta' => 'Quản lý nhân viên, theo dõi hoạt động và thực hiện các nghiệp vụ trong phòng ban.',
                'trang_thai' => 1,
            ],
            [
                'ma_vai_tro' => 'VT_NhanVien',
                'ten_vai_tro' => 'Nhân viên',
                'mo_ta' => 'Sử dụng các chức năng cá nhân như xem hồ sơ, theo dõi chấm công và gửi đơn nghỉ phép.',
                'trang_thai' => 1,
            ],
        ];

        foreach ($vaiTros as $vaiTro) {
            DB::table('vaitro')->updateOrInsert(
                ['ma_vai_tro' => $vaiTro['ma_vai_tro']],
                $vaiTro
            );
        }
    }
}
