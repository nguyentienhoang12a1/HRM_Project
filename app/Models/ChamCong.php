<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'ma_nhan_vien',
    'thang',
    'nam',
    'tong_cong',
    'so_ngay_nghi_huong_luong',
    'so_ngay_nghi_khong_huong'
])]
class ChamCong extends Model
{
    use HasFactory;

    protected $table = 'ChamCong';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'thang' => 'integer',
            'nam' => 'integer',
            'tong_cong' => 'decimal:2',
            'so_ngay_nghi_huong_luong' => 'decimal:2',
            'so_ngay_nghi_khong_huong' => 'decimal:2',
        ];
    }

    // Một bảng chấm công thuộc về một nhân viên
    public function nhanVien(): BelongsTo
    {
        return $this->belongsTo(
            NhanVien::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }

    // Một bảng chấm công có nhiều chi tiết chấm công
    public function chiTietChamCongs(): HasMany
    {
        return $this->hasMany(
            ChiTietChamCong::class,
            'id_cham_cong',
            'id'
        );
    }

    // Một bảng chấm công có một bảng lương
    public function bangLuong(): HasOne
    {
        return $this->hasOne(
            BangLuong::class,
            'id_cham_cong',
            'id'
        );
    }
}