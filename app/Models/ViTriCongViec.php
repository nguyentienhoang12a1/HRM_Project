<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'id',
    'ten_vi_tri_cong_viec',
    'ma_phong_ban',
    'mo_ta',
    'trang_thai',
])]
class ViTriCongViec extends Model
{
    use HasFactory;

    protected $table = 'ViTriCongViec';

    protected $primaryKey = 'ma_vi_tri_cong_viec';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    /**
     * Một vị trí công việc thuộc về một phòng ban.
     */
    public function phongBan(): BelongsTo
    {
        return $this->belongsTo(
            PhongBan::class,
            'ma_phong_ban',
            'ma_phong_ban'
        );
    }

    /**
     * Một vị trí công việc có nhiều nhân viên.
     */
    public function nhanViens(): HasMany
    {
        return $this->hasMany(
            NhanVien::class,
            'ma_vi_tri_cong_viec',
            'ma_vi_tri_cong_viec'
        );
    }
}
