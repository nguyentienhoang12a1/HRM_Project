<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'ten_vai_tro',
    'mo_ta',
    'trang_thai'
])]
class VaiTro extends Model
{
    use HasFactory;

    protected $table = 'VaiTro';
    protected $primaryKey = 'ma_vai_tro';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'trang_thai' => 'boolean',
        ];
    }

    // Một vai trò có nhiều tài khoản
    public function taiKhoans(): BelongsToMany
    {
        return $this->belongsToMany(
            TaiKhoan::class,
            'TaiKhoanVaiTro',
            'ma_vai_tro',
            'tai_khoan_id',
            'ma_vai_tro',
            'id'
        )->withPivot('id');
    }

    // Một vai trò có nhiều chức năng và phạm vi quyền
    public function chucNangs(): BelongsToMany
    {
        return $this->belongsToMany(
            ChucNang::class,
            'VaiTroChucNang',
            'ma_vai_tro',
            'ma_chuc_nang',
            'ma_vai_tro',
            'ma_chuc_nang'
        )->withPivot([
            'id',
            'ma_pham_vi',
            'duoc_xem',
            'duoc_them',
            'duoc_sua',
            'duoc_xoa',
            'duoc_duyet'
        ]);
    }
}