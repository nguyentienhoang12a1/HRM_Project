<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Models\TaiKhoan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChamCongController extends Controller
{
    /**
     * 1. Giao diện Máy Chấm Công riêng biệt (không cần đăng nhập)
     */
    public function index()
    {
        return view('chamcong.cham_cong');
    }

    /**
     * Kiểm tra tài khoản có thuộc nhóm Admin hoặc HR không
     */
    private function canManageFaceId(?TaiKhoan $taiKhoan): bool
    {
        if (!$taiKhoan) {
            return false;
        }

        return $taiKhoan->hasRole(['VT_Admin', 'VT_HR']);
    }

    /**
     * Quét mặt xong -> kiểm tra ma_nhan_vien có thuộc tài khoản Admin hoặc HR không.
     * Nếu đúng -> đăng nhập phiên cho tài khoản đó và trả về URL sang trang đăng ký FaceID.
     */
    public function verifyAdminByFace(Request $request)
    {
        $request->validate([
            'ma_nhan_vien' => 'required|string',
        ]);

        $taiKhoan = TaiKhoan::with(['vaiTros.chucNangs', 'nhanVien'])
            ->where('ma_nhan_vien', $request->ma_nhan_vien)
            ->where('trang_thai', true)
            ->first();

        if (!$taiKhoan) {
            return response()->json(['is_admin' => false]);
        }

        $trangThaiNV = mb_strtolower(trim((string) optional($taiKhoan->nhanVien)->trang_thai_nhan_vien));
        if (in_array($trangThaiNV, ['đã nghỉ việc', 'da nghi viec', 'tạm khóa', 'tam khoa'], true)) {
            return response()->json(['is_admin' => false]);
        }

        $activeRoles = $taiKhoan->vaiTros->where('trang_thai', true);
        $roleKeys = $activeRoles->pluck('ma_vai_tro')->toArray();
        $matchedRoles = array_values(array_intersect($roleKeys, ['VT_Admin', 'VT_HR']));

        if (empty($matchedRoles)) {
            return response()->json(['is_admin' => false]);
        }

        Auth::login($taiKhoan);
        $request->session()->regenerate();

        $userPermissions = $activeRoles
            ->flatMap(fn ($vt) => $vt->chucNangs)
            ->filter(fn ($cn) => $cn->trang_thai && $cn->pivot->duoc_thuc_hien)
            ->pluck('ma_chuc_nang')
            ->unique()
            ->values()
            ->toArray();

        $userScope = $activeRoles
            ->flatMap(fn ($vt) => $vt->chucNangs)
            ->filter(fn ($cn) => $cn->trang_thai && $cn->pivot->duoc_thuc_hien)
            ->map(fn ($cn) => [
                'ma_chuc_nang' => $cn->ma_chuc_nang,
                'ma_pham_vi'   => $cn->pivot->ma_pham_vi,
            ])
            ->values()
            ->toArray();

        $request->session()->put([
            'tai_khoan_id'            => $taiKhoan->id,
            'ten_tai_khoan'           => $taiKhoan->ten_tai_khoan,
            'ma_nhan_vien'            => $taiKhoan->ma_nhan_vien,
            'ho_va_ten'               => optional($taiKhoan->nhanVien)->ho_va_ten,
            'user_roles'              => $roleKeys,
            'user_permissions'        => $userPermissions,
            'user_scope'              => $userScope,
            'last_activity_timestamp' => time(),
        ]);

        $roleLabel = in_array('VT_Admin', $matchedRoles, true) ? 'Admin' : 'HR';

        return response()->json([
            'is_admin'     => true,
            'role_label'   => $roleLabel,
            'redirect_url' => route('chamcong.face.register.form'),
        ]);
    }

    /**
     * 2. Hiển thị trang Đăng ký FaceID (chỉ Admin hoặc HR qua middleware)
     */
    public function showFaceRegister(Request $request)
    {
        $danhSachNhanVien = NhanVien::orderBy('ma_nhan_vien', 'asc')->get();
        $maNhanVien = $request->query('ma_nhan_vien');
        $nhanVien = $maNhanVien
            ? $danhSachNhanVien->firstWhere('ma_nhan_vien', $maNhanVien)
            : null;

        if (view()->exists('nhanvien.dang_ky_faceid')) {
            return view('nhanvien.dang_ky_faceid', [
                'danhSachNhanVien' => $danhSachNhanVien,
                'nhanViens'        => $danhSachNhanVien,
                'nhanVien'         => $nhanVien,
            ]);
        }

        return view('chamcong.cham_cong', [
            'danhSachNhanVien' => $danhSachNhanVien,
            'nhanViens'        => $danhSachNhanVien,
            'nhanVien'         => $nhanVien,
        ]);
    }

    /**
     * 3. Trả về danh sách Vector khuôn mặt hợp lệ để nạp vào JS
     */
    public function getFaceDatabase()
    {
        return response()->json(
            NhanVien::whereNotNull('face_vector')
                ->select('ma_nhan_vien', 'ho_va_ten as ho_ten', 'face_vector')
                ->get()
                ->map(function ($emp) {
                    $decoded = json_decode($emp->face_vector, true);
                    if (!is_array($decoded) || empty($decoded)) {
                        return null;
                    }

                    return [
                        'ma_nhan_vien' => $emp->ma_nhan_vien,
                        'ho_ten'       => $emp->ho_ten,
                        'face_vector'  => $decoded,
                    ];
                })
                ->filter()
                ->values()
        );
    }

    /**
     * 4. Chỉ Admin hoặc HR mới được đăng ký / lưu FaceID cho nhân viên
     */
    public function saveFaceVector(Request $request)
    {
        $user = $request->user();

        if (!$this->canManageFaceId($user)) {
            return response()->json([
                'success' => false,
                'message' => 'Chỉ tài khoản Admin hoặc HR mới có quyền đăng ký FaceID!',
            ], 403);
        }

        $validated = $request->validate([
            'ma_nhan_vien' => 'required|string|exists:NhanVien,ma_nhan_vien',
            'face_vector'  => 'required',
        ]);

        $decodedVector = is_string($validated['face_vector'])
            ? json_decode($validated['face_vector'], true)
            : $validated['face_vector'];

        if (!is_array($decodedVector) || count($decodedVector) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu vector khuôn mặt không hợp lệ!',
            ], 422);
        }

        NhanVien::where('ma_nhan_vien', $validated['ma_nhan_vien'])
            ->update(['face_vector' => json_encode(array_values($decodedVector))]);

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký FaceID thành công!',
        ]);
    }

    /**
     * 5. Nhận request từ JS và lưu nhật ký chấm công (Hỗ trợ cả Ca chính & Tăng ca)
     */
    public function storeCheckin(Request $request)
    {
        $request->validate([
            'ma_nhan_vien'   => 'required|string',
            'loai_cham_cong' => 'nullable|in:in,out',
        ]);

        $nhanVien = DB::table('NhanVien')
            ->where('ma_nhan_vien', $request->ma_nhan_vien)
            ->first();

        if (!$nhanVien) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy thông tin nhân viên!',
            ], 404);
        }

        $trangThaiNV = mb_strtolower(trim((string) ($nhanVien->trang_thai_nhan_vien ?? '')));
        if (in_array($trangThaiNV, ['đã nghỉ việc', 'da nghi viec', 'tạm khóa', 'tam khoa'], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Nhân viên đang tạm khóa hoặc đã nghỉ việc, không thể chấm công!',
            ], 403);
        }

        $today = Carbon::today('Asia/Ho_Chi_Minh');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $loaiButton = $request->input('loai_cham_cong');

        $luotCuoiHomNay = DB::table('ChamCong')
            ->where('ma_nhan_vien', $nhanVien->ma_nhan_vien)
            ->whereDate('created_at', $today)
            ->orderBy('id', 'desc')
            ->first();

        // TRƯỜNG HỢP 1: CHECK-IN (VÀO)
        if ($loaiButton === 'in' || (!$luotCuoiHomNay && !$loaiButton)) {
            if ($luotCuoiHomNay && is_null($luotCuoiHomNay->thoi_gian_ra)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn đã Check-in rồi! Vui lòng Check-out ca trước khi tạo ca mới.',
                ]);
            }

            $isTangCa = (bool) $luotCuoiHomNay;

            DB::table('ChamCong')->insert([
                'ma_nhan_vien'  => $nhanVien->ma_nhan_vien,
                'thoi_gian_vao' => $now,
                'trang_thai'    => $isTangCa ? 'Tăng ca' : 'Thành công',
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            $type = $isTangCa ? 'Check-in Tăng ca' : 'Check-in (Vào)';
        }
        // TRƯỜNG HỢP 2: CHECK-OUT (RA)
        else {
            if (!$luotCuoiHomNay || !is_null($luotCuoiHomNay->thoi_gian_ra)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa Check-in ca nào để thực hiện Check-out!',
                ]);
            }

            DB::table('ChamCong')
                ->where('id', $luotCuoiHomNay->id)
                ->update([
                    'thoi_gian_ra' => $now,
                    'updated_at'   => $now,
                ]);

            $type = ($luotCuoiHomNay->trang_thai === 'Tăng ca') ? 'Check-out Tăng ca' : 'Check-out (Ra)';
        }

        return response()->json([
            'success'   => true,
            'ho_ten'    => $nhanVien->ho_va_ten ?? '',
            'loai'      => $type,
            'thoi_gian' => $now->format('H:i:s d/m/Y'),
        ]);
    }

    /**
     * 6. Trang danh sách lịch sử chấm công (chỉ người đã đăng nhập mới xem được)
     */
    public function lichSuChamCong()
    {
        $lichSu = DB::table('ChamCong')
            ->join('NhanVien', 'ChamCong.ma_nhan_vien', '=', 'NhanVien.ma_nhan_vien')
            ->select('ChamCong.*', 'NhanVien.ho_va_ten as ho_ten')
            ->orderBy('ChamCong.created_at', 'desc')
            ->paginate(15);

        $lichSu->getCollection()->transform(function ($item) {
            if (empty($item->thoi_gian_vao) || empty($item->thoi_gian_ra)) {
                $item->thoi_luong = 'Đang làm việc';
                return $item;
            }

            $vao = Carbon::parse($item->thoi_gian_vao);
            $ra = Carbon::parse($item->thoi_gian_ra);

            if ($ra->lessThan($vao)) {
                $item->thoi_luong = '0 giờ 0 phút';
                return $item;
            }

            $diff = $vao->diff($ra);
            $item->thoi_luong = sprintf('%d giờ %d phút', ($diff->days * 24) + $diff->h, $diff->i);

            return $item;
        });

        return view('chamcong.lich_su', compact('lichSu'));
    }
}