
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ChamCong', function (Blueprint $table) {
            $table->increments('id');

            $table->string('ma_nhan_vien', 20)->nullable();

            $table->integer('thang');
            $table->integer('nam');

            $table->decimal('tong_cong', 5, 2)->default(0);
            $table->decimal('so_ngay_nghi_huong_luong', 5, 2)->default(0);
            $table->decimal('so_ngay_nghi_khong_huong', 5, 2)->default(0);

            $table->foreign('ma_nhan_vien')
                ->references('ma_nhan_vien')
                ->on('NhanVien')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->unique(
                ['ma_nhan_vien', 'thang', 'nam'],
                'uq_cham_cong_nhan_vien_thang_nam'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ChamCong');
    }
};
