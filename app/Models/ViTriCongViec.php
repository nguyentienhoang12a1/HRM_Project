<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViTriCongViec extends Model
{
    protected $table = 'ViTriCongViec';
    protected $primaryKey = 'ma_vi_tri_cong_viec';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ma_vi_tri_cong_viec',
        'ten_vi_tri_cong_viec',
        'ma_phong_ban',
        'mo_ta',
        'trang_thai',
    ];

    public function phongBan()
    {
        return $this->belongsTo(PhongBan::class, 'ma_phong_ban', 'ma_phong_ban');
    }

    public function nhanViens()
    {
        return $this->hasMany(NhanVien::class, 'ma_vi_tri_cong_viec', 'ma_vi_tri_cong_viec');
    }
}