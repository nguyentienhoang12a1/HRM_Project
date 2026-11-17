<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ThongTinLuong', function (Blueprint $table) {
            $table->string('ma_thong_tin_luong', 20)->primary();

            $table->string('ma_nhan_vien', 50);

            $table->decimal('luong_co_ban', 15, 2)->default(0);
            $table->decimal('phu_cap', 15, 2)->default(0);

            $table->date('ngay_hieu_luc');
            $table->date('ngay_het_hieu_luc')->nullable();

            $table->foreign('ma_nhan_vien')
                ->references('ma_nhan_vien')
                ->on('NhanVien')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->index('ma_nhan_vien');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ThongTinLuong');
    }
};
