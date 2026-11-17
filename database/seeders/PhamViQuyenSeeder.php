<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PhamViQuyen;

class PhamViQuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phamVis = [
            [
                'ma_pham_vi' => 'PV_HeThong',
                'ten_pham_vi' => 'Toàn hệ thống',
                'mo_ta' => 'Được xem và thao tác trên toàn bộ dữ liệu và chức năng của hệ thống.',
            ],
            [
                'ma_pham_vi' => 'PV_CongTy',
                'ten_pham_vi' => 'Toàn công ty',
                'mo_ta' => 'Được xem và thao tác trên dữ liệu của tất cả phòng ban trong công ty.',
            ],
            [
                'ma_pham_vi' => 'PV_PhongBan',
                'ten_pham_vi' => 'Phòng ban',
                'mo_ta' => 'Được xem và thao tác trên dữ liệu thuộc phòng ban mình quản lý hoặc đang công tác.',
            ],
            [
                'ma_pham_vi' => 'PV_CaNhan',
                'ten_pham_vi' => 'Cá nhân',
                'mo_ta' => 'Chỉ được xem và thao tác trên dữ liệu cá nhân của chính mình.',
            ],
        ];

        foreach ($phamVis as $phamVi) {
            DB::table('phamviquyen')->updateOrInsert(
                ['ma_pham_vi' => $phamVi['ma_pham_vi']],
                $phamVi
            );
        }
    }
}
