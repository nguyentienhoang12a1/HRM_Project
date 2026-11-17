
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('KhoanLuong', function (Blueprint $table) {
            $table->string('ma_khoan', 20)->primary();

            $table->string('ten_khoan', 100);
            $table->string('loai_khoan', 30);
            $table->string('cach_tinh', 50);

            $table->string('trang_thai', 30)
                ->default('Su dung');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('KhoanLuong');
    }
};
