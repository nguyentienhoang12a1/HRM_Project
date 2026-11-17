<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'loai_thong_bao',
    'ten_thong_bao',
    'noi_dung',
    'ngay_tao'
])]
class ThongBao extends Model
{
    use HasFactory;

    protected $table = 'ThongBao';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'ngay_tao' => 'datetime',
        ];
    }

    // Một thông báo có nhiều người nhận
    public function nguoiNhanThongBaos(): HasMany
    {
        return $this->hasMany(
            NguoiNhanThongBao::class,
            'id_thong_bao',
            'id'
        );
    }
}