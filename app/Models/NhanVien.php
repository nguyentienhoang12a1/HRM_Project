<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'ma_nhan_vien',
    'ho_ten',
    'ngay_sinh',
    'que_quan',
    'email',
    'so_dien_thoai',
    'trang_thai',
    'so_ngay_da_nghi',
    'so_ngay_con_lai'
])]
class NhanVien extends Model
{
    use HasFactory;

    // Tên bảng trong database
    protected $table = 'nhan_vien';

    // Khóa chính
    protected $primaryKey = 'ma_nhan_vien';

    // Nếu mã nhân viên là chuỗi (VD: NV001)
    public $incrementing = false;

    protected $keyType = 'string';

    // Các thuộc tính cần chuyển đổi kiểu dữ liệu
    protected function casts(): array
    {
        return [
            'ngay_sinh' => 'date',
            'so_ngay_da_nghi' => 'integer',
            'so_ngay_con_lai' => 'integer',
        ];
    }


}
