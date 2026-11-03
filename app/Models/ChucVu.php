<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChucVu extends Model
{
    protected $table = 'ChucVu';
    protected $primaryKey = 'ma_chuc_vu';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; 

    protected $fillable = [
        'ma_chuc_vu',
        'ten_chuc_vu',
        'ma_phong',
    ];

    public function phongBan(): BelongsTo
    {
        return $this->belongsTo(PhongBan::class, 'ma_phong', 'ma_phong');
    }

    public function nhanViens(): HasMany
    {
        return $this->hasMany(NhanVien::class, 'ma_chuc_vu', 'ma_chuc_vu');
    }
}