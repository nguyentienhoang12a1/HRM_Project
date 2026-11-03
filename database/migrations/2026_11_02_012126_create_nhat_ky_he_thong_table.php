<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('NhatKyHeThong')) {
            Schema::create('NhatKyHeThong', function (Blueprint $table) {
                $table->integer('id', true); // int PRIMARY KEY AUTO_INCREMENT
                $table->integer('nguoi_thuc_hien_id')->nullable();
                $table->string('hanh_dong', 100);
                $table->text('chi_tiet');
                $table->string('ip_address', 45)->nullable();
                $table->timestamps();

                $table->foreign('nguoi_thuc_hien_id')->references('id')->on('TaiKhoan')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('NhatKyHeThong');
    }
};