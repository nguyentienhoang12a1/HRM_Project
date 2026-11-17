
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('DonNghiPhep', function (Blueprint $table) {
            $table->id();

            $table->string('ma_nhan_vien', 50);

            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');

            $table->decimal('so_ngay_nghi', 5, 2)->default(0);

            $table->text('ly_do')->nullable();
            $table->string('trang_thai', 50)->nullable();

            $table->foreign('ma_nhan_vien')
                ->references('ma_nhan_vien')
                ->on('NhanVien')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->index('ma_nhan_vien');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('DonNghiPhep');
    }
};
