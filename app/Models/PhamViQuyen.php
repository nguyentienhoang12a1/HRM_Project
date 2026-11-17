<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhamViQuyen extends Model
{
    use HasFactory;

    protected $table = 'PhamViQuyen';

    protected $primaryKey = 'ma_pham_vi';

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ten_pham_vi',
        'mo_ta',
    ];

    // Một phạm vi quyền có nhiều cấu hình vai trò - chức năng
    public function vaiTroChucNangs(): HasMany
    {
        return $this->hasMany(
            VaiTroChucNang::class,
            'ma_pham_vi',
            'ma_pham_vi'
        );
    }
}
