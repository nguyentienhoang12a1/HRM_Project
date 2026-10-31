<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'ma_chuc_vu',
    'ten_chuc_vu'
])]
class ChucVu extends Model
{
    use HasFactory;

    protected $table = 'chuc_vu';

    protected $primaryKey = 'ma_chuc_vu';

    public $incrementing = false;

    protected $keyType = 'string';

    // Một chức vụ có nhiều nhân viên
    public function nhanViens(): HasMany
    {
        return $this->hasMany(
            NhanVien::class,
            'ma_chuc_vu',
            'ma_chuc_vu'
        );
    }
}