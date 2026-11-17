<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'ma_phong_ban',
    'ma_chuc_vu',
    'mo_ta'
])]
class PhongBanChucVu extends Model
{
    use HasFactory;

    protected $table = 'PhongBanChucVu';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;


    // Bản ghi phân quyền thuộc về một phòng ban
    public function phongBan(): BelongsTo
    {
        return $this->belongsTo(
            PhongBan::class,
            'ma_phong_ban',
            'ma_phong_ban'
        );
    }
    
    // Bản ghi phân quyền thuộc về một chuc vu
    public function chucVu(): BelongsTo
    {
        return $this->belongsTo(
            ChucVu::class,
            'ma_chuc_vu',
            'ma_chuc_vu'
        );
    }

}