<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'id_don_nghi_phep',
    'ma_loai_nghi',
    'so_ngay'
])]
class ChiTietDonNghiPhep extends Model
{
    use HasFactory;

    protected $table = 'ChiTietDonNghiPhep';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'so_ngay' => 'decimal:2',
        ];
    }

    // Chi tiết thuộc về một đơn nghỉ phép
    public function DonNghiPhep(): BelongsTo
    {
        return $this->belongsTo(
            DonNghiPhep::class,
            'id_don_nghi_phep',
            'id'
        );
    }

    // Chi tiết thuộc về một loại nghỉ phép
    public function loaiNghiPhep(): BelongsTo
    {
        return $this->belongsTo(
            LoaiNghiPhep::class,
            'ma_loai_nghi',
            'ma_loai_nghi'
        );
    }
}