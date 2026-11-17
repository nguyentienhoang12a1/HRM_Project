<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'tai_khoan_id',
    'ma_vai_tro'
])]
class TaiKhoanVaiTro extends Model
{
    use HasFactory;

    protected $table = 'TaiKhoanVaiTro';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    // Bản ghi phân quyền thuộc về một tài khoản
    public function taiKhoan(): BelongsTo
    {
        return $this->belongsTo(
            TaiKhoan::class,
            'tai_khoan_id',
            'id'
        );
    }

    // Bản ghi phân quyền thuộc về một vai trò
    public function vaiTro(): BelongsTo
    {
        return $this->belongsTo(
            VaiTro::class,
            'ma_vai_tro',
            'ma_vai_tro'
        );
    }
}