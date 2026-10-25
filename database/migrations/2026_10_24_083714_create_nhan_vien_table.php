<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

public function up(): void
{
    Schema::create('nhan_vien', function (Blueprint $table) {
        $table->string('ma_nhan_vien')->primary();
        $table->string('ho_ten');
        $table->date('ngay_sinh')->nullable();
        $table->string('que_quan')->nullable();
        $table->string('email')->unique();
        $table->string('so_dien_thoai', 15)->nullable();

        $table->string('trang_thai')->default('Thử việc');

        $table->unsignedInteger('so_ngay_da_nghi')->default(0);
        $table->unsignedInteger('so_ngay_con_lai')->default(0);

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_vien');
    }
};
