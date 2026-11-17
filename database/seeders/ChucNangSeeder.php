<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ChucNang;

class ChucNangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chucNangs = [
            [
                'ma_chuc_nang' => 'NS_011',
                'ten_chuc_nang' => 'Thêm hồ sơ nhân viên mới',
                'mo_ta' => 'Cho phép HR thêm hồ sơ nhân viên mới vào hệ thống.',
                'trang_thai' => 1,
            ],
            [
                'ma_chuc_nang' => 'NS_012',
                'ten_chuc_nang' => 'Xem danh sách nhân viên',
                'mo_ta' => 'Cho phép HR, Trưởng phòng và Giám đốc xem danh sách nhân viên.',
                'trang_thai' => 1,
            ],
            [
                'ma_chuc_nang' => 'NS_013',
                'ten_chuc_nang' => 'Xem chi tiết hồ sơ nhân viên',
                'mo_ta' => 'Cho phép HR, Trưởng phòng và Giám đốc xem chi tiết hồ sơ nhân viên.',
                'trang_thai' => 1,
            ],
            [
                'ma_chuc_nang' => 'NS_014',
                'ten_chuc_nang' => 'Cập nhật thông tin nhân viên',
                'mo_ta' => 'Cho phép HR cập nhật thông tin hồ sơ nhân viên.',
                'trang_thai' => 1,
            ],
            [
                'ma_chuc_nang' => 'NS_015',
                'ten_chuc_nang' => 'Xem danh sách phòng ban',
                'mo_ta' => 'Cho phép HR và Giám đốc xem danh sách các phòng ban.',
                'trang_thai' => 1,
            ],
            [
                'ma_chuc_nang' => 'NS_016',
                'ten_chuc_nang' => 'Xem chi tiết thông tin từng phòng ban',
                'mo_ta' => 'Cho phép HR và Giám đốc xem thông tin chi tiết từng phòng ban.',
                'trang_thai' => 1,
            ],
            [
                'ma_chuc_nang' => 'NS_017',
                'ten_chuc_nang' => 'Xem danh sách nhân viên từng phòng ban',
                'mo_ta' => 'Cho phép HR và Giám đốc và Trưởng Phòng xem danh sách nhân viên từng phòng ban.',
                'trang_thai' => 1,
            ],
            [
                'ma_chuc_nang' => 'NS_018',
                'ten_chuc_nang' => 'Duyệt hồ sơ nhân viên',
                'mo_ta' => 'Cho phép admin duyệt hồ sơ nhân viên',
                'trang_thai' => 1,
            ],
        ];

        foreach ($chucNangs as $chucNang) {
            DB::table('chucnang')->updateOrInsert(
                ['ma_chuc_nang' => $chucNang['ma_chuc_nang']],
                $chucNang
            );
        }
    }
}
