<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'ma_thanh_toan',
    'ma_bang_luong',
    'ngay_thanh_toan',
    'so_tien_thanh_toan',
    'phuong_thuc',
    'ma_giao_dich',
    'trang_thai'
])]
class ThanhToanLuong extends Model
{
    use HasFactory;

    protected $table = 'ThanhToanLuong';
    protected $primaryKey = 'ma_thanh_toan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'ngay_thanh_toan' => 'datetime',
            'so_tien_thanh_toan' => 'decimal:2',
        ];
    }

    // Một lần thanh toán thuộc về một bảng lương
    public function bangLuong(): BelongsTo
    {
        return $this->belongsTo(
            BangLuong::class,
            'ma_bang_luong',
            'ma_bang_luong'
        );
    }
}