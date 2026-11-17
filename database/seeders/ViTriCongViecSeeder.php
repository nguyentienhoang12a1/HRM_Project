<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViTriCongViecSeeder extends Seeder
{
    public function run(): void
    {
        $viTris = [
            // PHÒNG TỔNG HỢP
            [
                'ma_vi_tri_cong_viec' => 'VT_PhoPhongTongHop',
                'ten_vi_tri_cong_viec' => 'Phó phòng tổng hợp',
                'ma_phong_ban' => 'PB_TongHop',
                'mo_ta' => 'Phụ trách hỗ trợ quản lý và điều hành hoạt động phòng Tổng hợp.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_TruongPhongTongHop',
                'ten_vi_tri_cong_viec' => 'Trưởng phòng tổng hợp',
                'ma_phong_ban' => 'PB_TongHop',
                'mo_ta' => 'Quản lý và điều hành hoạt động phòng Tổng hợp.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_NhanVienTongHop',
                'ten_vi_tri_cong_viec' => 'Nhân viên tổng hợp (HR)',
                'ma_phong_ban' => 'PB_TongHop',
                'mo_ta' => 'Phụ trách công tác nhân sự và hành chính tổng hợp.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_NhanVienKeToan',
                'ten_vi_tri_cong_viec' => 'Nhân viên kế toán',
                'ma_phong_ban' => 'PB_TongHop',
                'mo_ta' => 'Phụ trách công tác kế toán và tài chính.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_NhanVienLaiXe',
                'ten_vi_tri_cong_viec' => 'Nhân viên lái xe',
                'ma_phong_ban' => 'PB_TongHop',
                'mo_ta' => 'Phụ trách công tác lái xe và hỗ trợ vận chuyển.',
                'trang_thai' => 1,
            ],
            
            [
                'ma_vi_tri_cong_viec' => 'VT_ThuViecTongHop',
                'ten_vi_tri_cong_viec' => 'Nhân viên thử việc tổng hợp',
                'ma_phong_ban' => 'PB_TongHop',
                'mo_ta' => 'Thực hiện các công việc hành chính, nhân sự và hỗ trợ hoạt động phòng Tổng hợp trong thời gian thử việc.',
                'trang_thai' => 1,
            ],

            // PHÒNG KINH DOANH
            [
                'ma_vi_tri_cong_viec' => 'VT_PhoPhongKinhDoanh',
                'ten_vi_tri_cong_viec' => 'Phó phòng kinh doanh',
                'ma_phong_ban' => 'PB_KinhDoanh',
                'mo_ta' => 'Hỗ trợ quản lý và điều hành hoạt động phòng Kinh doanh.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_TruongPhongKinhDoanh',
                'ten_vi_tri_cong_viec' => 'Trưởng phòng kinh doanh',
                'ma_phong_ban' => 'PB_KinhDoanh',
                'mo_ta' => 'Quản lý và điều hành hoạt động kinh doanh.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_ChuyenVienKinhDoanh',
                'ten_vi_tri_cong_viec' => 'Chuyên viên kinh doanh',
                'ma_phong_ban' => 'PB_KinhDoanh',
                'mo_ta' => 'Tìm kiếm khách hàng, phát triển thị trường và triển khai hoạt động kinh doanh.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_ChuyenVienHoTroDuAn',
                'ten_vi_tri_cong_viec' => 'Chuyên viên hỗ trợ dự án',
                'ma_phong_ban' => 'PB_KinhDoanh',
                'mo_ta' => 'Hỗ trợ theo dõi và triển khai các dự án kinh doanh.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_ThuViecKinhDoanh',
                'ten_vi_tri_cong_viec' => 'Nhân viên thử việc kinh doanh',
                'ma_phong_ban' => 'PB_KinhDoanh',
                'mo_ta' => 'Hỗ trợ tìm kiếm khách hàng, phát triển thị trường và thực hiện các công việc kinh doanh trong thời gian thử việc.',
                'trang_thai' => 1,
            ],

            // PHÒNG GIẢI PHÁP 1
            [
                'ma_vi_tri_cong_viec' => 'VT_PhoPhongGiaiPhap1',
                'ten_vi_tri_cong_viec' => 'Phó phòng giải pháp 1',
                'ma_phong_ban' => 'PB_GiaiPhap1',
                'mo_ta' => 'Hỗ trợ quản lý và điều hành hoạt động phòng Giải pháp 1.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_TruongPhongGiaiPhap1',
                'ten_vi_tri_cong_viec' => 'Trưởng phòng giải pháp 1',
                'ma_phong_ban' => 'PB_GiaiPhap1',
                'mo_ta' => 'Quản lý và điều hành hoạt động phòng Giải pháp 1.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_KySuLapTrinh',
                'ten_vi_tri_cong_viec' => 'Kỹ sư lập trình',
                'ma_phong_ban' => 'PB_GiaiPhap1',
                'mo_ta' => 'Phát triển phần mềm, lập trình và xây dựng các giải pháp ứng dụng.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_ThuViecGiaiPhap1',
                'ten_vi_tri_cong_viec' => 'Nhân viên thử việc giải pháp 1',
                'ma_phong_ban' => 'PB_GiaiPhap1',
                'mo_ta' => 'Tham gia phát triển phần mềm, lập trình và hỗ trợ triển khai các giải pháp ứng dụng trong thời gian thử việc.',
                'trang_thai' => 1,
            ],

            // PHÒNG GIẢI PHÁP 2
            [
                'ma_vi_tri_cong_viec' => 'VT_PhoPhongGiaiPhap2',
                'ten_vi_tri_cong_viec' => 'Phó phòng giải pháp 2',
                'ma_phong_ban' => 'PB_GiaiPhap2',
                'mo_ta' => 'Hỗ trợ quản lý và điều hành hoạt động phòng Giải pháp 2.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_TruongPhongGiaiPhap2',
                'ten_vi_tri_cong_viec' => 'Trưởng phòng giải pháp 2',
                'ma_phong_ban' => 'PB_GiaiPhap2',
                'mo_ta' => 'Quản lý và điều hành hoạt động phòng Giải pháp 2.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_KySuQuanTriHeThong',
                'ten_vi_tri_cong_viec' => 'Kỹ sư quản trị hệ thống',
                'ma_phong_ban' => 'PB_GiaiPhap2',
                'mo_ta' => 'Quản trị, vận hành và bảo trì hệ thống công nghệ thông tin.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_KySuCoSoDuLieu',
                'ten_vi_tri_cong_viec' => 'Kỹ sư cơ sở dữ liệu',
                'ma_phong_ban' => 'PB_GiaiPhap2',
                'mo_ta' => 'Thiết kế, quản trị và tối ưu cơ sở dữ liệu.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_KySuAnToanThongTin',
                'ten_vi_tri_cong_viec' => 'Kỹ sư an toàn thông tin',
                'ma_phong_ban' => 'PB_GiaiPhap2',
                'mo_ta' => 'Đảm bảo an toàn thông tin và bảo mật hệ thống.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_ChuyenVienTuVanGiaiPhap',
                'ten_vi_tri_cong_viec' => 'Chuyên viên tư vấn giải pháp',
                'ma_phong_ban' => 'PB_GiaiPhap2',
                'mo_ta' => 'Nghiên cứu và tư vấn các giải pháp công nghệ thông tin.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_ChuyenVienTichHop',
                'ten_vi_tri_cong_viec' => 'Chuyên viên tích hợp',
                'ma_phong_ban' => 'PB_GiaiPhap2',
                'mo_ta' => 'Triển khai tích hợp các hệ thống và giải pháp công nghệ.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_ChuyenVienHoTroPhatTrien',
                'ten_vi_tri_cong_viec' => 'Chuyên viên hỗ trợ phát triển',
                'ma_phong_ban' => 'PB_GiaiPhap2',
                'mo_ta' => 'Hỗ trợ phát triển, triển khai và hoàn thiện các giải pháp công nghệ.',
                'trang_thai' => 1,
            ],
            [
                'ma_vi_tri_cong_viec' => 'VT_ThuViecGiaiPhap2',
                'ten_vi_tri_cong_viec' => 'Nhân viên thử việc giải pháp 2',
                'ma_phong_ban' => 'PB_GiaiPhap2',
                'mo_ta' => 'Hỗ trợ quản trị, vận hành hệ thống và triển khai các giải pháp công nghệ trong thời gian thử việc.',
                'trang_thai' => 1,
            ]
        ];

        foreach ($viTris as $viTri) {
            DB::table('vitricongviec')->updateOrInsert(
                ['ma_vi_tri_cong_viec' => $viTri['ma_vi_tri_cong_viec']],
                $viTri
            );
        }
    }
}