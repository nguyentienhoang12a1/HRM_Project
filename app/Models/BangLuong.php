<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'ma_bang_luong',
    'id_cham_cong',
    'ma_thong_tin_luong',
    'tong_thu_nhap',
    'tong_khau_tru',
    'luong_thuc_nhan',
    'trang_thai'
])]
class BangLuong extends Model
{
    use HasFactory;

    protected $table = 'BangLuong';

    protected $primaryKey = 'ma_bang_luong';

    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'tong_thu_nhap' => 'decimal:2',
            'tong_khau_tru' => 'decimal:2',
            'luong_thuc_nhan' => 'decimal:2',
        ];
    }

    // Bảng lương thuộc về một bảng chấm công
    public function chamCong(): BelongsTo
    {
        return $this->belongsTo(
            ChamCong::class,
            'id_cham_cong',
            'id'
        );
    }

    // Bảng lương sử dụng một thông tin lương
    public function thongTinLuong(): BelongsTo
    {
        return $this->belongsTo(
            ThongTinLuong::class,
            'ma_thong_tin_luong',
            'ma_thong_tin_luong'
        );
    }

    // Một bảng lương có nhiều chi tiết lương
    public function chiTietLuongs(): HasMany
    {
        return $this->hasMany(
            ChiTietLuong::class,
            'ma_bang_luong',
            'ma_bang_luong'
        );
    }

    // Một bảng lương có nhiều lần thanh toán
    public function thanhToanLuongs(): HasMany
    {
        return $this->hasMany(
            ThanhToanLuong::class,
            'ma_bang_luong',
            'ma_bang_luong'
        );
    }
}
