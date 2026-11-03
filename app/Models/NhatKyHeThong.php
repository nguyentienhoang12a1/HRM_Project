<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhatKyHeThong extends Model
{
    use HasFactory;

    // Chỉ định chính xác tên bảng trong database
    protected $table = 'NhatKyHeThong';

    // Các cột được phép mass-assignment
    protected $fillable = [
        'nguoi_thuc_hien_id',
        'hanh_dong',
        'chi_tiet',
        'ip_address',
    ];

    // Khai báo mối quan hệ N - 1 với bảng TaiKhoan
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'nguoi_thuc_hien_id', 'id');
    }
}