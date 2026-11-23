<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaiTroChucNangSeeder extends Seeder
{
    public function run(): void
    {
        $phanQuyens = [
            // 1. Admin: Toàn quyền hệ thống
            ['ma_vai_tro' => 'VT_Admin', 'ma_chuc_nang' => 'QT_001', 'ma_pham_vi' => 'PV_HeThong',  'duoc_thuc_hien' => true],
            ['ma_vai_tro' => 'VT_Admin', 'ma_chuc_nang' => 'NS_012', 'ma_pham_vi' => 'PV_HeThong',  'duoc_thuc_hien' => true],
            ['ma_vai_tro' => 'VT_Admin', 'ma_chuc_nang' => 'NS_013', 'ma_pham_vi' => 'PV_HeThong',  'duoc_thuc_hien' => true],
            ['ma_vai_tro' => 'VT_Admin', 'ma_chuc_nang' => 'NS_014', 'ma_pham_vi' => 'PV_HeThong',  'duoc_thuc_hien' => true],
            ['ma_vai_tro' => 'VT_Admin', 'ma_chuc_nang' => 'NS_015', 'ma_pham_vi' => 'PV_HeThong',  'duoc_thuc_hien' => true],

            // 2. HR: Quản lý nhân sự toàn công ty
            ['ma_vai_tro' => 'VT_HR',    'ma_chuc_nang' => 'NS_012', 'ma_pham_vi' => 'PV_CongTy',   'duoc_thuc_hien' => true],
            ['ma_vai_tro' => 'VT_HR',    'ma_chuc_nang' => 'NS_013', 'ma_pham_vi' => 'PV_CongTy',   'duoc_thuc_hien' => true],
            ['ma_vai_tro' => 'VT_HR',    'ma_chuc_nang' => 'NS_014', 'ma_pham_vi' => 'PV_CongTy',   'duoc_thuc_hien' => true],
            ['ma_vai_tro' => 'VT_HR',    'ma_chuc_nang' => 'NS_015', 'ma_pham_vi' => 'PV_CongTy',   'duoc_thuc_hien' => true],

            // 3. Trưởng phòng: Xem nhân sự trong phòng ban của mình
            ['ma_vai_tro' => 'VT_TruongPhong', 'ma_chuc_nang' => 'NS_012', 'ma_pham_vi' => 'PV_PhongBan', 'duoc_thuc_hien' => true],
            ['ma_vai_tro' => 'VT_TruongPhong', 'ma_chuc_nang' => 'NS_015', 'ma_pham_vi' => 'PV_PhongBan', 'duoc_thuc_hien' => true],

            // 4. Nhân viên: Chỉ xem hồ sơ cá nhân
            ['ma_vai_tro' => 'VT_NhanVien', 'ma_chuc_nang' => 'NS_012', 'ma_pham_vi' => 'PV_CaNhan', 'duoc_thuc_hien' => true],
            
        ];

        foreach ($phanQuyens as $pq) {
            // Xóa bản ghi phạm vi cũ khác với phạm vi chuẩn để tránh trùng khóa duy nhất 3 cột
            DB::table('VaiTroChucNang')
                ->where('ma_vai_tro', $pq['ma_vai_tro'])
                ->where('ma_chuc_nang', $pq['ma_chuc_nang'])
                ->where('ma_pham_vi', '!=', $pq['ma_pham_vi'])
                ->delete();

            // Cập nhật hoặc thêm mới theo đúng 3 cột của uq_vai_tro_chuc_nang_pham_vi
            DB::table('VaiTroChucNang')->updateOrInsert(
                [
                    'ma_vai_tro'   => $pq['ma_vai_tro'],
                    'ma_chuc_nang' => $pq['ma_chuc_nang'],
                    'ma_pham_vi'   => $pq['ma_pham_vi'],
                ],
                [
                    'duoc_thuc_hien' => $pq['duoc_thuc_hien'],
                ]
            );
        }
    }
}