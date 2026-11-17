<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('NhanVien', function (Blueprint $table) {
            $table->foreign('ma_chuc_vu')
                ->references('ma_chuc_vu')
                ->on('ChucVu')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }


    public function down(): void
    {
        Schema::table('NhanVien', function (Blueprint $table) {
            $table->dropForeign(['ma_chuc_vu']);
        });
    }
};


