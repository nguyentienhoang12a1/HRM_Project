<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class TaiKhoan extends Authenticatable
{
    protected $table = 'TaiKhoan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'ten_tai_khoan',
        'mat_khau',
        'ma_nhan_vien',
        'trang_thai',
    ];

    protected $hidden = ['mat_khau'];

    protected function casts(): array
    {
        return [
            'trang_thai' => 'boolean',
        ];
    }

    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'ma_nhan_vien', 'ma_nhan_vien');
    }

    public function vaiTros()
    {
        return $this->belongsToMany(VaiTro::class, 'TaiKhoanVaiTro', 'tai_khoan_id', 'ma_vai_tro');
    }

    public function hasRole(string|array $roles): bool
    {
        $targetRoles = (array) $roles;

        return $this->vaiTros()
            ->where('VaiTro.trang_thai', true)
            ->whereIn('VaiTro.ma_vai_tro', $targetRoles)
            ->exists();
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('VT_Admin');
    }

    // Kiểm tra tài khoản có được thực hiện mã chức năng hay không
    public function hasPermission(string $maChucNang): bool
    {
        $maVaiTros = $this->vaiTros()
            ->where('VaiTro.trang_thai', true)
            ->pluck('VaiTro.ma_vai_tro');

        if ($maVaiTros->isEmpty()) {
            return false;
        }

        return DB::table('VaiTroChucNang')
            ->join('ChucNang', 'VaiTroChucNang.ma_chuc_nang', '=', 'ChucNang.ma_chuc_nang')
            ->whereIn('VaiTroChucNang.ma_vai_tro', $maVaiTros)
            ->where('VaiTroChucNang.ma_chuc_nang', $maChucNang)
            ->where('VaiTroChucNang.duoc_thuc_hien', true)
            ->where('ChucNang.trang_thai', true)
            ->exists();
    }

    // Lấy phạm vi dữ liệu cao nhất ('all' > 'department' > 'self')
    public function getDataScope(string $maChucNang): string
    {
        $maVaiTros = $this->vaiTros()
            ->where('VaiTro.trang_thai', true)
            ->pluck('VaiTro.ma_vai_tro');

        if ($maVaiTros->isEmpty()) {
            return 'self';
        }

        $phamVis = DB::table('VaiTroChucNang')
            ->whereIn('ma_vai_tro', $maVaiTros)
            ->where('ma_chuc_nang', $maChucNang)
            ->where('duoc_thuc_hien', true)
            ->pluck('ma_pham_vi')
            ->toArray();

        if (in_array('PV_HeThong', $phamVis, true) || in_array('PV_CongTy', $phamVis, true)) {
            return 'all';
        }

        if (in_array('PV_PhongBan', $phamVis, true)) {
            return 'department';
        }

        return 'self';
    }
}