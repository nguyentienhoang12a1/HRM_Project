<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NhanVien extends Model
{
    use HasFactory;

    protected $table = 'NhanVien';
    protected $primaryKey = 'ma_nhan_vien';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; 

    protected $fillable = [
        'ma_nhan_vien',
        'ho_va_ten',
        'ngay_sinh',
        'que_quan',
        'email',
        'so_dien_thoai',
        'ma_chuc_vu',
        'trang_thai',
        'face_vector',
    ];

    public function chucVu(): BelongsTo
    {
        return $this->belongsTo(ChucVu::class, 'ma_chuc_vu', 'ma_chuc_vu');
    }

    public function taiKhoan(): HasOne
    {
        return $this->hasOne(TaiKhoan::class, 'ma_nhan_vien', 'ma_nhan_vien');
    }
}