<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('VaiTro', function (Blueprint $table) {
            $table->string('ma_vai_tro',20)->primary();
            $table->string('ten_vai_tro', 50);
            $table->text('mo_ta')->nullable();
            $table->boolean('trang_thai')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('VaiTro');
    }
};
