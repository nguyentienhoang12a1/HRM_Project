<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'ma_thong_tin_luong',
    'ma_nhan_vien',
    'luong_co_ban',
    'phu_cap',
    'ngay_hieu_luc',
    'ngay_het_hieu_luc'
])]
class ThongTinLuong extends Model
{
    use HasFactory;

    protected $table = 'ThongTinLuong';
    protected $primaryKey = 'ma_thong_tin_luong';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'luong_co_ban' => 'decimal:2',
            'phu_cap' => 'decimal:2',
            'ngay_hieu_luc' => 'date',
            'ngay_het_hieu_luc' => 'date',
        ];
    }

    // Thông tin lương thuộc về một nhân viên
    public function nhanVien(): BelongsTo
    {
        return $this->belongsTo(
            NhanVien::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }

    // Một thông tin lương có thể được dùng trong nhiều bảng lương
    public function bangLuongs(): HasMany
    {
        return $this->hasMany(
            BangLuong::class,
            'ma_thong_tin_luong',
            'ma_thong_tin_luong'
        );
    }
}