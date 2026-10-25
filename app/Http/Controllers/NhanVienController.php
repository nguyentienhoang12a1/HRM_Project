<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Illuminate\Http\Request;

class NhanVienController extends Controller
{
    // Hiển thị danh sách nhân viên
    public function index()
    {
        $nhanViens = NhanVien::orderBy('ma_nhan_vien')->paginate(10);

        return view('nhanvien.index', compact('nhanViens'));
    }

    // Hiển thị form thêm nhân viên
    public function create()
    {
        return view('nhanvien.create');
    }

    // Lưu nhân viên mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ma_nhan_vien' => 'required|string|max:20|unique:nhan_vien,ma_nhan_vien',
            'ho_ten' => 'required|string|max:255',
            'ngay_sinh' => 'nullable|date',
            'que_quan' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:nhan_vien,email',
            'so_dien_thoai' => 'nullable|string|max:15',
            'trang_thai' => 'required|in:Đang làm,Nghỉ,Thử việc',
            'so_ngay_da_nghi' => 'required|integer|min:0',
            'so_ngay_con_lai' => 'required|integer|min:0'
        ]);

        NhanVien::create($validated);

        return redirect()
            ->route('nhanvien.index')
            ->with('success', 'Thêm nhân viên thành công!');
    }

    // Hiển thị form sửa nhân viên
    public function edit(string $id)
    {
        $nhanVien = NhanVien::findOrFail($id);

        return view('nhanvien.edit', compact('nhanVien'));
    }

    // Cập nhật thông tin nhân viên
    public function update(Request $request, string $id)
    {
        $nhanVien = NhanVien::findOrFail($id);

        $validated = $request->validate([
            'ho_ten' => 'required|string|max:255',
            'ngay_sinh' => 'nullable|date',
            'que_quan' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:nhan_vien,email,' . $nhanVien->ma_nhan_vien . ',ma_nhan_vien',
            'so_dien_thoai' => 'nullable|string|max:15',
            'trang_thai' => 'required|in:Đang làm,Nghỉ,Thử việc',
            'so_ngay_da_nghi' => 'required|integer|min:0',
            'so_ngay_con_lai' => 'required|integer|min:0'
        ]);

        $nhanVien->update($validated);

        return redirect()
            ->route('nhanvien.index')
            ->with('success', 'Cập nhật nhân viên thành công!');
    }

    // Xóa nhân viên
    public function destroy(string $id)
    {
        $nhanVien = NhanVien::findOrFail($id);
        $nhanVien->delete();

        return redirect()
            ->route('nhanvien.index')
            ->with('success', 'Xóa nhân viên thành công!');
    }
}
