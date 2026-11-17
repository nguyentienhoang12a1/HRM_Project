<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('PhongBanChucVu', function (Blueprint $table) {
            $table->id();

            $table->string('ma_phong_ban', 20);
            $table->string('ma_chuc_vu', 20);
            $table->text('mo_ta')->nullable();

            $table->foreign('ma_phong_ban')
                ->references('ma_phong_ban')
                ->on('PhongBan')
                ->cascadeOnDelete();

            $table->foreign('ma_chuc_vu')
                ->references('ma_chuc_vu')
                ->on('ChucVu')
                ->cascadeOnDelete();

            $table->unique(
                ['ma_phong_ban', 'ma_chuc_vu'],
                'uq_phong_ban_chuc_vu'
            );


            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('PhongBanChucVu');
    }
};
