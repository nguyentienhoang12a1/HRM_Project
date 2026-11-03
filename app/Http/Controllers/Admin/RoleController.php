<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChucVu;
use App\Models\NhatKyHeThong;
use App\Models\PhanQuyen;
use App\Models\TaiKhoan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Throwable;

/**
 * RoleController: Quản lý và áp dụng phân quyền truy cập (UC-ROLE-01).
 */
class RoleController extends Controller
{
    /**
     * Phần A - Bước 1-13 (UC-ROLE-01): Hiển thị danh sách tài khoản, chức vụ và quyền hạn.
     */
    public function index(): View
    {
        $accounts = TaiKhoan::with(['nhanVien.chucVu.phongBan', 'phanQuyen'])->orderBy('id', 'asc')->get();
        $phanQuyens = PhanQuyen::orderBy('ma_quyen', 'asc')->get();
        $chucVus = ChucVu::with('phongBan')->get();
        $auditLogs = NhatKyHeThong::latest('id')->take(10)->get();

        return view('admin.roles.index', compact('accounts', 'phanQuyens', 'chucVus', 'auditLogs'));
    }

    /**
     * Phần A - Bước 14-33 (UC-ROLE-01): Cập nhật ma_quyen, ma_chuc_vu, trạng thái nhân viên và ghi nhật ký.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        /** @var \App\Models\TaiKhoan $admin */
        $admin = TaiKhoan::with('phanQuyen')->findOrFail(Auth::id());

        if (!$admin || !$admin->isAdmin()) {
            return back()->withErrors(['role_error' => 'Từ chối truy cập (E1): Bạn không có quyền quản lý phân quyền.']);
        }

        // Bước 18-23 (Nhánh E2/E3): Kiểm tra tính hợp lệ của quyền và chức vụ
        $validator = Validator::make($request->all(), [
            'ma_quyen'   => ['required', 'integer', 'exists:PhanQuyen,ma_quyen'],
            'ma_chuc_vu' => ['required', 'string', 'exists:ChucVu,ma_chuc_vu'],
            'trang_thai' => ['required', 'string', 'max:30'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['role_error' => 'Thông báo dữ liệu không hợp lệ: Quyền hoặc chức vụ không tồn tại.']);
        }

        DB::beginTransaction();
        try {
            $account = TaiKhoan::with('nhanVien')->findOrFail($id);

            // Bước 24-25: Lưu thông tin phân quyền vào bảng TaiKhoan và NhanVien
            $account->update([
                'ma_quyen' => (int) $request->input('ma_quyen'),
            ]);

            if ($account->nhanVien) {
                $account->nhanVien->update([
                    'ma_chuc_vu' => $request->input('ma_chuc_vu'),
                    'trang_thai' => $request->input('trang_thai'),
                ]);
            }

            // Bước 29-30: Ghi nhật ký thay đổi quyền vào bảng NhatKyHeThong
            $quyenMoi = PhanQuyen::find($request->input('ma_quyen'));
            NhatKyHeThong::create([
                'nguoi_thuc_hien_id' => $admin->id,
                'hanh_dong'          => 'CAP_NHAT_PHAN_QUYEN',
                'chi_tiet'           => sprintf(
                    'Cập nhật tài khoản [%s - Mã NV: %s] -> Quyền: %s | Chức vụ: %s | Trạng thái: %s',
                    $account->ten_tai_khoan,
                    $account->ma_nhan_vien,
                    optional($quyenMoi)->ten_quyen ?? $request->input('ma_quyen'),
                    $request->input('ma_chuc_vu'),
                    $request->input('trang_thai')
                ),
                'ip_address'         => $request->ip(),
            ]);

            DB::commit();

            // Bước 31-33: Thông báo cập nhật thành công
            return back()->with('success_message', "Cập nhật phân quyền cho tài khoản [{$account->ten_tai_khoan}] thành công!");
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Lỗi cập nhật phân quyền: ' . $e->getMessage());
            return back()->withErrors(['role_error' => 'Không thể lưu thay đổi (E4). Vui lòng thử lại.']);
        }
    }
}