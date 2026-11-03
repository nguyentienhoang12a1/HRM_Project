<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ChucVu')) {
            Schema::create('ChucVu', function (Blueprint $table) {
                $table->string('ma_chuc_vu', 20)->primary();
                $table->string('ten_chuc_vu', 100);
                $table->string('ma_phong', 20);

                $table->foreign('ma_phong')->references('ma_phong')->on('PhongBan')->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ChucVu');
    }
};