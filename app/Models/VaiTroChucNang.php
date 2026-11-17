<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'ma_vai_tro',
    'ma_chuc_nang',
    'ma_pham_vi',
    'duoc_thuc_hien'
])]
class VaiTroChucNang extends Model
{
    use HasFactory;

    protected $table = 'VaiTroChucNang';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'duoc_thuc_hien' => 'boolean'
        ];
    }

    public function vaiTro(): BelongsTo
    {
        return $this->belongsTo(
            VaiTro::class,
            'ma_vai_tro',
            'ma_vai_tro'
        );
    }

    public function chucNang(): BelongsTo
    {
        return $this->belongsTo(
            ChucNang::class,
            'ma_chuc_nang',
            'ma_chuc_nang'
        );
    }

    public function phamViQuyen(): BelongsTo
    {
        return $this->belongsTo(
            PhamViQuyen::class,
            'ma_pham_vi',
            'ma_pham_vi'
        );
    }
}