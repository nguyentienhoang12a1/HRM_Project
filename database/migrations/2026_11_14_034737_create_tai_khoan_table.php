<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('TaiKhoan', function (Blueprint $table) {
            $table->id();

            $table->string('ten_tai_khoan', 50)->unique();
            $table->string('mat_khau', 255);

            $table->string('ma_nhan_vien', 20)->nullable()->unique();

            $table->boolean('trang_thai')->default(false);

            $table->foreign('ma_nhan_vien')
                ->references('ma_nhan_vien')
                ->on('NhanVien')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('TaiKhoan');
    }
};
