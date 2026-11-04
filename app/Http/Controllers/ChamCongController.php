<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChamCongController extends Controller
{
    /**
     * 1. Hiển thị giao diện Máy Chấm Công (Khớp với Route: index)
     */
    public function index()
    {
        return view('chamcong.cham_cong');
    }

    /**
     * 2. Trả về danh sách Vector khuôn mặt để nạp vào JS
     */
    public function getFaceDatabase()
    {
        return response()->json(
            NhanVien::whereNotNull('face_vector')
                ->select('ma_nhan_vien', 'ho_va_ten as ho_ten', 'face_vector')
                ->get()
                ->map(function ($emp) {
                    return [
                        'ma_nhan_vien' => $emp->ma_nhan_vien,
                        'ho_ten'       => $emp->ho_ten,
                        'face_vector'  => json_decode($emp->face_vector)
                    ];
                })
        );
    }

    /**
     * 3. Nhận request từ JS và lưu nhật ký chấm công vào DB
     */
    public function storeCheckin(Request $request)
{
    $request->validate([
        'ma_nhan_vien' => 'required'
    ]);

    $nhanVien = DB::table('NhanVien')->where('ma_nhan_vien', $request->ma_nhan_vien)->first();
    $today = Carbon::today('Asia/Ho_Chi_Minh');
    $now = Carbon::now('Asia/Ho_Chi_Minh');
    $loaiButton = $request->input('loai_cham_cong'); // 'in' hoặc 'out'

    $chamCongHomNay = DB::table('chamcong')
        ->where('ma_nhan_vien', $nhanVien->ma_nhan_vien)
        ->whereDate('created_at', $today)
        ->first();

    if ($loaiButton === 'in' || (!$chamCongHomNay && !$loaiButton)) {
        // Lưu Check-in
        if ($chamCongHomNay) {
            return response()->json(['success' => false, 'message' => 'Bạn đã Check-in trong ngày hôm nay rồi!']);
        }
        DB::table('chamcong')->insert([
            'ma_nhan_vien'  => $nhanVien->ma_nhan_vien,
            'thoi_gian_vao' => $now,
            'trang_thai'    => 'Thành công',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);
        $type = 'Check-in (Vào)';
    } else {
        // Lưu Check-out
        if (!$chamCongHomNay) {
            return response()->json(['success' => false, 'message' => 'Bạn chưa Check-in vào nên không thể Check-out!']);
        }
        DB::table('chamcong')
            ->where('id', $chamCongHomNay->id)
            ->update([
                'thoi_gian_ra' => $now,
                'updated_at'   => $now,
            ]);
        $type = 'Check-out (Ra)';
    }

    return response()->json([
        'success'   => true,
        'ho_ten'    => $nhanVien->ho_va_ten ?? $nhanVien->ho_ten,
        'loai'      => $type,
        'thoi_gian' => $now->format('H:i:s d/m/Y')
    ]);
}
    /**
     * 6. Trang danh sách lịch sử chấm công
     */
    public function lichSuChamCong()
    {
        $lichSu = DB::table('chamcong')
            ->join('NhanVien', 'cham_cong.ma_nhan_vien', '=', 'NhanVien.ma_nhan_vien')
            ->select('cham_cong.*', 'NhanVien.ho_va_ten as ho_ten')
            ->orderBy('cham_cong.created_at', 'desc')
            ->paginate(15);

        return view('chamcong.lich_su', compact('lichSu'));
    }
}