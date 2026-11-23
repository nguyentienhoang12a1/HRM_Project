<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucNangSeeder extends Seeder
{
    public function run(): void
    {
        $chucNangs = [
            [
                'ma_chuc_nang'  => 'QT_001',
                'ten_chuc_nang' => 'Quản lý phân quyền và tài khoản',
                'mo_ta'         => 'Xem danh sách tài khoản, gán vai trò, chức vụ và trạng thái làm việc',
                'trang_thai'    => true,
            ],
            [
                'ma_chuc_nang'  => 'NS_012',
                'ten_chuc_nang' => 'Xem danh sách nhân viên',
                'mo_ta'         => 'Xem thông tin hồ sơ nhân viên theo phạm vi quyền được cấp',
                'trang_thai'    => true,
            ],
            [
                'ma_chuc_nang'  => 'NS_013',
                'ten_chuc_nang' => 'Thêm mới nhân viên',
                'mo_ta'         => 'Tạo mới hồ sơ nhân sự trong hệ thống',
                'trang_thai'    => true,
            ],
            [
                'ma_chuc_nang'  => 'NS_014',
                'ten_chuc_nang' => 'Cập nhật và xóa nhân viên',
                'mo_ta'         => 'Chỉnh sửa thông tin hoặc xóa hồ sơ nhân viên',
                'trang_thai'    => true,
            ],
            [
                'ma_chuc_nang'  => 'NS_015',
                'ten_chuc_nang' => 'Xem danh sách phòng ban',
                'mo_ta'         => 'Xem cơ cấu tổ chức và danh sách phòng ban',
                'trang_thai'    => true,
            ],
        ];

        foreach ($chucNangs as $item) {
            DB::table('ChucNang')->updateOrInsert(
                ['ma_chuc_nang' => $item['ma_chuc_nang']],
                [
                    'ten_chuc_nang' => $item['ten_chuc_nang'],
                    'mo_ta'         => $item['mo_ta'],
                    'trang_thai'    => $item['trang_thai'],
                ]
            );
        }
    }
}