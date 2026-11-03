<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'TaiKhoan';
    protected $primaryKey = 'id';
    public $timestamps = false; 
    protected $authPasswordName = 'mat_khau';

    protected $fillable = [
        'ten_tai_khoan',
        'mat_khau',
        'ma_nhan_vien',
        'ma_quyen',
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

    /**
     * Liên kết tới bảng NhanVien qua cột ma_nhan_vien.
     */
    public function nhanVien(): BelongsTo
    {
        return $this->belongsTo(NhanVien::class, 'ma_nhan_vien', 'ma_nhan_vien');
    }

    /**
     * Liên kết tới bảng PhanQuyen qua cột ma_quyen.
     */
    public function phanQuyen(): BelongsTo
    {
        return $this->belongsTo(PhanQuyen::class, 'ma_quyen', 'ma_quyen');
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


    /**
     * Chuẩn hóa tên quyền từ bảng PhanQuyen về mã vai trò chuẩn.
     */
    public function getRoleKey(): string
    {
        $tenQuyen = mb_strtolower(trim(optional($this->phanQuyen)->ten_quyen ?? ''));

        return match (true) {
            str_contains($tenQuyen, 'admin') || str_contains($tenQuyen, 'quản trị') || $this->ma_quyen == 1 => 'admin',
            str_contains($tenQuyen, 'giám đốc') || str_contains($tenQuyen, 'giam doc') || $this->ma_quyen == 2 => 'giamdoc',
            str_contains($tenQuyen, 'hr') || str_contains($tenQuyen, 'nhân sự') || $this->ma_quyen == 3 => 'hr',
            str_contains($tenQuyen, 'trưởng phòng') || str_contains($tenQuyen, 'truong phong') || $this->ma_quyen == 4 => 'truongphong',
            default => 'nhanvien',
        };
    }

    /**
     * Xác định phạm vi dữ liệu dựa trên vai trò.
     */
    public function getDataScope(): string
    {
        return match ($this->getRoleKey()) {
            'admin', 'giamdoc', 'hr' => 'all',
            'truongphong'            => 'department',
            default                  => 'personal',
        };
    }

    public function isAdmin(): bool
    {
        return $this->getRoleKey() === 'admin';
    }
}