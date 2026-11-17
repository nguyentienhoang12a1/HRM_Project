<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class NhanVien extends Model
{
    use HasFactory;

    protected $table = 'NhanVien';
    protected $primaryKey = 'ma_nhan_vien';

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        // 1. Thông tin cơ bản
        'stt',
        'ma_nhan_vien',
        'ho_va_ten',
        'gioi_tinh',

        'ma_don_vi',
        'ma_phong_ban',
        'ma_bo_phan',
        'ma_chuc_vu',
        'chuc_danh_dam_nhiem',
        'ma_vi_tri_cong_viec',

        'so_di_dong',
        'ngay_vao_lam_viec',
        'ngay_canh_bao',
        'trang_thai_nhan_vien',

        // 2. Thông tin cá nhân và gia đình
        'ho',
        'ten',
        'ngay_sinh',
        'noi_sinh',
        'que_quan',
        'tinh_trang_hon_nhan',
        'ma_dan_toc',
        'ma_ton_giao',

        'la_dang_vien',
        'la_doan_vien',
        'da_tham_gia_quan_doi',
        'la_thuong_binh',
        'gia_dinh_liet_sy',
        'thanh_phan_gia_dinh',
        'thanh_phan_ban_than',

        // 3. Địa chỉ
        'hktt_tinh_tp',
        'hktt_phuong_xa',
        'hktt_dia_chi',

        'noi_o_tinh_tp',
        'noi_o_phuong_xa',
        'noi_o_dia_chi',

        // 4. Thông tin liên hệ
        'so_dien_thoai_co_quan',
        'email',

        'lien_he_khan_1_ten',
        'lien_he_khan_1_dien_thoai',
        'lien_he_khan_1_quan_he',
        'lien_he_khan_1_dia_chi',

        'lien_he_khan_2_ten',
        'lien_he_khan_2_dien_thoai',
        'lien_he_khan_2_quan_he',
        'lien_he_khan_2_dia_chi',

        // 5. Giấy tờ tùy thân
        'so_cccd',
        'ngay_cap_cccd',
        'noi_cap_cccd',

        // 6. Quá trình làm việc
        'noi_lam_viec',
        'ma_loai_lao_dong',
        'ngay_vao_cong_ty',
        'ngay_vao_chinh_thuc',
        'ngay_thoi_viec',

        // 7. Học vấn
        'ma_trinh_do_van_hoa',
        'bang_cap',
        'chuyen_nganh',
        'truong_tot_nghiep',
        'hinh_thuc_dao_tao',

        // 8. Ngân hàng
        'so_tai_khoan_ngan_hang',
        'chu_tai_khoan',
        'ma_ngan_hang',

        // 9. Thuế và tài khoản
        'ma_so_thue',
        'tai_khoan_dang_nhap',

        // 10. Sổ lao động
        'so_so_lao_dong',
        'ngay_cap_so_lao_dong',
        'noi_cap_so_lao_dong',

        // 11. Bảo hiểm
        'tham_gia_bhxh',
        'ngay_tham_gia_bhxh',

        'tham_gia_bhtn',
        'ngay_tham_gia_bhtn',

        'tham_gia_bhyt',
        'ngay_tham_gia_bhyt',

        // 12. Thông tin bổ sung
        'chieu_cao',
        'can_nang',
        'thong_tin_khac',

        // 13. Quản lý hồ sơ
        'ngay_tao',
        'ngay_cap_nhat',
        'trang_thai_phe_duyet',
        'ly_do_tu_choi',
    ];

    protected function casts(): array
    {
        return [
            // Số nguyên
            'stt' => 'integer',

            // Ngày tháng
            'ngay_vao_lam_viec' => 'date',
            'ngay_canh_bao' => 'date',
            'ngay_sinh' => 'date',
            'ngay_cap_cccd' => 'date',
            'ngay_vao_cong_ty' => 'date',
            'ngay_vao_chinh_thuc' => 'date',
            'ngay_thoi_viec' => 'date',
            'ngay_cap_so_lao_dong' => 'date',

            'ngay_tham_gia_bhxh' => 'date',
            'ngay_tham_gia_bhtn' => 'date',
            'ngay_tham_gia_bhyt' => 'date',

            'ngay_tao' => 'datetime',
            'ngay_cap_nhat' => 'datetime',

            // Boolean
            'la_dang_vien' => 'boolean',
            'la_doan_vien' => 'boolean',
            'da_tham_gia_quan_doi' => 'boolean',
            'la_thuong_binh' => 'boolean',
            'gia_dinh_liet_sy' => 'boolean',

            'tham_gia_bhxh' => 'boolean',
            'tham_gia_bhtn' => 'boolean',
            'tham_gia_bhyt' => 'boolean',

            // Số thập phân
            'chieu_cao' => 'decimal:2',
            'can_nang' => 'decimal:2',
        ];
    }


    // Một nhân viên có một tài khoản
    public function taiKhoan(): HasOne
    {
        return $this->hasOne(
            TaiKhoan::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }

    // Một nhân viên có nhiều hợp đồng
    public function hopDongs(): HasMany
    {
        return $this->hasMany(
            HopDong::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }

    // Một nhân viên có nhiều bảng chấm công
    public function chamCongs(): HasMany
    {
        return $this->hasMany(
            ChamCong::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }

    // Một nhân viên có nhiều thông tin lương
    public function thongTinLuongs(): HasMany
    {
        return $this->hasMany(
            ThongTinLuong::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }

    // Một nhân viên có nhiều đơn nghỉ phép
    public function donNghiPheps(): HasMany
    {
        return $this->hasMany(
            DonNghiPhep::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }

    // Một nhân viên nhận nhiều thông báo
    public function nguoiNhanThongBaos(): HasMany
    {
        return $this->hasMany(
            NguoiNhanThongBao::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }

    // Một nhân viên có thể quản lý nhiều phòng ban
    public function phongBanQuanLy(): HasMany
    {
        return $this->hasMany(
            PhongBan::class,
            'ma_truong_phong',
            'ma_nhan_vien'
        );
    }
    
    /**
     * Một nhân viên thuộc về một vị trí công việc.
     */
    public function viTriCongViec(): BelongsTo
    {
        return $this->belongsTo(
            ViTriCongViec::class,
            'ma_vi_tri_cong_viec',
            'ma_vi_tri_cong_viec'
        );
    }

        /**
     * Một nhân viên thuộc về một phong ban
     */
    public function phongBan(): BelongsTo
    {
        return $this->belongsTo(
            PhongBan::class,
            'ma_phong_ban',
            'ma_phong_ban'
        );
    }
        /**
     * Một nhân viên thuộc về một chuc vu
     */
    public function chuVu(): BelongsTo
    {
        return $this->belongsTo(
            ChucVu::class,
            'ma_chuc_vu',
            'ma_chuc_vu'
        );
    }

}



