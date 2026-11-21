<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ChiTietChamCong', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cham_cong')
                ->constrained('ChamCong')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->date('ngay_cham_cong')->nullable();
            $table->dateTime('gio_vao')->nullable();
            $table->dateTime('gio_ra')->nullable();
            $table->string('trang_thai', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ChiTietChamCong');
    }
};
