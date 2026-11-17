<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ChucVu', function (Blueprint $table) {
            $table->string('ma_chuc_vu', 50)->primary();
            $table->string('ten_chuc_vu', 255);


            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ChucVu');
    }
};
