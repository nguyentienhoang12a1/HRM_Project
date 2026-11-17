<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ThongBao', function (Blueprint $table) {
            $table->id();

            $table->string('loai_thong_bao', 100);
            $table->string('ten_thong_bao', 255);
            $table->text('noi_dung');

            $table->dateTime('ngay_tao');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ThongBao');
    }
};
