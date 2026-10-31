<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'ma_nhan_vien',
    'ho_ten',
    'ngay_sinh',
    'que_quan',
    'email',
    'so_dien_thoai',
    'trang_thai',
    'so_ngay_da_nghi',
    'so_ngay_con_lai',
    'ma_chuc_vu'
])]
class NhanVien extends Model
{
    use HasFactory;

    protected $table = 'nhan_vien';

    protected $primaryKey = 'ma_nhan_vien';

    public $incrementing = false;

    protected $keyType = 'string';

    protected function casts(): array
    {
        return [
            'ngay_sinh' => 'date',
            'so_ngay_da_nghi' => 'integer',
            'so_ngay_con_lai' => 'integer',
        ];
    }

    // Một nhân viên có một tài khoản
    public function taiKhoan(): HasOne
    {
        return $this->hasOne(
            TaiKhoan::class,
            'ma_nhan_vien',
            'ma_nhan_vien'
        );
    }

    // Một nhân viên thuộc một chức vụ
    public function chucVu(): BelongsTo
    {
        return $this->belongsTo(
            ChucVu::class,
            'ma_chuc_vu',
            'ma_chuc_vu'
        );
    }
}