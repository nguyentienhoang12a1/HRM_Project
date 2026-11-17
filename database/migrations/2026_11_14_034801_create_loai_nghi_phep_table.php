<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('LoaiNghiPhep', function (Blueprint $table) {
            $table->string('ma_loai_nghi', 50)->primary();

            $table->string('ten_loai_nghi', 255);
            $table->boolean('huong_luong')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('LoaiNghiPhep');
    }
};
