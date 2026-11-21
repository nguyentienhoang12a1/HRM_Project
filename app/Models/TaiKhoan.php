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
    public function vaiTros(): BelongsToMany
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

    /**
     * Tương thích ngược nếu code/view gọi quan hệ phanQuyen theo mô hình VaiTro mới.
     * Nếu dự án vẫn giữ model PhanQuyen và cột ma_quyen, hãy đổi sang belongsTo(PhanQuyen::class, 'ma_quyen', 'ma_quyen').
     */
    public function phanQuyen(): BelongsToMany
    {
        return $this->vaiTros();
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
    public function getRoleKey(): string
    {
        $roles = $this->relationLoaded('vaiTros')
            ? $this->vaiTros
            : $this->vaiTros()->get();

        if ($roles->isEmpty()) {
            return 'employee';
        }

        $keys = $roles->map(function ($role) {
            return strtolower((string) ($role->ma_vai_tro ?? $role->ten_vai_tro ?? ''));
        });

        if ($keys->contains(fn($k) => str_contains($k, 'admin') || str_contains($k, 'quantri'))) {
            return 'admin';
        }

        if ($keys->contains(fn($k) => str_contains($k, 'hr') || str_contains($k, 'nhansu') || str_contains($k, 'manager') || str_contains($k, 'truong'))) {
            return 'manager';
        }

        return (string) ($keys->first() ?: 'employee');
    }

    public function getDataScope(): string
    {
        $roleKey = $this->getRoleKey();

        return match ($roleKey) {
            'admin', 'hr' => 'all',
            'manager' => 'department',
            default => 'self',
        };
    }
}
