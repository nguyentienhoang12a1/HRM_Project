<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ChiTietLuong', function (Blueprint $table) {
            $table->string('ma_chi_tiet', 50)->primary();

            $table->string('ma_bang_luong', 20);
            $table->string('ma_khoan', 50);

            $table->decimal('so_luong', 10, 2)->default(0);
            $table->decimal('don_gia', 15, 2)->default(0);
            $table->decimal('so_tien', 15, 2)->default(0);

            $table->text('ghi_chu')->nullable();

            $table->foreign('ma_bang_luong')
                ->references('ma_bang_luong')
                ->on('BangLuong')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('ma_khoan')
                ->references('ma_khoan')
                ->on('KhoanLuong')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->index('ma_bang_luong');
            $table->index('ma_khoan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ChiTietLuong');
    }
};
