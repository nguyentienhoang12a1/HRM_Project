<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ChiTietChamCong extends Model
{
    protected $table = 'ChiTietChamCong';
    public $timestamps = false;
    protected $fillable = [
        'id_cham_cong', 'ngay_cham_cong', 'gio_vao', 'gio_ra', 'trang_thai'
    ];
}