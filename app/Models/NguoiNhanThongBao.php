<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'id_thong_bao',
    'ma_nhan_vien',
    'da_doc',
    'ngay_doc'
])]
class NguoiNhanThongBao extends Model
{
    use HasFactory;

    protected $table = 'NguoiNhanThongBao';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'da_doc' => 'boolean',
            'ngay_doc' => 'datetime',
        ];
    }

    // Người nhận thuộc về một thông báo
    public function thongBao(): BelongsTo
    {
        return $this->belongsTo(
            ThongBao::class,
            'id_thong_bao',
            'id'
        );
    }

    // Người nhận là một nhân viên
    public function nhanVien(): BelongsTo
    {
        return $this->belongsTo(
            NhanVien::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }
}