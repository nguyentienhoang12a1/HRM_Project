<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'ma_khoan',
    'ten_khoan',
    'loai_khoan',
    'cach_tinh',
    'trang_thai'
])]
class KhoanLuong extends Model
{
    use HasFactory;

    protected $table = 'KhoanLuong';
    protected $primaryKey = 'ma_khoan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    // Một khoản lương có nhiều chi tiết lương
    public function chiTietLuongs(): HasMany
    {
        return $this->hasMany(
            ChiTietLuong::class,
            'ma_khoan',
            'ma_khoan'
        );
    }
}