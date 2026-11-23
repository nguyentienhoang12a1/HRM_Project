<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VaiTro extends Model
{
    protected $table = 'VaiTro';
    protected $primaryKey = 'ma_vai_tro';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['ma_vai_tro', 'ten_vai_tro', 'mo_ta', 'trang_thai'];

    public function chucNangs(): BelongsToMany
    {
        return $this->belongsToMany(
            ChucNang::class,
            'VaiTroChucNang',
            'ma_vai_tro',
            'ma_chuc_nang',
            'ma_vai_tro',
            'ma_chuc_nang'
        )->withPivot(['id', 'ma_pham_vi', 'duoc_thuc_hien']);
    }

    public function taiKhoans(): BelongsToMany
    {
        return $this->belongsToMany(
            TaiKhoan::class,
            'TaiKhoanVaiTro',
            'ma_vai_tro',
            'tai_khoan_id'
        );
    }
}