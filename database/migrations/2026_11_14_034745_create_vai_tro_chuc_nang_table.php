<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('VaiTroChucNang', function (Blueprint $table) {
            $table->id();

            $table->string('ma_vai_tro',20);
            $table->string('ma_chuc_nang',20);
            $table->string('ma_pham_vi',20);

            $table->boolean('duoc_thuc_hien')->default(false);

            $table->foreign('ma_vai_tro')
                ->references('ma_vai_tro')
                ->on('VaiTro')
                ->cascadeOnDelete();

            $table->foreign('ma_chuc_nang')
                ->references('ma_chuc_nang')
                ->on('ChucNang')
                ->cascadeOnDelete();

            $table->foreign('ma_pham_vi')
                ->references('ma_pham_vi')
                ->on('PhamViQuyen')
                ->restrictOnDelete();

            $table->unique(
                ['ma_vai_tro', 'ma_chuc_nang', 'ma_pham_vi'],
                'uq_vai_tro_chuc_nang_pham_vi'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('VaiTroChucNang');
    }
};
