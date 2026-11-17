
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ChiTietChamCong', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('id_cham_cong');

            $table->date('ngay_cham_cong');
            $table->dateTime('gio_vao')->nullable();
            $table->dateTime('gio_ra')->nullable();

            $table->string('trang_thai', 30);

            $table->foreign('id_cham_cong')
                ->references('id')
                ->on('ChamCong')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(
                ['id_cham_cong', 'ngay_cham_cong'],
                'uq_chi_tiet_cham_cong_ngay'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ChiTietChamCong');
    }
};
