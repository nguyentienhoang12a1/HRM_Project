<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('PhamViQuyen', function (Blueprint $table) {
            $table->string('ma_pham_vi',20)->primary();
            $table->string('ten_pham_vi', 50);
            $table->text('mo_ta')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('PhamViQuyen');
    }
};
