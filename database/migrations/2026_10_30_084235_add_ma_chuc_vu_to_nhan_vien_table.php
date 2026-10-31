<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nhan_vien', function (Blueprint $table) {
            $table->string('ma_chuc_vu', 10)->nullable();

            $table->foreign('ma_chuc_vu')
                ->references('ma_chuc_vu')
                ->on('chuc_vu')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('nhan_vien', function (Blueprint $table) {
            $table->dropForeign(['ma_chuc_vu']);
            $table->dropColumn('ma_chuc_vu');
        });
    }
};