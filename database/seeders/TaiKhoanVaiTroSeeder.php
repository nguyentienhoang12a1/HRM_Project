<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TaiKhoanVaiTro;

class TaiKhoanVaiTroSeeder extends Seeder
{
    public function run(): void
    {
        $taiKhoanAdmin = DB::table('TaiKhoan')
            ->where('ten_tai_khoan', 'admin@vnpt.vn')
            ->value('id');

        $taiKhoanGiamDoc = DB::table('TaiKhoan')
            ->where('ten_tai_khoan', 'giamdoc@vnpt.vn')
            ->value('id');

        $taiKhoanHR = DB::table('TaiKhoan')
            ->where('ten_tai_khoan', 'hr@vnpt.vn')
            ->value('id');

        $taiKhoanTruongPhong = DB::table('TaiKhoan')
            ->where('ten_tai_khoan', 'truongphong@vnpt.vn')
            ->value('id');
        
        $taiKhoanNhanVien = DB::table('TaiKhoan')
            ->where('ten_tai_khoan', 'nhanvien@vnpt.vn')
            ->value('id');


        DB::table('TaiKhoanVaiTro')->insert([
            [
                'tai_khoan_id' => $taiKhoanAdmin,
                'ma_vai_tro' => 'VT_Admin',
            ],
            [
                'tai_khoan_id' => $taiKhoanNhanVien,
                'ma_vai_tro' => 'VT_NhanVien',
            ],
            [
                'tai_khoan_id' => $taiKhoanTruongPhong,
                'ma_vai_tro' => 'VT_TruongPhong',
            ],
            [
                'tai_khoan_id' => $taiKhoanGiamDoc,
                'ma_vai_tro' => 'VT_GiamDoc',
            ],
            [
                'tai_khoan_id' => $taiKhoanHR,
                'ma_vai_tro' => 'VT_HR',
            ],

        ]);
    }
}