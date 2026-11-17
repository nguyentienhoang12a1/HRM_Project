<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('MaOTP')) {
            Schema::create('MaOTP', function (Blueprint $table) {
                $table->integer('id', true); // int PRIMARY KEY AUTO_INCREMENT
                $table->unsignedBigInteger('tai_khoan_id');
                $table->string('ma_otp', 6);
                $table->dateTime('thoi_gian_tao')->useCurrent();
                $table->dateTime('thoi_gian_het_han')->nullable();
                $table->boolean('da_su_dung')->default(false);
                $table->timestamps();

                $table->foreign('tai_khoan_id')->references('id')->on('TaiKhoan')->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('MaOTP');
    }
};