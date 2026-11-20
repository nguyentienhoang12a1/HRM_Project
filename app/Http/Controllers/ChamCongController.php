<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChamCongController extends Controller
{
    /**
     * 1. Hiển thị giao diện Máy Chấm Công
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
     * 3. Nhận request từ JS và lưu nhật ký chấm công (Hỗ trợ cả Ca chính & Tăng ca)
     */
    public function storeCheckin(Request $request)
    {
        $request->validate([
            'ma_nhan_vien' => 'required'
        ]);

        // Dùng tên bảng chữ thường 'nhanvien' khớp với MySQL
        $nhanVien = DB::table('nhanvien')->where('ma_nhan_vien', $request->ma_nhan_vien)->first();

        if (!$nhanVien) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy thông tin nhân viên!'], 404);
        }

        $today = Carbon::today('Asia/Ho_Chi_Minh');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $loaiButton = $request->input('loai_cham_cong'); // 'in' hoặc 'out'

        // Lấy lượt chấm công MỚI NHẤT trong ngày hôm nay
        $luotCuoiHomNay = DB::table('chamcong')
            ->where('ma_nhan_vien', $nhanVien->ma_nhan_vien)
            ->whereDate('created_at', $today)
            ->orderBy('id', 'desc')
            ->first();

        // TRƯỜNG HỢP 1: BẤM CHECK-IN (VÀO)
        if ($loaiButton === 'in' || (!$luotCuoiHomNay && !$loaiButton)) {
            if ($luotCuoiHomNay && is_null($luotCuoiHomNay->thoi_gian_ra)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn đã Check-in rồi! Vui lòng Check-out ca trước khi tạo ca mới.'
                ]);
            }

            $isTangCa = (bool) $luotCuoiHomNay;

            DB::table('chamcong')->insert([
                'ma_nhan_vien'  => $nhanVien->ma_nhan_vien,
                'thoi_gian_vao' => $now,
                'trang_thai'    => $isTangCa ? 'Tăng ca' : 'Thành công',
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            $type = $isTangCa ? 'Check-in Tăng ca' : 'Check-in (Vào)';
        }
        // TRƯỜNG HỢP 2: BẤM CHECK-OUT (RA)
        else {
            if (!$luotCuoiHomNay || !is_null($luotCuoiHomNay->thoi_gian_ra)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa Check-in ca nào để thực hiện Check-out!'
                ]);
            }

            DB::table('chamcong')
                ->where('id', $luotCuoiHomNay->id)
                ->update([
                    'thoi_gian_ra' => $now,
                    'updated_at'   => $now,
                ]);

            $type = ($luotCuoiHomNay->trang_thai === 'Tăng ca') ? 'Check-out Tăng ca' : 'Check-out (Ra)';
        }

        return response()->json([
            'success'   => true,
            'ho_ten'    => $nhanVien->ho_va_ten ?? $nhanVien->ho_ten,
            'loai'      => $type,
            'thoi_gian' => $now->format('H:i:s d/m/Y')
        ]);
    }

    /**
     * 4. Trang danh sách lịch sử chấm công (Đã sửa đồng bộ tên bảng chamcong & nhanvien)
     */
    public function lichSuChamCong()
    {
        $lichSu = DB::table('chamcong')
            ->join('nhanvien', 'chamcong.ma_nhan_vien', '=', 'nhanvien.ma_nhan_vien')
            ->select('chamcong.*', 'nhanvien.ho_va_ten as ho_ten')
            ->orderBy('chamcong.created_at', 'desc')
            ->paginate(15);

        return view('chamcong.lich_su', compact('lichSu'));
    }
}
