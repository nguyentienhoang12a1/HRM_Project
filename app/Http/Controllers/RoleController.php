<?php

namespace App\Http\Controllers;

use App\Models\ChucVu;
use App\Models\PhongBan;
use App\Models\TaiKhoan;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Hiển thị danh sách tài khoản để phân quyền và quản lý trạng thái.
     */
    public function index()
    {
        $taiKhoans = TaiKhoan::with([
            'nhanVien.phongBan',
            'nhanVien.chucVu',
            'vaiTros',
        ])->orderBy('id')->get();

        $vaiTros = VaiTro::where('trang_thai', true)->orderBy('ma_vai_tro')->get();
        $chucVus = ChucVu::orderBy('ten_chuc_vu')->get();
        $phongBans = PhongBan::orderBy('ten_phong_ban')->get();

        return view('admin.roles.index', compact(
            'taiKhoans',
            'vaiTros',
            'chucVus',
            'phongBans'
        ));
    }

    /**
     * Cập nhật vai trò, chức vụ và trạng thái hoạt động cho một tài khoản.
     */
    public function updateUserRole(Request $request, int $id)
    {
        $taiKhoan = TaiKhoan::with('nhanVien')->findOrFail($id);

        $validated = $request->validate([
            'ma_vai_tro'           => ['required', 'string', Rule::exists('VaiTro', 'ma_vai_tro')],
            'ma_chuc_vu'           => ['nullable', 'string', Rule::exists('ChucVu', 'ma_chuc_vu')],
            'trang_thai_nhan_vien' => ['required', Rule::in(['Đang làm việc', 'Tạm khóa', 'Đã nghỉ việc'])],
        ], [
            'ma_vai_tro.required'     => 'Vui lòng chọn vai trò cho tài khoản.',
            'ma_vai_tro.exists'       => 'Vai trò được chọn không hợp lệ.',
            'trang_thai_nhan_vien.in' => 'Trạng thái làm việc không hợp lệ.',
        ]);

        DB::transaction(function () use ($taiKhoan, $validated) {
            // 1. Cập nhật vai trò trong bảng trung gian TaiKhoanVaiTro
            $taiKhoan->vaiTros()->sync([$validated['ma_vai_tro']]);

            // 2. Đồng bộ trạng thái đăng nhập (boolean) trên bảng TaiKhoan
            $taiKhoan->trang_thai = ($validated['trang_thai_nhan_vien'] === 'Đang làm việc');
            $taiKhoan->save();

            // 3. Cập nhật chức vụ và trạng thái làm việc trên bảng NhanVien (nếu đã liên kết)
            if ($taiKhoan->nhanVien) {
                $nvUpdate = [
                    'trang_thai_nhan_vien' => $validated['trang_thai_nhan_vien'],
                ];

                if (!empty($validated['ma_chuc_vu'])) {
                    $nvUpdate['ma_chuc_vu'] = $validated['ma_chuc_vu'];
                }

                $taiKhoan->nhanVien->update($nvUpdate);
            }
        });

        return back()->with('success', "Đã cập nhật phân quyền cho tài khoản {$taiKhoan->ten_tai_khoan} (ID: {$taiKhoan->id}).");
    }
}