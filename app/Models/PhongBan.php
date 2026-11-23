<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function truongPhong()
    {
        return $this->belongsTo(NhanVien::class, 'ma_truong_phong', 'ma_nhan_vien');
    }

    public function nhanViens()
    {
        return $this->hasMany(NhanVien::class, 'ma_phong_ban', 'ma_phong_ban');
    }

    public function viTriCongViecs()
    {
        return $this->hasMany(ViTriCongViec::class, 'ma_phong_ban', 'ma_phong_ban');
    }
}