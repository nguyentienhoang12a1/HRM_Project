<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    protected $table = 'NhanVien';
    protected $primaryKey = 'ma_nhan_vien';
    public $incrementing = false;
    protected $keyType = 'string';

    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    protected $fillable = [
        'stt', 'ma_nhan_vien', 'ho_va_ten', 'gioi_tinh',
        'ma_phong_ban', 'ma_chuc_vu', 'chuc_danh_dam_nhiem', 'ma_vi_tri_cong_viec',
        'so_di_dong', 'ngay_vao_lam_viec', 'ngay_canh_bao', 'trang_thai_nhan_vien',
        'ho', 'ten', 'ngay_sinh', 'noi_sinh', 'que_quan', 'tinh_trang_hon_nhan',
        'dan_toc', 'ton_giao', 'la_dang_vien', 'la_doan_vien',
        'da_tham_gia_quan_doi', 'la_thuong_binh', 'gia_dinh_liet_sy',
        'thanh_phan_gia_dinh', 'thanh_phan_ban_than',
        'hktt_tinh_tp', 'hktt_phuong_xa', 'hktt_dia_chi',
        'noi_o_tinh_tp', 'noi_o_phuong_xa', 'noi_o_dia_chi',
        'so_dien_thoai_co_quan', 'email',
        'lien_he_khan_1_ten', 'lien_he_khan_1_dien_thoai', 'lien_he_khan_1_quan_he', 'lien_he_khan_1_dia_chi',
        'lien_he_khan_2_ten', 'lien_he_khan_2_dien_thoai', 'lien_he_khan_2_quan_he', 'lien_he_khan_2_dia_chi',
        'so_cccd', 'ngay_cap_cccd', 'noi_cap_cccd', 'noi_lam_viec',
        'ma_loai_lao_dong', 'ngay_vao_cong_ty', 'ngay_vao_chinh_thuc', 'ngay_thoi_viec',
        'ma_trinh_do_van_hoa', 'bang_cap', 'chuyen_nganh', 'truong_tot_nghiep', 'hinh_thuc_dao_tao',
        'so_tai_khoan_ngan_hang', 'chu_tai_khoan', 'ma_ngan_hang',
        'ma_so_thue', 'tai_khoan_dang_nhap', 'so_so_lao_dong', 'ngay_cap_so_lao_dong', 'noi_cap_so_lao_dong',
        'tham_gia_bhxh', 'ngay_tham_gia_bhxh', 'tham_gia_bhtn', 'ngay_tham_gia_bhtn',
        'tham_gia_bhyt', 'ngay_tham_gia_bhyt', 'chieu_cao', 'can_nang',
        'thong_tin_khac', 'face_vector', 'trang_thai_phe_duyet', 'ly_do_tu_choi',
    ];

    public function phongBan()
    {
        return $this->belongsTo(PhongBan::class, 'ma_phong_ban', 'ma_phong_ban');
    }

    public function chucVu()
    {
        return $this->belongsTo(ChucVu::class, 'ma_chuc_vu', 'ma_chuc_vu');
    }

    public function viTriCongViec()
    {
        return $this->belongsTo(ViTriCongViec::class, 'ma_vi_tri_cong_viec', 'ma_vi_tri_cong_viec');
    }

    public function taiKhoan()
    {
        return $this->hasOne(TaiKhoan::class, 'ma_nhan_vien', 'ma_nhan_vien');
    }

    public function chamCongs()
    {
        return $this->hasMany(ChamCong::class, 'ma_nhan_vien', 'ma_nhan_vien');
    }

    public function hopDongs()
    {
        return $this->hasMany(HopDong::class, 'ma_nhan_vien', 'ma_nhan_vien');
    }

    public function donNghiPheps()
    {
        return $this->hasMany(DonNghiPhep::class, 'ma_nhan_vien', 'ma_nhan_vien');
    }

    public function thongTinLuongs()
    {
        return $this->hasMany(ThongTinLuong::class, 'ma_nhan_vien', 'ma_nhan_vien');
    }
}