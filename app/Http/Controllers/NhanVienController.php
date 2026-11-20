<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\ChucVu;
use App\Models\NhanVien;
use App\Models\PhanQuyen;
use App\Models\TaiKhoan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

/**
 * NhanVienController: Quản lý hồ sơ Nhân viên (CRUD) tích hợp cấp phát Tài khoản & Phân quyền.
 * Đồng bộ 100% với cấu trúc bảng NhanVien, TaiKhoan, ChucVu, PhanQuyen trong HRM.sql.
 */
class NhanVienController extends Controller
{
    /**
     * Hiển thị danh sách nhân viên kèm tài khoản theo phạm vi dữ liệu (UC-ROLE-01).
     */
    public function index(Request $request): View
    {
        // Sửa lỗi P1013: Truy vấn trực tiếp từ Model TaiKhoan theo Auth::id()
        $currentUser = TaiKhoan::with(['nhanVien.chucVu', 'phanQuyen'])->findOrFail(Auth::id());
        $scope = $currentUser->getDataScope();

        $query = NhanVien::with(['chucVu.phongBan', 'taiKhoan.phanQuyen']);

        // Lọc dữ liệu theo phạm vi quyền (Phần B - UC-ROLE-01)
        if ($scope === 'department') {
            $maPhong = optional(optional($currentUser->nhanVien)->chucVu)->ma_phong;
            $query->whereHas('chucVu', function ($q) use ($maPhong) {
                $q->where('ma_phong', $maPhong);
            });
        } elseif ($scope === 'personal') {
            $query->where('ma_nhan_vien', $currentUser->ma_nhan_vien);
        }

        if ($request->filled('keyword')) {
            $kw = trim($request->input('keyword'));
            $query->where(function ($q) use ($kw) {
                $q->where('ma_nhan_vien', 'like', "%{$kw}%")
                  ->orWhere('ho_va_ten', 'like', "%{$kw}%")
                  ->orWhere('email', 'like', "%{$kw}%");
            });
        }

        $nhanViens = $query->orderBy('ma_nhan_vien', 'asc')->get();

        return view('nhanvien.index', compact('nhanViens', 'scope'));
    }

    /**
     * Hiển thị biểu mẫu thêm mới Nhân viên & Tài khoản đăng nhập.
     */
    public function create(): View
    {
        $chucVus = ChucVu::with('phongBan')->get();
        $phanQuyens = PhanQuyen::orderBy('ma_quyen', 'asc')->get();

        // Tự động gợi ý mã nhân viên tiếp theo (VD: NV006)
        $count = NhanVien::count() + 1;
        $suggestedCode = 'NV' . str_pad((string) $count, 3, '0', STR_PAD_LEFT);
        while (NhanVien::where('ma_nhan_vien', $suggestedCode)->exists()) {
            $count++;
            $suggestedCode = 'NV' . str_pad((string) $count, 3, '0', STR_PAD_LEFT);
        }

        return view('nhanvien.create', compact('chucVus', 'phanQuyens', 'suggestedCode'));
    }

    /**
     * Lưu hồ sơ Nhân viên mới đồng thời khởi tạo Tài khoản đăng nhập (Transaction).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // Dữ liệu bảng NhanVien
            'ma_nhan_vien'  => ['required', 'string', 'max:20', 'unique:NhanVien,ma_nhan_vien'],
            'ho_va_ten'     => ['required', 'string', 'max:100'],
            'email'         => ['required', 'email', 'max:100', 'unique:NhanVien,email'],
            'so_dien_thoai' => ['nullable', 'string', 'max:15'],
            'ngay_sinh'     => ['nullable', 'date'],
            'que_quan'      => ['nullable', 'string', 'max:255'],
            'ma_chuc_vu'    => ['required', 'string', 'exists:ChucVu,ma_chuc_vu'],
            'trang_thai'    => ['required', 'string', 'max:30'],

            // Dữ liệu bảng TaiKhoan
            'ten_tai_khoan' => ['required', 'string', 'alpha_dash', 'min:3', 'max:50', 'unique:TaiKhoan,ten_tai_khoan'],
            'mat_khau'      => ['required', 'string', 'min:6'],
            'ma_quyen'      => ['required', 'integer', 'exists:PhanQuyen,ma_quyen'],
        ], [
            'ma_nhan_vien.required'  => 'Vui lòng nhập mã nhân viên.',
            'ma_nhan_vien.unique'    => 'Mã nhân viên này đã tồn tại.',
            'ho_va_ten.required'     => 'Vui lòng nhập họ và tên nhân viên.',
            'email.required'         => 'Vui lòng nhập địa chỉ Email (dùng để nhận mã OTP).',
            'email.email'            => 'Địa chỉ Email không hợp lệ.',
            'email.unique'           => 'Địa chỉ Email này đã được gán cho nhân viên khác.',
            'ma_chuc_vu.required'    => 'Vui lòng chọn chức vụ.',
            'ten_tai_khoan.required' => 'Vui lòng nhập tên tài khoản đăng nhập.',
            'ten_tai_khoan.unique'   => 'Tên tài khoản này đã tồn tại.',
            'mat_khau.required'      => 'Vui lòng nhập mật khẩu khởi tạo.',
            'mat_khau.min'           => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'ma_quyen.required'      => 'Vui lòng chọn quyền hệ thống.',
        ]);

        DB::beginTransaction();
        try {
            // 1. Tạo bản ghi trong bảng NhanVien
            NhanVien::create([
                'ma_nhan_vien'  => trim($validated['ma_nhan_vien']),
                'ho_va_ten'     => trim($validated['ho_va_ten']),
                'email'         => trim($validated['email']),
                'so_dien_thoai' => $validated['so_dien_thoai'] ?? null,
                'ngay_sinh'     => $validated['ngay_sinh'] ?? null,
                'que_quan'      => $validated['que_quan'] ?? null,
                'ma_chuc_vu'    => $validated['ma_chuc_vu'],
                'trang_thai'    => $validated['trang_thai'],
            ]);

            // 2. Tạo bản ghi trong bảng TaiKhoan liên kết qua cột ma_nhan_vien
            TaiKhoan::create([
                'ten_tai_khoan' => trim($validated['ten_tai_khoan']),
                'mat_khau'      => Hash::make($validated['mat_khau']),
                'ma_nhan_vien' => trim($validated['ma_nhan_vien']),
                'ma_quyen'      => (int) $validated['ma_quyen'],
            ]);

            DB::commit();

            return redirect()->route('nhanvien.index')
                ->with('success_message', "Đã thêm nhân viên [{$validated['ho_va_ten']}] và cấp tài khoản [{$validated['ten_tai_khoan']}] thành công!");
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Lỗi thêm mới nhân viên & tài khoản: ' . $e->getMessage());
            return back()->withInput()->withErrors(['system_error' => 'Không thể lưu dữ liệu nhân viên. Vui lòng kiểm tra lại.']);
        }
    }

    /**
     * Hiển thị biểu mẫu chỉnh sửa Nhân viên & Tài khoản.
     */
    public function edit(string $ma_nhan_vien): View
    {
        $nhanVien = NhanVien::with('taiKhoan')->findOrFail($ma_nhan_vien);
        $chucVus = ChucVu::with('phongBan')->get();
        $phanQuyens = PhanQuyen::orderBy('ma_quyen', 'asc')->get();

        return view('nhanvien.edit', compact('nhanVien', 'chucVus', 'phanQuyens'));
    }

    /**
     * Cập nhật hồ sơ Nhân viên (bao gồm Email nhận OTP) và thông tin Tài khoản.
     */
    public function update(Request $request, string $ma_nhan_vien): RedirectResponse
    {
        $nhanVien = NhanVien::with('taiKhoan')->findOrFail($ma_nhan_vien);
        $taiKhoanId = optional($nhanVien->taiKhoan)->id;

        $validated = $request->validate([
            'ho_va_ten'     => ['required', 'string', 'max:100'],
            'email'         => [
                'required',
                'email',
                'max:100',
                Rule::unique('NhanVien', 'email')->ignore($nhanVien->ma_nhan_vien, 'ma_nhan_vien'),
            ],
            'so_dien_thoai' => ['nullable', 'string', 'max:15'],
            'ngay_sinh'     => ['nullable', 'date'],
            'que_quan'      => ['nullable', 'string', 'max:255'],
            'ma_chuc_vu'    => ['required', 'string', 'exists:ChucVu,ma_chuc_vu'],
            'trang_thai'    => ['required', 'string', 'max:30'],

            'ten_tai_khoan' => [
                'required',
                'string',
                'alpha_dash',
                'max:50',
                Rule::unique('TaiKhoan', 'ten_tai_khoan')->ignore($taiKhoanId, 'id'),
            ],
            'mat_khau_moi'  => ['nullable', 'string', 'min:6'],
            'ma_quyen'      => ['required', 'integer', 'exists:PhanQuyen,ma_quyen'],
        ], [
            'email.required'       => 'Địa chỉ Email không được để trống vì dùng để nhận mã OTP.',
            'email.unique'         => 'Địa chỉ Email này đã thuộc về nhân viên khác.',
            'ten_tai_khoan.unique' => 'Tên tài khoản này đã tồn tại.',
        ]);

        DB::beginTransaction();
        try {
            // 1. Cập nhật bảng NhanVien
            $nhanVien->update([
                'ho_va_ten'     => trim($validated['ho_va_ten']),
                'email'         => trim($validated['email']),
                'so_dien_thoai' => $validated['so_dien_thoai'] ?? null,
                'ngay_sinh'     => $validated['ngay_sinh'] ?? null,
                'que_quan'      => $validated['que_quan'] ?? null,
                'ma_chuc_vu'    => $validated['ma_chuc_vu'],
                'trang_thai'    => $validated['trang_thai'],
            ]);

            // 2. Cập nhật hoặc khởi tạo tài khoản trong bảng TaiKhoan
            $accountData = [
                'ten_tai_khoan' => trim($validated['ten_tai_khoan']),
                'ma_quyen'      => (int) $validated['ma_quyen'],
            ];

            if (!empty($validated['mat_khau_moi'])) {
                $accountData['mat_khau'] = Hash::make($validated['mat_khau_moi']);
            }

            if ($nhanVien->taiKhoan) {
                $nhanVien->taiKhoan->update($accountData);
            } else {
                $accountData['ma_nhan_vien'] = $nhanVien->ma_nhan_vien;
                $accountData['mat_khau'] = $accountData['mat_khau'] ?? Hash::make('Admin@123');
                TaiKhoan::create($accountData);
            }

            DB::commit();

            return redirect()->route('nhanvien.index')
                ->with('success_message', "Cập nhật thông tin nhân viên [{$nhanVien->ma_nhan_vien}] thành công!");
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Lỗi cập nhật nhân viên: ' . $e->getMessage());
            return back()->withInput()->withErrors(['system_error' => 'Không thể cập nhật thông tin nhân viên.']);
        }
    }

    /**
     * Xóa nhân viên và tài khoản liên kết.
     */
    public function destroy(string $ma_nhan_vien): RedirectResponse
    {
        $currentUser = TaiKhoan::findOrFail(Auth::id());

        if ($currentUser->ma_nhan_vien === $ma_nhan_vien) {
            return back()->withErrors(['delete_error' => 'Bạn không thể tự xóa hồ sơ của chính mình khi đang đăng nhập.']);
        }

        DB::beginTransaction();
        try {
            $nhanVien = NhanVien::with('taiKhoan')->findOrFail($ma_nhan_vien);

            if ($nhanVien->taiKhoan) {
                // Xóa các mã OTP cũ trước khi xóa tài khoản để không vướng khóa ngoại MaOTP
                $nhanVien->taiKhoan->maOtps()->delete();
                $nhanVien->taiKhoan->delete();
            }

            $nhanVien->delete();
            DB::commit();

            return redirect()->route('nhanvien.index')
                ->with('success_message', "Đã xóa nhân viên [{$ma_nhan_vien}] và tài khoản liên kết.");
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Lỗi xóa nhân viên: ' . $e->getMessage());
            return back()->withErrors(['delete_error' => 'Không thể xóa nhân viên này do đang có dữ liệu Hợp đồng/Chấm công/Lương liên kết.']);
        }
    }
    /**
     * Hiển thị màn hình đăng ký FaceID dùng chung kèm danh sách nhân viên theo phạm vi quyền.
     */
    public function showFaceRegister(): View
    {
        $currentUser = TaiKhoan::with(['nhanVien.chucVu', 'phanQuyen'])->findOrFail(Auth::id());
        $scope = $currentUser->getDataScope();

        $query = NhanVien::select('ma_nhan_vien', 'ho_va_ten', 'face_vector');

        // Áp dụng lọc phạm vi quyền đồng bộ với trang danh sách nhân viên
        if ($scope === 'department') {
            $maPhong = optional(optional($currentUser->nhanVien)->chucVu)->ma_phong;
            $query->whereHas('chucVu', function ($q) use ($maPhong) {
                $q->where('ma_phong', $maPhong);
            });
        } elseif ($scope === 'personal') {
            $query->where('ma_nhan_vien', $currentUser->ma_nhan_vien);
        }

        $danhSachNhanVien = $query->orderBy('ma_nhan_vien', 'asc')->get();

        // Đổi 'nhanvien.dang_ky_faceid' thành đúng tên file Blade đăng ký FaceID của bạn
        return view('nhanvien.dang_ky_faceid', compact('danhSachNhanVien'));
    }

    /**
     * Lưu dữ liệu vector 128 số (FaceID) cho nhân viên được chọn từ dropdown.
     */
    public function saveFaceVector(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ma_nhan_vien' => ['required', 'string', 'exists:nhanvien,ma_nhan_vien'],
            'face_vector'  => ['required', 'array', 'size:128'],
        ], [
            'ma_nhan_vien.required' => 'Vui lòng chọn nhân viên cần đăng ký.',
            'ma_nhan_vien.exists'   => 'Mã nhân viên không tồn tại trong hệ thống.',
            'face_vector.required'  => 'Không nhận được dữ liệu vector khuôn mặt.',
            'face_vector.size'      => 'Dữ liệu khuôn mặt không đúng chuẩn 128 chiều.',
        ]);

        try {
            $nhanVien = NhanVien::findOrFail($validated['ma_nhan_vien']);
            $nhanVien->update([
                'face_vector' => json_encode($validated['face_vector']),
            ]);

            return response()->json([
                'success' => true,
                'message' => "Đã lưu dữ liệu khuôn mặt thành công cho [{$nhanVien->ho_va_ten}]!"
            ]);
        } catch (Throwable $e) {
            Log::error('Lỗi lưu FaceID nhân viên: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống khi lưu dữ liệu khuôn mặt.'
            ], 500);
        }
    }
}