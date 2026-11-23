<?php

namespace App\Http\Controllers;

use App\Models\ChamCong;
use App\Models\ChucVu;
use App\Models\DonNghiPhep;
use App\Models\HopDong;
use App\Models\NhanVien;
use App\Models\NhatKyHeThong;
use App\Models\PhongBan;
use App\Models\TaiKhoan;
use App\Models\VaiTro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard tổng quan chung (hỗ trợ cả standalone dashboard lẫn điều hướng).
     */
    public function index(Request $request)
    {
        $tongNhanVien = NhanVien::count();
        $dangLamViec = NhanVien::where('trang_thai_nhan_vien', 'Đang làm việc')->count();
        $donNghiPhep = DonNghiPhep::where('trang_thai', 'Chờ phê duyệt')->count();
        $tongPhongBan = PhongBan::count();
        
        $nhanVienMoiThang = NhanVien::where('ngay_vao_lam_viec', '>=', Carbon::now()->startOfMonth())->count();

        $latestEmployees = NhanVien::with(['phongBan', 'chucVu', 'viTriCongViec'])
            ->orderByDesc('stt')
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'tongNhanVien',
            'dangLamViec',
            'donNghiPhep',
            'tongPhongBan',
            'nhanVienMoiThang',
            'latestEmployees'
        ));
    }

    /**
     * Dashboard cho Admin
     */
    public function admin(Request $request)
    {
        abort_unless(in_array('VT_Admin', session('user_roles', []), true), 403);

        $tongNhanVien = NhanVien::count();
        $tongTaiKhoan = TaiKhoan::count();
        $tongVaiTro = VaiTro::count();
        $vaiTros = VaiTro::withCount('taiKhoans')->get();
        $taiKhoanKhoa = TaiKhoan::with('nhanVien')->where('trang_thai', false)->get();
        $nhatKyHeThongs = NhatKyHeThong::with('taiKhoan.nhanVien')->latest('created_at')->take(10)->get();

        return view('pages.Index_Admin', compact(
            'tongNhanVien',
            'tongTaiKhoan',
            'tongVaiTro',
            'vaiTros',
            'taiKhoanKhoa',
            'nhatKyHeThongs'
        ));
    }

    /**
     * Dashboard cho Giám Đốc
     */
    public function giamdoc(Request $request)
    {
        abort_unless(in_array('VT_GiamDoc', session('user_roles', []), true), 403);

        $tongNhanVien = NhanVien::count();
        $dangLamViec = NhanVien::where('trang_thai_nhan_vien', 'Đang làm việc')->count();
        $tongPhongBan = PhongBan::count();
        $phongBans = PhongBan::withCount('nhanViens')->get();
        $donNghiPheps = DonNghiPhep::with('nhanVien.phongBan')->where('trang_thai', 'Chờ phê duyệt')->take(5)->get();

        return view('pages.Index_GiamDoc', compact(
            'tongNhanVien',
            'dangLamViec',
            'tongPhongBan',
            'phongBans',
            'donNghiPheps'
        ));
    }

    /**
     * Dashboard cho HR
     */
    public function hr(Request $request)
    {
        abort_unless(in_array('VT_HR', session('user_roles', []), true), 403);

        $tongNhanVien = NhanVien::count();
        $dangLamViec = NhanVien::where('trang_thai_nhan_vien', 'Đang làm việc')->count();
        $nghiViec = NhanVien::where('trang_thai_nhan_vien', 'Đã nghỉ việc')->count();
        
        $today = Carbon::today();
        $coMatHomNay = ChamCong::whereDate('thoi_gian_vao', $today)->distinct('ma_nhan_vien')->count('ma_nhan_vien');

        $nhanVienMoi = NhanVien::where('ngay_vao_lam_viec', '>=', Carbon::now()->startOfMonth())->count();
        $donNghiPheps = DonNghiPhep::with('nhanVien')->where('trang_thai', 'Chờ phê duyệt')->take(5)->get();

        $hopDongSapHetHan = HopDong::with('nhanVien')
            ->whereNotNull('ngay_ket_thuc')
            ->whereBetween('ngay_ket_thuc', [Carbon::today(), Carbon::today()->addDays(30)])
            ->get();

        return view('pages.Index_HR', compact(
            'tongNhanVien',
            'dangLamViec',
            'nghiViec',
            'coMatHomNay',
            'nhanVienMoi',
            'donNghiPheps',
            'hopDongSapHetHan'
        ));
    }

    /**
     * Dashboard cho Trưởng Phòng / Phó Phòng
     */
    public function truongphong(Request $request)
    {
        abort_unless(in_array('VT_TruongPhong', session('user_roles', []), true), 403);

        $user = $request->user() ?: Auth::user();
        $maPhongBan = optional($user)->nhanVien?->ma_phong_ban;

        $nhanViensPhong = NhanVien::with(['chucVu', 'viTriCongViec'])
            ->when($maPhongBan, function ($q) use ($maPhongBan) {
                return $q->where('ma_phong_ban', $maPhongBan);
            })
            ->get();
        $tongNhanVienPhong = $nhanViensPhong->count();
        $dangLamViecPhong = $nhanViensPhong->where('trang_thai_nhan_vien', 'Đang làm việc')->count();

        $today = Carbon::today();
        $nvIds = $nhanViensPhong->pluck('ma_nhan_vien');
        $coMatHomNay = ChamCong::whereIn('ma_nhan_vien', $nvIds)
            ->whereDate('thoi_gian_vao', $today)
            ->distinct('ma_nhan_vien')
            ->count('ma_nhan_vien');

        $donNghiPheps = DonNghiPhep::with('nhanVien.viTriCongViec')
            ->whereIn('ma_nhan_vien', $nvIds)
            ->where('trang_thai', 'Chờ phê duyệt')
            ->get();

        return view('pages.Index_TruongPhong', compact(
            'tongNhanVienPhong',
            'dangLamViecPhong',
            'coMatHomNay',
            'donNghiPheps',
            'nhanViensPhong'
        ));
    }

    /**
     * Dashboard cho Nhân Viên
     */
    public function nhanvien(Request $request)
    {
        abort_unless(in_array('VT_NhanVien', session('user_roles', []), true), 403);

        $user = $request->user() ?: Auth::user();
        $nhanVien = optional($user)->nhanVien;

        $chamCongHomNay = null;
        $lichSuChamCong = collect();
        $donNghiPheps = collect();

        if ($nhanVien) {
            $chamCongHomNay = ChamCong::where('ma_nhan_vien', $nhanVien->ma_nhan_vien)
                ->whereDate('thoi_gian_vao', Carbon::today())
                ->first();

            $lichSuChamCong = ChamCong::where('ma_nhan_vien', $nhanVien->ma_nhan_vien)
                ->latest('thoi_gian_vao')
                ->take(7)
                ->get();

            $donNghiPheps = DonNghiPhep::where('ma_nhan_vien', $nhanVien->ma_nhan_vien)
                ->latest('ngay_bat_dau')
                ->take(5)
                ->get();
        }

        return view('pages.Index_NhanVien', compact(
            'nhanVien',
            'chamCongHomNay',
            'lichSuChamCong',
            'donNghiPheps'
        ));
    }
}
