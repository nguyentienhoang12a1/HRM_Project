<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhongBan extends Model
{
    protected $table = 'PhongBan';
    protected $primaryKey = 'ma_phong_ban';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; 

    protected $fillable = [
        'ma_phong_ban',
        'ten_phong_ban',
        'ma_truong_phong',
        'mo_ta',
        'trang_thai',
    ];

    
    // Một phòng ban có nhiều phòng ban chức vụ
    public function phongBanChucVus(): HasMany
    {
        return $this->hasMany(
            PhongBanChucVu::class,
            'ma_phong_ban',
            'ma_phong_ban'
        );
    }

    
    // Một phòng ban có nhiều nhân viên
    public function phongBanNhanVien(): HasMany
    {
        return $this->hasMany(
            NhanVien::class,
            'ma_phong_ban',
            'ma_phong_ban'
        );
    }

    // Một phòng ban có một trưởng phòng
    public function truongPhong(): BelongsTo
    {
        return $this->belongsTo(
            NhanVien::class,
            'ma_truong_phong',
            'ma_nhan_vien'
        );
    }
    
    /**
     * Một phòng ban có nhiều vị trí công việc.
     */
    public function viTriCongViecs(): HasMany
    {
        return $this->hasMany(
            ViTriCongViec::class,
            'ma_phong_ban',
            'ma_phong_ban'
        );
    }
}