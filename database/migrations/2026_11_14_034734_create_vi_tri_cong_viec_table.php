<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ViTriCongViec', function (Blueprint $table) {

            // Khóa chính
            $table->string('ma_vi_tri_cong_viec', 50)->primary();

            // Tên vị trí công việc
            $table->string('ten_vi_tri_cong_viec', 150);

            // Phòng ban quản lý vị trí
            $table->string('ma_phong_ban', 20);

            // Mô tả
            $table->text('mo_ta')->nullable();

            // Trạng thái
            $table->boolean('trang_thai')->default(true);

            // FK: ViTriCongViec -> PhongBan
            $table->foreign('ma_phong_ban')
                ->references('ma_phong_ban')
                ->on('PhongBan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Không trùng tên vị trí trong cùng phòng ban
            $table->unique(
                ['ten_vi_tri_cong_viec', 'ma_phong_ban'],
                'uq_vi_tri_cong_viec_ten_phong'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ViTriCongViec');
    }
};
