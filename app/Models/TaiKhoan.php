<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'ten_tai_khoan',
    'mat_khau',
    'ma_nhan_vien'
])]
class TaiKhoan extends Authenticatable
{
    use HasFactory;

    // Tên bảng
    protected $table = 'tai_khoan';

    // Khóa chính
    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    // Chỉ định trường mật khẩu cho Laravel Authentication
    public function getAuthPasswordName(): string
    {
        return 'mat_khau';
    }

    public function getAuthPassword(): string
    {
        return $this->mat_khau;
    }

    // Tự động hash mật khẩu khi lưu bằng Eloquent
    protected function casts(): array
    {
        return [
            'mat_khau' => 'hashed',
        ];
    }

    // Một tài khoản thuộc về một nhân viên
    public function nhanVien(): BelongsTo
    {
        return $this->belongsTo(
            NhanVien::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }
}
