<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tai_khoan', function (Blueprint $table) {
            $table->id();

            $table->string('ten_tai_khoan')->unique();

            $table->string('mat_khau');

            $table->string('ma_nhan_vien', 20)->unique();

            $table->timestamps();

            $table->foreign('ma_nhan_vien')
                ->references('ma_nhan_vien')
                ->on('nhan_vien')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tai_khoan');
    }
};