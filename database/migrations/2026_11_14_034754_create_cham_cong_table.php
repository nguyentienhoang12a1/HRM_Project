<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ChamCong', function (Blueprint $table) {
            $table->id();
            $table->string('ma_nhan_vien', 20);
            $table->timestamp('thoi_gian_vao')->nullable();
            $table->timestamp('thoi_gian_ra')->nullable();
            $table->string('trang_thai', 255)->default('Thành công');
            $table->timestamps();

            $table->foreign('ma_nhan_vien')
                ->references('ma_nhan_vien')
                ->on('NhanVien')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ChamCong');
    }
};
