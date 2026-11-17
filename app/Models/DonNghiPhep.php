<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'ma_nhan_vien',
    'ngay_bat_dau',
    'ngay_ket_thuc',
    'so_ngay_nghi',
    'ly_do',
    'trang_thai'
])]
class DonNghiPhep extends Model
{
    use HasFactory;

    protected $table = 'DonNghiPhep';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'ngay_bat_dau' => 'date',
            'ngay_ket_thuc' => 'date',
            'so_ngay_nghi' => 'decimal:2',
        ];
    }

    // Đơn nghỉ phép thuộc về một nhân viên
    public function nhanVien(): BelongsTo
    {
        return $this->belongsTo(
            NhanVien::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }

    // Một đơn nghỉ phép có nhiều chi tiết
    public function chiTietDonNghiPheps(): HasMany
    {
        return $this->hasMany(
            ChiTietDonNghiPhep::class,
            'id_don_nghi_phep',
            'id'
        );
    }
}