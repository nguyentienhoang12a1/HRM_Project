<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{
    protected $table = 'ChucVu';
    protected $primaryKey = 'ma_chuc_vu';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['ma_chuc_vu', 'ten_chuc_vu'];

    public function nhanViens()
    {
        return $this->hasMany(NhanVien::class, 'ma_chuc_vu', 'ma_chuc_vu');
    }
}