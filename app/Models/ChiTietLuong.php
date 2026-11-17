<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'ma_chi_tiet',
    'ma_bang_luong',
    'ma_khoan',
    'so_luong',
    'don_gia',
    'so_tien',
    'ghi_chu'
])]
class ChiTietLuong extends Model
{
    use HasFactory;

    protected $table = 'ChiTietLuong';
    protected $primaryKey = 'ma_chi_tiet';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'so_luong' => 'decimal:2',
            'don_gia' => 'decimal:2',
            'so_tien' => 'decimal:2',
        ];
    }

    // Chi tiết lương thuộc về một bảng lương
    public function bangLuong(): BelongsTo
    {
        return $this->belongsTo(
            BangLuong::class,
            'ma_bang_luong',
            'ma_bang_luong'
        );
    }

    // Chi tiết lương thuộc về một khoản lương
    public function khoanLuong(): BelongsTo
    {
        return $this->belongsTo(
            KhoanLuong::class,
            'ma_khoan',
            'ma_khoan'
        );
    }
}