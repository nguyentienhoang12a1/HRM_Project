
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('NhanVien', function (Blueprint $table) {

            // Khóa chính
            $table->string('ma_nhan_vien', 20)->primary();

            // Thông tin cơ bản
            $table->integer('stt')->unique();
            $table->string('ho_va_ten', 100);
            $table->string('gioi_tinh', 10);

            $table->string('ma_phong_ban', 20);
            $table->string('ma_chuc_vu', 20);
            $table->string('chuc_danh_dam_nhiem', 255)->nullable();
            $table->string('ma_vi_tri_cong_viec', 50);

            $table->string('so_di_dong', 15);
            $table->date('ngay_vao_lam_viec');

            $table->date('ngay_canh_bao')->nullable();
            $table->string('trang_thai_nhan_vien', 50)->nullable();

            // Thông tin cá nhân và gia đình
            $table->string('ho', 50)->nullable();
            $table->string('ten', 50)->nullable();

            $table->date('ngay_sinh')->nullable();
            $table->string('noi_sinh', 255)->nullable();
            $table->string('que_quan', 255)->nullable();

            $table->string('tinh_trang_hon_nhan', 30)->nullable();

            $table->boolean('dan_toc')->default(false);
            $table->boolean('ton_giao')->default(false);

            $table->boolean('la_dang_vien')->default(false);
            $table->boolean('la_doan_vien')->default(false);
            $table->boolean('da_tham_gia_quan_doi')->default(false);
            $table->boolean('la_thuong_binh')->default(false);
            $table->boolean('gia_dinh_liet_sy')->default(false);

            $table->text('thanh_phan_gia_dinh')->nullable();
            $table->text('thanh_phan_ban_than')->nullable();

            // Địa chỉ thường trú
            $table->string('hktt_tinh_tp', 150)->nullable();
            $table->string('hktt_phuong_xa', 150)->nullable();
            $table->string('hktt_dia_chi', 255)->nullable();

            // Địa chỉ nơi ở
            $table->string('noi_o_tinh_tp', 150)->nullable();
            $table->string('noi_o_phuong_xa', 150)->nullable();
            $table->string('noi_o_dia_chi', 500)->nullable();

            // Thông tin liên hệ
            $table->string('so_dien_thoai_co_quan', 20)->nullable();
            $table->string('email', 100);

            $table->string('lien_he_khan_1_ten', 255)->nullable();
            $table->string('lien_he_khan_1_dien_thoai', 20)->nullable();
            $table->string('lien_he_khan_1_quan_he', 100)->nullable();
            $table->string('lien_he_khan_1_dia_chi', 500)->nullable();

            $table->string('lien_he_khan_2_ten', 255)->nullable();
            $table->string('lien_he_khan_2_dien_thoai', 20)->nullable();
            $table->string('lien_he_khan_2_quan_he', 100)->nullable();
            $table->string('lien_he_khan_2_dia_chi', 500)->nullable();

            // Giấy tờ tùy thân
            $table->string('so_cccd', 20)->unique();
            $table->date('ngay_cap_cccd')->nullable();
            $table->string('noi_cap_cccd', 255)->nullable();

            // Quá trình làm việc
            $table->string('noi_lam_viec', 255)->nullable();
            $table->string('ma_loai_lao_dong', 50)->nullable();
            $table->date('ngay_vao_cong_ty')->nullable();
            $table->date('ngay_vao_chinh_thuc')->nullable();
            $table->date('ngay_thoi_viec')->nullable();

            // Học vấn
            $table->string('ma_trinh_do_van_hoa', 50)->nullable();
            $table->string('bang_cap', 255)->nullable();
            $table->string('chuyen_nganh', 255)->nullable();
            $table->string('truong_tot_nghiep', 255)->nullable();
            $table->string('hinh_thuc_dao_tao', 100)->nullable();

            // Ngân hàng
            $table->string('so_tai_khoan_ngan_hang', 50)->nullable();
            $table->string('chu_tai_khoan', 255)->nullable();
            $table->string('ma_ngan_hang', 50)->nullable();

            // Thuế và tài khoản
            $table->string('ma_so_thue', 20)->unique();
            $table->string('tai_khoan_dang_nhap', 100)->nullable();

            // Sổ lao động
            $table->string('so_so_lao_dong', 30)->unique();
            $table->date('ngay_cap_so_lao_dong')->nullable();
            $table->string('noi_cap_so_lao_dong', 255)->nullable();

            // Bảo hiểm
            $table->boolean('tham_gia_bhxh')->default(false);
            $table->date('ngay_tham_gia_bhxh')->nullable();

            $table->boolean('tham_gia_bhtn')->default(false);
            $table->date('ngay_tham_gia_bhtn')->nullable();

            $table->boolean('tham_gia_bhyt')->default(false);
            $table->date('ngay_tham_gia_bhyt')->nullable();

            // Thông tin bổ sung
            $table->decimal('chieu_cao', 5, 2)->nullable();
            $table->decimal('can_nang', 5, 2)->nullable();
            $table->text('thong_tin_khac')->nullable();

            // Quản lý hồ sơ
            $table->dateTime('ngay_tao')->nullable();
            $table->dateTime('ngay_cap_nhat')->nullable();

            $table->boolean('trang_thai_phe_duyet') ->default(false);

            $table->text('ly_do_tu_choi')->nullable();

            // Khóa ngoại
            $table->foreign('ma_phong_ban')
                ->references('ma_phong_ban')
                ->on('PhongBan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('ma_vi_tri_cong_viec')
                ->references('ma_vi_tri_cong_viec')
                ->on('ViTriCongViec')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Index tìm kiếm
            $table->index('ho_va_ten');
            $table->index('trang_thai_nhan_vien');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('NhanVien');
    }
};
