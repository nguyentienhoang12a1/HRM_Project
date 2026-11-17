
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('BangLuong', function (Blueprint $table) {
            $table->string('ma_bang_luong', 20)->primary();

            $table->unsignedInteger('id_cham_cong')->unique();

            $table->string('ma_thong_tin_luong', 20);

            $table->decimal('tong_thu_nhap', 15, 2)->default(0);
            $table->decimal('tong_khau_tru', 15, 2)->default(0);
            $table->decimal('luong_thuc_nhan', 15, 2)->default(0);

            $table->string('trang_thai', 30)
                ->default('Chua duyet');

            $table->foreign('id_cham_cong')
                ->references('id')
                ->on('ChamCong')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('ma_thong_tin_luong')
                ->references('ma_thong_tin_luong')
                ->on('ThongTinLuong')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->index('ma_thong_tin_luong');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('BangLuong');
    }
};
