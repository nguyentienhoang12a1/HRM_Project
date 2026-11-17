<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'ma_hop_dong',
    'loai_hop_dong',
    'ngay_ky',
    'ngay_bat_dau',
    'ngay_ket_thuc',
    'muc_luong',
    'ma_nhan_vien'
])]
class HopDong extends Model
{
    use HasFactory;

    protected $table = 'HopDong';
    protected $primaryKey = 'ma_hop_dong';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'ngay_ky' => 'date',
            'ngay_bat_dau' => 'date',
            'ngay_ket_thuc' => 'date',
            'muc_luong' => 'decimal:2',
        ];
    }

    // Một hợp đồng thuộc về một nhân viên
    public function nhanVien(): BelongsTo
    {
        return $this->belongsTo(
            NhanVien::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }
}