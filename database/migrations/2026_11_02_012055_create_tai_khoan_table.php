<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tạo bảng PhanQuyen theo đúng HRM.sql
        if (!Schema::hasTable('PhanQuyen')) {
            Schema::create('PhanQuyen', function (Blueprint $table) {
                $table->integer('ma_quyen', true); // int PRIMARY KEY AUTO_INCREMENT
                $table->string('ten_quyen', 50)->unique();
                $table->string('mo_ta', 255)->nullable();
            });
        }

        // 2. Tạo bảng TaiKhoan theo đúng HRM.sql
        if (!Schema::hasTable('TaiKhoan')) {
            Schema::create('TaiKhoan', function (Blueprint $table) {
                $table->integer('id', true); // int PRIMARY KEY AUTO_INCREMENT
                $table->string('ten_tai_khoan', 50)->unique();
                $table->string('mat_khau', 255);
                $table->string('ma_nhan_vien', 20)->unique();
                $table->integer('ma_quyen');

                $table->foreign('ma_quyen')->references('ma_quyen')->on('PhanQuyen')->cascadeOnDelete();
                $table->foreign('ma_nhan_vien')->references('ma_nhan_vien')->on('NhanVien')->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('TaiKhoan');
        Schema::dropIfExists('PhanQuyen');
    }
};