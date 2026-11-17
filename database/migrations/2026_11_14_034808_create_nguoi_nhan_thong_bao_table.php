<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('NguoiNhanThongBao', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_thong_bao');
            $table->string('ma_nhan_vien', 50);

            $table->boolean('da_doc')->default(false);
            $table->dateTime('ngay_doc')->nullable();

            $table->foreign('id_thong_bao')
                ->references('id')
                ->on('ThongBao')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('ma_nhan_vien')
                ->references('ma_nhan_vien')
                ->on('NhanVien')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(
                ['id_thong_bao', 'ma_nhan_vien'],
                'uq_nguoi_nhan_thong_bao'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('NguoiNhanThongBao');
    }
};
