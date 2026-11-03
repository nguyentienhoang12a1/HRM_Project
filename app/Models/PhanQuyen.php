<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhanQuyen extends Model
{
    protected $table = 'PhanQuyen';
    protected $primaryKey = 'ma_quyen';
    public $timestamps = false;

    protected $fillable = [
        'ten_quyen',
        'mo_ta',
    ];

    public function taiKhoans(): HasMany
    {
        return $this->hasMany(TaiKhoan::class, 'ma_quyen', 'ma_quyen');
    }
}