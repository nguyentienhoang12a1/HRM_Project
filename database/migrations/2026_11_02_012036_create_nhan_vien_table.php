<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('NhanVien')) {
            Schema::create('NhanVien', function (Blueprint $table) {
                $table->string('ma_nhan_vien', 20)->primary();
                $table->string('ho_va_ten', 100);
                $table->date('ngay_sinh')->nullable();
                $table->string('que_quan', 255)->nullable();
                $table->string('email', 100)->unique()->nullable();
                $table->string('so_dien_thoai', 15)->nullable();
                $table->string('ma_chuc_vu', 20);
                $table->string('trang_thai', 30)->default('Thu viec');

                $table->foreign('ma_chuc_vu')->references('ma_chuc_vu')->on('ChucVu')->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('NhanVien');
    }
};