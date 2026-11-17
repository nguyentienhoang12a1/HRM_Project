<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'id_cham_cong',
    'ngay_cham_cong',
    'gio_vao',
    'gio_ra',
    'trang_thai'
])]
class ChiTietChamCong extends Model
{
    use HasFactory;

    protected $table = 'ChiTietChamCong';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'ngay_cham_cong' => 'date',
            'gio_vao' => 'datetime',
            'gio_ra' => 'datetime',
        ];
    }

    // Một chi tiết chấm công thuộc về một bảng chấm công
    public function chamCong(): BelongsTo
    {
        return $this->belongsTo(
            ChamCong::class,
            'id_cham_cong',
            'id'
        );
    }
}