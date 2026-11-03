<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhongBan extends Model
{
    protected $table = 'PhongBan';
    protected $primaryKey = 'ma_phong';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; 

    protected $fillable = [
        'ma_phong',
        'ten_phong',
        'ma_truong_phong',
        'mo_ta',
        'trang_thai',
    ];

    public function chucVus(): HasMany
    {
        return $this->hasMany(ChucVu::class, 'ma_phong', 'ma_phong');
    }

    public function truongPhong(): BelongsTo
    {
        return $this->belongsTo(NhanVien::class, 'ma_truong_phong', 'ma_nhan_vien');
    }
}