<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaiTroChucNangSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy toàn bộ vai trò
        $vaiTros = DB::table('vaitro')
            ->pluck('ma_vai_tro');

        // Lấy toàn bộ chức năng
        $chucNangs = DB::table('chucnang')
            ->pluck('ma_chuc_nang');

        // Lấy toàn bộ phạm vi
        $phamVis = DB::table('phamviquyen')
            ->pluck('ma_pham_vi');

        // Danh sách quyền được thực hiện
        $quyenDuocThucHien = [
            'VT_Admin' => [
                'NS_011' => 'PV_HeThong',
                'NS_014' => 'PV_HeThong',
                'NS_018' => 'PV_HeThong',
            ],

            'VT_GiamDoc' => [
                'NS_012' => 'PV_CongTy',
                'NS_013' => 'PV_CongTy',
                'NS_015' => 'PV_CongTy',
                'NS_016' => 'PV_CongTy',
                'NS_017' => 'PV_CongTy',
            ],

            'VT_HR' => [
                'NS_011' => 'PV_CongTy',
                'NS_012' => 'PV_CongTy',
                'NS_013' => 'PV_CongTy',
                'NS_014' => 'PV_CongTy',
                'NS_015' => 'PV_CongTy',
                'NS_016' => 'PV_CongTy',
                'NS_017' => 'PV_CongTy',
            ],

            'VT_TruongPhong' => [
                'NS_012' => 'PV_PhongBan',
                'NS_013' => 'PV_PhongBan',
                'NS_015' => 'PV_CongTy',
                'NS_016' => 'PV_PhongBan',
                'NS_017' => 'PV_PhongBan',
            ],

            'VT_NhanVien' => [
                'NS_012' => 'PV_CaNhan',
                'NS_013' => 'PV_CaNhan',
            ],
        ];

        // Duyệt tất cả vai trò
        foreach ($vaiTros as $vaiTro) {

            // Duyệt tất cả chức năng
            foreach ($chucNangs as $chucNang) {

                // Duyệt tất cả phạm vi
                foreach ($phamVis as $phamVi) {

                    // Mặc định không được thực hiện
                    $duocThucHien = false;

                    // Kiểm tra vai trò có được cấp quyền không
                    if (
                        isset($quyenDuocThucHien[$vaiTro][$chucNang])
                        && $quyenDuocThucHien[$vaiTro][$chucNang] === $phamVi
                    ) {
                        $duocThucHien = true;
                    }

                    DB::table('vaitrochucnang')->updateOrInsert(
                        [
                            'ma_vai_tro' => $vaiTro,
                            'ma_chuc_nang' => $chucNang,
                            'ma_pham_vi' => $phamVi,
                        ],
                        [
                            'duoc_thuc_hien' => $duocThucHien,
                        ]
                    );
                }
            }
        }
    }
}
