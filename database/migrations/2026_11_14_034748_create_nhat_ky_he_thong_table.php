<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('NhatKyHeThong', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('nguoi_thuc_hien_id')->nullable();

            $table->string('hanh_dong', 255);
            $table->text('chi_tiet')->nullable();
            $table->string('ip_address', 45)->nullable();

            // Sử dụng DATETIME thay vì TIMESTAMP
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->foreign('nguoi_thuc_hien_id')
                ->references('id')
                ->on('TaiKhoan')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->index('hanh_dong');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('NhatKyHeThong');
    }
};
