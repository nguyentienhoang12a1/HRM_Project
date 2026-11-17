<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('TaiKhoanVaiTro', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tai_khoan_id');
            $table->string('ma_vai_tro',20);

            $table->foreign('tai_khoan_id')
                ->references('id')
                ->on('TaiKhoan')
                ->cascadeOnDelete();

            $table->foreign('ma_vai_tro')
                ->references('ma_vai_tro')
                ->on('VaiTro')
                ->cascadeOnDelete();

            $table->unique(
                ['tai_khoan_id', 'ma_vai_tro'],
                'uq_tai_khoan_vai_tro'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('TaiKhoanVaiTro');
    }
};
