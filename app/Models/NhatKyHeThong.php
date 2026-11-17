<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NhatKyHeThong extends Model
{
    use HasFactory;

    protected $table = 'NhatKyHeThong';

    protected $primaryKey = 'id';

    public $incrementing = true;
    protected $keyType = 'int';

    // Database có created_at và updated_at
    public $timestamps = true;

    protected $fillable = [
        'nguoi_thuc_hien_id',
        'hanh_dong',
        'chi_tiet',
        'ip_address',
    ];

    protected function casts(): array
    {
        return [
            'nguoi_thuc_hien_id' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // Nhật ký thuộc về một tài khoản thực hiện
    public function taiKhoan(): BelongsTo
    {
        return $this->belongsTo(
            TaiKhoan::class,
            'nguoi_thuc_hien_id',
            'id'
        );
    }
}
