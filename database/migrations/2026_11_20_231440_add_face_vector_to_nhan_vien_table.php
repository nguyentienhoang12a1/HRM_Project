<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('NhanVien', function (Blueprint $table) {
            if (!Schema::hasColumn('NhanVien', 'face_vector')) {
                $table->longText('face_vector')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('NhanVien', function (Blueprint $table) {
            if (Schema::hasColumn('NhanVien', 'face_vector')) {
                $table->dropColumn('face_vector');
            }
        });
    }
};
