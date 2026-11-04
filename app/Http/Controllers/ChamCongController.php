<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChamCongController extends Controller
{
    // Hiển thị giao diện Máy Chấm Công
    public function showCheckinForm()
    {
        return view('chamcong.cham_cong');
    }

    // Trả về danh sách Vector khuôn mặt để nạp vào JS trên giao diện
    public function getFaceDatabase()
    {
        return response()->json(
            NhanVien::whereNotNull('face_vector')
                ->select('ma_nhan_vien', 'ho_ten', 'face_vector')
                ->get()
        );
    }

    // Nhận request từ JS và lưu nhật ký chấm công vào DB
    public function storeCheckin(Request $request)
    {
        $request->validate([
            'ma_nhan_vien' => 'required|exists:nhan_vien,ma_nhan_vien'
        ]);

        $nhanVien = NhanVien::where('ma_nhan_vien', $request->ma_nhan_vien)->first();
        $today = Carbon::today();

        // Kiểm tra lượt chấm công trong ngày
        $chamCongHomNay = DB::table('cham_cong')
            ->where('ma_nhan_vien', $nhanVien->ma_nhan_vien)
            ->whereDate('created_at', $today)
            ->first();

        if (!$chamCongHomNay) {
            // Lần 1: Check-in (Vào)
            DB::table('cham_cong')->insert([
                'ma_nhan_vien' => $nhanVien->ma_nhan_vien,
                'thoi_gian_vao' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $type = 'Check-in (Vào)';
        } else {
            // Lần 2 trở đi trong ngày: Check-out (Ra)
            DB::table('cham_cong')
                ->where('id', $chamCongHomNay->id)
                ->update([
                    'thoi_gian_ra' => now(),
                    'updated_at' => now(),
                ]);
            $type = 'Check-out (Ra)';
        }

        return response()->json([
            'success' => true,
            'ho_ten' => $nhanVien->ho_ten,
            'loai' => $type,
            'thoi_gian' => now()->format('H:i:s d/m/Y')
        ]);
    }
}