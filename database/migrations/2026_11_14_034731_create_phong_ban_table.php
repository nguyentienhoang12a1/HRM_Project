<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('PhongBan', function (Blueprint $table) {
            $table->string('ma_phong_ban', 50)->primary();
            $table->string('ten_phong_ban', 255);
            $table->string('ma_truong_phong', 50)->nullable();
            $table->text('mo_ta')->nullable();
            $table->boolean('trang_thai')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('PhongBan');
    }
};
