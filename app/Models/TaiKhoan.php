<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'TaiKhoan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; 
    protected $authPasswordName = 'mat_khau';

    protected $fillable = [
        'ten_tai_khoan',
        'mat_khau',
        'ma_nhan_vien',
        'trang_thai',
    ];

    protected $hidden = [
        'mat_khau',
    ];

    public function getAuthPasswordName(): string
    {
        return 'mat_khau';
    }

    public function getAuthPassword(): string
    {
        return $this->mat_khau;
    }
    protected function casts(): array
    {
        return [
            'mat_khau' => 'hashed',
            'trang_thai' => 'boolean',
        ];
    }

    /**
     * Liên kết tới bảng NhanVien qua cột ma_nhan_vien.
     */
    public function nhanVien(): BelongsTo
    {
        return $this->belongsTo(NhanVien::class, 'ma_nhan_vien', 'ma_nhan_vien');
    }

    // Một tài khoản có nhiều nhật ký hệ thống
    public function nhatKyHeThongs(): HasMany
    {
        return $this->hasMany(
            NhatKyHeThong::class,
            'nguoi_thuc_hien_id',
            'id'
        );
    }
    // Một tài khoản có nhiều vai trò
    public function vaiTros (): BelongsToMany
    {
        return $this->belongsToMany(
            VaiTro::class,
            'TaiKhoanVaiTro',
            'tai_khoan_id',
            'ma_vai_tro',
            'id',
            'ma_vai_tro'
        )->withPivot('id');
    }

    public function maOtps(): HasMany
    {
        return $this->hasMany(MaOTP::class, 'tai_khoan_id', 'id');
    }

    /**
     * Tương thích ngược nếu View/Controller gọi $taiKhoan->ten_dang_nhap hoặc $taiKhoan->ma_nhan_vien.
     */
    public function getTenDangNhapAttribute(): string
    {
        return $this->ten_tai_khoan;
    }


    public function isAdmin(): bool
    {
        return $this->getRoleKey() === 'admin';
    }
}