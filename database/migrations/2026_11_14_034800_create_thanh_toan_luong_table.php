<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ThanhToanLuong', function (Blueprint $table) {
            $table->string('ma_thanh_toan', 50)->primary();

            $table->string('ma_bang_luong', 50);

            $table->dateTime('ngay_thanh_toan')->nullable();
            $table->decimal('so_tien_thanh_toan', 15, 2)->default(0);

            $table->string('phuong_thuc', 100)->nullable();
            $table->string('ma_giao_dich', 100)->nullable();
            $table->string('trang_thai', 50)->nullable();

            $table->foreign('ma_bang_luong')
                ->references('ma_bang_luong')
                ->on('BangLuong')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->index('ma_bang_luong');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ThanhToanLuong');
    }
};
