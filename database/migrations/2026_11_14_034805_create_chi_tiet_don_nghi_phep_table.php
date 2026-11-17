<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ChiTietDonNghiPhep', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_don_nghi_phep');
            $table->string('ma_loai_nghi', 50);

            $table->decimal('so_ngay', 8, 2)->default(0);

            $table->foreign('id_don_nghi_phep')
                ->references('id')
                ->on('DonNghiPhep')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('ma_loai_nghi')
                ->references('ma_loai_nghi')
                ->on('LoaiNghiPhep')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->index('ma_loai_nghi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ChiTietDonNghiPhep');
    }
};
