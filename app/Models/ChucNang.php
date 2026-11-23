<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'ma_chuc_nang',
    'ten_chuc_nang',
    'mo_ta',
    'trang_thai'
])]
class ChucNang extends Model
{
    use HasFactory;

    protected $table = 'ChucNang';
    protected $primaryKey = 'ma_chuc_nang';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'trang_thai' => 'boolean',
        ];
    }

    // Một chức năng có thể thuộc nhiều vai trò
    public function vaiTros(): BelongsToMany
    {
        return $this->belongsToMany(
            VaiTro::class,
            'VaiTroChucNang',
            'ma_chuc_nang',
            'ma_vai_tro',
            'ma_chuc_nang',
            'ma_vai_tro'
        )->withPivot([
            'id',
            'ma_pham_vi',
            'duoc_thuc_hien',
        ]);
    }
}