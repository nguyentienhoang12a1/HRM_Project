<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model MaOTP: Quản lý mã xác thực OTP 6 chữ số.
 */
class MaOTP extends Model
{
    use HasFactory;

    protected $table = 'MaOTP';

    protected $fillable = [
        'tai_khoan_id',
        'ma_otp',
        'thoi_gian_tao',
        'thoi_gian_het_han',
        'da_su_dung',
    ];

    protected function casts(): array
    {
        return [
            'thoi_gian_tao'     => 'datetime',
            'thoi_gian_het_han' => 'datetime',
            'da_su_dung'       => 'boolean',
        ];
    }

    public function taiKhoan(): BelongsTo
    {
        return $this->belongsTo(TaiKhoan::class, 'tai_khoan_id');
    }

    /**
     * Kiểm tra mã OTP đã quá thời hạn 5 phút hay chưa (Bước B10).
     */
    public function isExpired(): bool
    {
        return now()->greaterThan($this->thoi_gian_het_han);
    }
}