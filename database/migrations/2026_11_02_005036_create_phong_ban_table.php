<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('PhongBan')) {
            Schema::create('PhongBan', function (Blueprint $table) {
                $table->string('ma_phong', 20)->primary();
                $table->string('ten_phong', 100);
                $table->string('ma_truong_phong', 20)->nullable();
                $table->text('mo_ta')->nullable();
                $table->string('trang_thai', 30)->default('Hoat dong');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('PhongBan');
    }
};