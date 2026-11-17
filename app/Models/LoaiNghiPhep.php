<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'ma_loai_nghi',
    'ten_loai_nghi',
    'huong_luong'
])]
class LoaiNghiPhep extends Model
{
    use HasFactory;

    protected $table = 'LoaiNghiPhep';
    protected $primaryKey = 'ma_loai_nghi';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'huong_luong' => 'boolean',
        ];
    }

    // Một loại nghỉ phép có nhiều chi tiết đơn nghỉ phép
    public function chiTietDonNghiPheps(): HasMany
    {
        return $this->hasMany(
            ChiTietDonNghiPhep::class,
            'ma_loai_nghi',
            'ma_loai_nghi'
        );
    }
}