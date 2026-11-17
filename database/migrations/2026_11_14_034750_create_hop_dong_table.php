<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('HopDong', function (Blueprint $table) {
            $table->string('ma_hop_dong', 20)->primary();

            $table->string('loai_hop_dong', 100);
            $table->date('ngay_ky')->nullable();
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc')->nullable();

            $table->decimal('muc_luong', 15, 2)->default(0);

            $table->string('ma_nhan_vien', 50);

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
        Schema::dropIfExists('HopDong');
    }
};
