<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\NhanVien;

class NhanVienSeeder extends Seeder
{
    public function run(): void
    {
        $nhom = [
            [
                'prefix' => 'hoang',
                'email' => 'nguyentienhoang06102004@gmail.com',
                'phong_ban' => 'PB_TongHop',
                'vi_tri' => [
                    'VT_NhanVienTongHop',
                    'VT_TruongPhongTongHop',
                    'VT_NhanVienTongHop',
                    'VT_TruongPhongTongHop',
                    'VT_NhanVienTongHop',
                ],
            ],
            [
                'prefix' => 'hieu',
                'email' => 'hieudc205@gmail.com',
                'phong_ban' => 'PB_KinhDoanh',
                'vi_tri' => [
                    'VT_ChuyenVienKinhDoanh',
                    'VT_TruongPhongKinhDoanh',
                    'VT_NhanVienTongHop',
                    'VT_TruongPhongKinhDoanh',
                    'VT_ChuyenVienKinhDoanh',
                ],
            ],
            [
                'prefix' => 'khang',
                'email' => 'huukhang@gmail.com',
                'phong_ban' => 'PB_GiaiPhap1',
                'vi_tri' => [
                    'VT_KySuLapTrinh',
                    'VT_TruongPhongGiaiPhap1',
                    'VT_KySuLapTrinh',
                    'VT_TruongPhongGiaiPhap1',
                    'VT_KySuLapTrinh',
                ],
            ],
        ];

        $vaiTros = [
            [
                'ten' => 'Admin',
                'chuc_vu' => 'CV_NhanVien',
                'tai_khoan' => 'admin',
                'ho' => 'Nguyễn Tiến',
                'ten_dem' => 'Hoàng',
                'gioi_tinh' => 'Nam',
            ],
            [
                'ten' => 'Giám đốc',
                'chuc_vu' => 'CV_GiamDoc',
                'tai_khoan' => 'giamdoc',
                'ho' => 'Trần Văn',
                'ten_dem' => 'Giám đốc',
                'gioi_tinh' => 'Nam',
            ],
            [
                'ten' => 'HR',
                'chuc_vu' => 'CV_NhanVien',
                'tai_khoan' => 'hr',
                'ho' => 'Lê Thị',
                'ten_dem' => 'Nhân sự',
                'gioi_tinh' => 'Nữ',
            ],
            [
                'ten' => 'Trưởng phòng',
                'chuc_vu' => 'CV_TruongPhong',
                'tai_khoan' => 'truongphong',
                'ho' => 'Phạm Văn',
                'ten_dem' => 'Trưởng phòng',
                'gioi_tinh' => 'Nam',
            ],
            [
                'ten' => 'Nhân viên',
                'chuc_vu' => 'CV_NhanVien',
                'tai_khoan' => 'nhanvien',
                'ho' => 'Hoàng Minh',
                'ten_dem' => 'Nhân viên',
                'gioi_tinh' => 'Nam',
            ],
        ];

        $now = now();
        $stt = 1;

        foreach ($nhom as $nhomIndex => $nhomData) {

            foreach ($vaiTros as $vaiTroIndex => $vaiTro) {

                $maNhanVien = 'VNPT' . str_pad($stt, 4, '0', STR_PAD_LEFT);

                $tenTaiKhoan = $nhomData['prefix']
                    . $vaiTro['tai_khoan'] . '@vnpt.vn';

                $maPhongBan = $nhomData['phong_ban'];

                $maViTri = $nhomData['vi_tri'][$vaiTroIndex];

                // Sinh thông tin cá nhân riêng cho từng nhân viên
                $ho = $vaiTro['ho'];
                $ten = $nhomData['prefix'] . ' '
                    . $vaiTro['ten_dem'];

                $hoVaTen = $ho . ' ' . $ten;

                $ngayVaoLam = '2024-01-01';

                $data = [
                    'ma_nhan_vien' => $maNhanVien,
                    'stt' => $stt,

                    // Thông tin cơ bản
                    'ho_va_ten' => $hoVaTen,
                    'gioi_tinh' => $vaiTro['gioi_tinh'],
                    'ma_phong_ban' => $maPhongBan,
                    'ma_chuc_vu' => $vaiTro['chuc_vu'],
                    'chuc_danh_dam_nhiem' => $vaiTro['ten'],
                    'ma_vi_tri_cong_viec' => $maViTri,
                    'so_di_dong' => '098' . str_pad($stt, 7, '0', STR_PAD_LEFT),
                    'ngay_vao_lam_viec' => $ngayVaoLam,
                    'ngay_canh_bao' => null,
                    'trang_thai_nhan_vien' => 'Đang làm việc',

                    // Cá nhân và gia đình
                    'ho' => $ho,
                    'ten' => $ten,
                    'ngay_sinh' => '1995-01-01',
                    'noi_sinh' => 'Hà Nội',
                    'que_quan' => 'Hà Nội',
                    'tinh_trang_hon_nhan' => 'Độc thân',

                    'dan_toc' => false,
                    'ton_giao' => false,
                    'la_dang_vien' => false,
                    'la_doan_vien' => true,
                    'da_tham_gia_quan_doi' => false,
                    'la_thuong_binh' => false,
                    'gia_dinh_liet_sy' => false,

                    'thanh_phan_gia_dinh' => 'Gia đình công chức',
                    'thanh_phan_ban_than' => 'Nhân viên công ty',

                    // Địa chỉ
                    'hktt_tinh_tp' => 'Hà Nội',
                    'hktt_phuong_xa' => 'Phường Cầu Giấy',
                    'hktt_dia_chi' => 'Hà Nội, Việt Nam',

                    'noi_o_tinh_tp' => 'Hà Nội',
                    'noi_o_phuong_xa' => 'Phường Cầu Giấy',
                    'noi_o_dia_chi' => 'Hà Nội, Việt Nam',

                    // Liên hệ
                    'so_dien_thoai_co_quan' => '02430000001',
                    'email' => $nhomData['email'],

                    'lien_he_khan_1_ten' => 'Người thân',
                    'lien_he_khan_1_dien_thoai' => '0970000001',
                    'lien_he_khan_1_quan_he' => 'Gia đình',
                    'lien_he_khan_1_dia_chi' => 'Hà Nội',

                    // CCCD
                    'so_cccd' => '001095000' . str_pad($stt, 3, '0', STR_PAD_LEFT),
                    'ngay_cap_cccd' => '2020-01-01',
                    'noi_cap_cccd' => 'Cục Cảnh sát QLHC về TTXH',

                    // Quá trình làm việc
                    'noi_lam_viec' => 'VNPT',
                    'ma_loai_lao_dong' => 'ChinhThuc',
                    'ngay_vao_cong_ty' => $ngayVaoLam,
                    'ngay_vao_chinh_thuc' => $ngayVaoLam,
                    'ngay_thoi_viec' => null,

                    // Học vấn
                    'ma_trinh_do_van_hoa' => 'DaiHoc',
                    'bang_cap' => 'Đại học',
                    'chuyen_nganh' => 'Công nghệ thông tin',
                    'truong_tot_nghiep' => 'Đại học Bách Khoa Hà Nội',
                    'hinh_thuc_dao_tao' => 'Chính quy',

                    // Ngân hàng
                    'so_tai_khoan_ngan_hang' => '123456789' . str_pad($stt, 3, '0', STR_PAD_LEFT),
                    'chu_tai_khoan' => $hoVaTen,
                    'ma_ngan_hang' => 'VCB',

                    // Thuế và tài khoản
                    'ma_so_thue' => '010000' . str_pad($stt, 4, '0', STR_PAD_LEFT),
                    'tai_khoan_dang_nhap' => $tenTaiKhoan,

                    // Sổ lao động
                    'so_so_lao_dong' => 'SLD' . str_pad($stt, 6, '0', STR_PAD_LEFT),
                    'ngay_cap_so_lao_dong' => '2024-01-01',
                    'noi_cap_so_lao_dong' => 'Hà Nội',

                    // Bảo hiểm
                    'tham_gia_bhxh' => true,
                    'ngay_tham_gia_bhxh' => $ngayVaoLam,
                    'tham_gia_bhtn' => true,
                    'ngay_tham_gia_bhtn' => $ngayVaoLam,
                    'tham_gia_bhyt' => true,
                    'ngay_tham_gia_bhyt' => $ngayVaoLam,

                    // Bổ sung
                    'chieu_cao' => 170,
                    'can_nang' => 65,
                    'thong_tin_khac' => 'Hồ sơ nhân viên mẫu',

                    // Quản lý hồ sơ
                    'ngay_tao' => $now,
                    'ngay_cap_nhat' => $now,
                    'trang_thai_phe_duyet' => true,
                    'ly_do_tu_choi' => null,
                ];

                DB::table('NhanVien')->updateOrInsert(
                    ['ma_nhan_vien' => $maNhanVien],
                    $data
                );

                $stt++;
            }
        }
    }
}
