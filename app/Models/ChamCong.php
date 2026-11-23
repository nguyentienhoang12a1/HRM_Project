<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChamCong extends Model
{
    protected $table = 'ChamCong';
    public $timestamps = true;

    protected $fillable = [
        'ma_nhan_vien',
        'thoi_gian_vao',
        'thoi_gian_ra',
        'trang_thai',
    ];

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'ma_nhan_vien', 'ma_nhan_vien');
    }

    public function chiTiets()
    {
        return $this->hasMany(ChiTietChamCong::class, 'id_cham_cong', 'id');
    }
}