<?php

namespace App\Http\Controllers;

use App\Models\ChucVu;
use App\Models\NhanVien;
use App\Models\PhongBan;
use App\Models\TaiKhoan;
use App\Models\VaiTro;
use App\Models\ViTriCongViec;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class NhanVienController extends Controller
{
    /**
     * Danh sách nhân viên (lọc theo phạm vi quyền NS_012 và từ khóa).
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $query = NhanVien::with(['phongBan', 'chucVu', 'viTriCongViec', 'taiKhoan.vaiTros']);

        // Giới hạn dữ liệu theo phạm vi quyền thực tế trong VaiTroChucNang
        $scope = $user ? $user->getDataScope('NS_012') : 'all';
        if ($scope === 'department' && optional($user->nhanVien)->ma_phong_ban) {
            $query->where('ma_phong_ban', $user->nhanVien->ma_phong_ban);
        } elseif ($scope === 'self') {
            $query->where('ma_nhan_vien', $user->ma_nhan_vien ?? '');
        }

        // Thống kê nhanh theo phạm vi
        $baseQuery = clone $query;
        $totalCount = (clone $baseQuery)->count();
        $activeCount = (clone $baseQuery)->where('trang_thai_nhan_vien', 'Đang làm việc')->count();
        $inactiveCount = (clone $baseQuery)->whereIn('trang_thai_nhan_vien', ['Đã nghỉ việc', 'Tạm khóa'])->count();
        $warningCount = (clone $baseQuery)->whereNotNull('ngay_canh_bao')
            ->where('ngay_canh_bao', '<=', Carbon::now()->addDays(30))
            ->count();

        // Tìm kiếm theo các cột trong bảng NhanVien
        $keyword = trim((string) $request->input('search', $request->input('q', $request->input('keyword', ''))));
        if ($keyword !== '') {
            $query->where(function ($q) use ($keyword) {
                $q->where('ma_nhan_vien', 'like', "%{$keyword}%")
                    ->orWhere('ho_va_ten', 'like', "%{$keyword}%")
                    ->orWhere('so_di_dong', 'like', "%{$keyword}%")
                    ->orWhere('so_cccd', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('ma_phong_ban')) {
            $query->where('ma_phong_ban', $request->input('ma_phong_ban'));
        }

        if ($request->filled('ma_chuc_vu')) {
            $query->where('ma_chuc_vu', $request->input('ma_chuc_vu'));
        }

        if ($request->filled('trang_thai_nhan_vien')) {
            $query->where('trang_thai_nhan_vien', $request->input('trang_thai_nhan_vien'));
        }

        $perPage = (int) $request->input('per_page', 10);
        if ($perPage < 5 || $perPage > 100) {
            $perPage = 10;
        }

        $nhanViens = $query->orderBy('stt')->paginate($perPage)->withQueryString();
        $phongBans = PhongBan::orderBy('ten_phong_ban')->get();
        $chucVus = ChucVu::orderBy('ten_chuc_vu')->get();
        $viTriCongViecs = ViTriCongViec::orderBy('ten_vi_tri_cong_viec')->get();

        $selectedNhanVien = null;
        if ($request->filled('ma_nhan_vien')) {
            $selectedNhanVien = NhanVien::with(['phongBan', 'chucVu', 'viTriCongViec', 'taiKhoan.vaiTros'])
                ->find($request->input('ma_nhan_vien'));
            if ($selectedNhanVien) {
                $this->authorizeEmployeeScope($request, $selectedNhanVien, 'NS_012');
            }
        }

        return view('nhanvien.index', compact(
            'nhanViens',
            'phongBans',
            'chucVus',
            'viTriCongViecs',
            'selectedNhanVien',
            'totalCount',
            'activeCount',
            'inactiveCount',
            'warningCount'
        ));
    }

    /**
     * Form thêm mới nhân viên (NS_013).
     */
    public function create(?Request $request = null)
    {
        $phongBans = PhongBan::orderBy('ten_phong_ban')->get();
        $chucVus = ChucVu::orderBy('ten_chuc_vu')->get();
        $viTriCongViecs = ViTriCongViec::orderBy('ten_vi_tri_cong_viec')->get();
        $vaiTros = VaiTro::where('trang_thai', true)->orderBy('ten_vai_tro')->get();

        // Tự động tính toán mã gợi ý tiếp theo
        $lastNum = 0;
        $allCodes = NhanVien::pluck('ma_nhan_vien');
        foreach ($allCodes as $c) {
            if (preg_match('/NV(\d+)/i', $c, $matches)) {
                $num = (int) $matches[1];
                if ($num > $lastNum) {
                    $lastNum = $num;
                }
            }
        }
        $suggestedCode = 'NV'.str_pad($lastNum + 1, 3, '0', STR_PAD_LEFT);

        return view('nhanvien.create', compact('phongBans', 'chucVus', 'viTriCongViecs', 'vaiTros', 'suggestedCode'));
    }

    /**
     * Xem chi tiết hồ sơ một nhân viên (NS_012).
     */
    public function show(Request $request, string $ma_nhan_vien)
    {
        $nhanVien = NhanVien::with([
            'phongBan',
            'chucVu',
            'viTriCongViec',
            'taiKhoan.vaiTros',
            'hopDongs',
            'chamCongs',
            'donNghiPheps',
        ])->findOrFail($ma_nhan_vien);

        $this->authorizeEmployeeScope($request, $nhanVien, 'NS_012');

        return view('nhanvien.show', compact('nhanVien'));
    }

    /**
     * Form chỉnh sửa hồ sơ nhân viên (NS_014).
     */
    public function edit(Request $request, string $ma_nhan_vien)
    {
        $nhanVien = NhanVien::with(['phongBan', 'chucVu', 'viTriCongViec', 'taiKhoan.vaiTros'])
            ->findOrFail($ma_nhan_vien);

        $this->authorizeEmployeeScope($request, $nhanVien, 'NS_014');

        $phongBans = PhongBan::orderBy('ten_phong_ban')->get();
        $chucVus = ChucVu::orderBy('ten_chuc_vu')->get();
        $viTriCongViecs = ViTriCongViec::orderBy('ten_vi_tri_cong_viec')->get();
        $vaiTros = VaiTro::where('trang_thai', true)->orderBy('ten_vai_tro')->get();
        $taiKhoan = $nhanVien->taiKhoan;

        return view('nhanvien.edit', compact('nhanVien', 'phongBans', 'chucVus', 'viTriCongViecs', 'vaiTros', 'taiKhoan'));
    }

    /**
     * Thêm mới nhân viên (NS_013).
     */
    public function store(Request $request)
    {
        $this->normalizeRequestInputs($request);

        $validated = $request->validate([
            'ma_nhan_vien' => ['required', 'string', 'max:20', Rule::unique('NhanVien', 'ma_nhan_vien')],
            'ho_va_ten' => ['required', 'string', 'max:100'],
            'gioi_tinh' => ['required', 'string', 'max:10'],
            'ngay_sinh' => ['nullable', 'date'],
            'ma_phong_ban' => ['required', 'string', Rule::exists('PhongBan', 'ma_phong_ban')],
            'ma_chuc_vu' => ['nullable', 'string', Rule::exists('ChucVu', 'ma_chuc_vu')],
            'ma_vi_tri_cong_viec' => ['required', 'string', Rule::exists('ViTriCongViec', 'ma_vi_tri_cong_viec')],
            'so_di_dong' => ['required', 'string', 'max:15'],
            'ngay_vao_lam_viec' => ['required', 'date'],
            'email' => ['required', 'email', 'max:100'],
            'so_cccd' => ['required', 'string', 'max:20', Rule::unique('NhanVien', 'so_cccd')],
            'ma_so_thue' => ['nullable', 'string', 'max:20', Rule::unique('NhanVien', 'ma_so_thue')],
            'so_so_lao_dong' => ['nullable', 'string', 'max:30', Rule::unique('NhanVien', 'so_so_lao_dong')],
            'trang_thai_nhan_vien' => ['nullable', Rule::in(['Đang làm việc', 'Tạm khóa', 'Đã nghỉ việc'])],
            'que_quan' => ['nullable', 'string', 'max:255'],
            'noi_o_dia_chi' => ['nullable', 'string', 'max:500'],
            'ten_tai_khoan' => ['nullable', 'string', 'max:50', Rule::unique('TaiKhoan', 'ten_tai_khoan')],
            'mat_khau' => ['nullable', 'string', 'min:6'],
            'ma_vai_tro' => ['nullable', 'string', Rule::exists('VaiTro', 'ma_vai_tro')],
        ], [
            'ma_nhan_vien.unique' => 'Mã nhân viên đã tồn tại.',
            'so_cccd.unique' => 'Số CCCD đã tồn tại trong hệ thống.',
            'ma_phong_ban.required' => 'Vui lòng chọn phòng ban.',
            'ma_vi_tri_cong_viec.required' => 'Vui lòng chọn vị trí công việc.',
            'email.required' => 'Vui lòng nhập email nhân viên.',
        ]);

        [$ho, $ten] = $this->splitFullName($validated['ho_va_ten']);

        $defaultChucVu = $validated['ma_chuc_vu']
            ?? ChucVu::where('ma_chuc_vu', 'CV_NhanVien')->value('ma_chuc_vu')
            ?? ChucVu::value('ma_chuc_vu');

        $nextStt = ((int) NhanVien::max('stt')) + 1;
        $maNv = $validated['ma_nhan_vien'];

        $payload = array_merge($validated, [
            'stt' => $nextStt,
            'ho' => $request->input('ho', $ho),
            'ten' => $request->input('ten', $ten),
            'ma_chuc_vu' => $defaultChucVu,
            'ma_so_thue' => ! empty($validated['ma_so_thue']) ? $validated['ma_so_thue'] : 'MST-'.$maNv,
            'so_so_lao_dong' => ! empty($validated['so_so_lao_dong']) ? $validated['so_so_lao_dong'] : 'SLD-'.$maNv,
            'trang_thai_nhan_vien' => $validated['trang_thai_nhan_vien'] ?? 'Đang làm việc',
        ]);

        $columns = Schema::getColumnListing('NhanVien');
        $filteredPayload = array_intersect_key($payload, array_flip($columns));

        DB::transaction(function () use ($request, $filteredPayload, $validated, $maNv) {
            $nhanVien = new NhanVien($filteredPayload);
            $this->authorizeEmployeeScope($request, $nhanVien, 'NS_013');
            $nhanVien->save();

            // Tạo tài khoản nếu có cung cấp thông tin
            if (! empty($validated['ten_tai_khoan']) && ! empty($validated['mat_khau'])) {
                $taiKhoan = TaiKhoan::create([
                    'ten_tai_khoan' => trim($validated['ten_tai_khoan']),
                    'mat_khau' => Hash::make($validated['mat_khau']),
                    'ma_nhan_vien' => $maNv,
                    'trang_thai' => (($validated['trang_thai_nhan_vien'] ?? 'Đang làm việc') === 'Đang làm việc'),
                ]);

                if (! empty($validated['ma_vai_tro'])) {
                    $taiKhoan->vaiTros()->attach($validated['ma_vai_tro']);
                }
            }
        });

        return redirect()
            ->route('nhanvien.index')
            ->with('success', "Đã thêm nhân viên {$validated['ho_va_ten']} ({$maNv}) thành công.");
    }

    /**
     * Cập nhật thông tin nhân viên và đồng bộ trạng thái tài khoản (NS_014).
     */
    public function update(Request $request, string $ma_nhan_vien)
    {
        $nhanVien = NhanVien::findOrFail($ma_nhan_vien);
        $this->authorizeEmployeeScope($request, $nhanVien, 'NS_014');
        $this->normalizeRequestInputs($request);

        $validated = $request->validate([
            'ho_va_ten' => ['required', 'string', 'max:100'],
            'gioi_tinh' => ['required', 'string', 'max:10'],
            'ngay_sinh' => ['nullable', 'date'],
            'ma_phong_ban' => ['required', 'string', Rule::exists('PhongBan', 'ma_phong_ban')],
            'ma_chuc_vu' => ['nullable', 'string', Rule::exists('ChucVu', 'ma_chuc_vu')],
            'ma_vi_tri_cong_viec' => ['required', 'string', Rule::exists('ViTriCongViec', 'ma_vi_tri_cong_viec')],
            'so_di_dong' => ['required', 'string', 'max:15'],
            'ngay_vao_lam_viec' => ['required', 'date'],
            'email' => ['required', 'email', 'max:100'],
            'so_cccd' => [
                'required',
                'string',
                'max:20',
                Rule::unique('NhanVien', 'so_cccd')->ignore($ma_nhan_vien, 'ma_nhan_vien'),
            ],
            'ma_so_thue' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('NhanVien', 'ma_so_thue')->ignore($ma_nhan_vien, 'ma_nhan_vien'),
            ],
            'so_so_lao_dong' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique('NhanVien', 'so_so_lao_dong')->ignore($ma_nhan_vien, 'ma_nhan_vien'),
            ],
            'trang_thai_nhan_vien' => ['required', Rule::in(['Đang làm việc', 'Tạm khóa', 'Đã nghỉ việc'])],
            'que_quan' => ['nullable', 'string', 'max:255'],
            'noi_o_dia_chi' => ['nullable', 'string', 'max:500'],
            'ten_tai_khoan' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('TaiKhoan', 'ten_tai_khoan')->ignore(optional($nhanVien->taiKhoan)->id),
            ],
            'mat_khau_moi' => ['nullable', 'string', 'min:6'],
            'ma_vai_tro' => ['nullable', 'string', Rule::exists('VaiTro', 'ma_vai_tro')],
        ]);

        [$ho, $ten] = $this->splitFullName($validated['ho_va_ten']);
        $validated['ho'] = $request->input('ho', $ho);
        $validated['ten'] = $request->input('ten', $ten);

        if (empty($validated['ma_chuc_vu'])) {
            $validated['ma_chuc_vu'] = $nhanVien->ma_chuc_vu;
        }
        if (empty($validated['ma_so_thue'])) {
            $validated['ma_so_thue'] = $nhanVien->ma_so_thue ?: ('MST-'.$ma_nhan_vien);
        }
        if (empty($validated['so_so_lao_dong'])) {
            $validated['so_so_lao_dong'] = $nhanVien->so_so_lao_dong ?: ('SLD-'.$ma_nhan_vien);
        }

        $columns = Schema::getColumnListing('NhanVien');
        $filteredPayload = array_intersect_key($validated, array_flip($columns));

        DB::transaction(function () use ($nhanVien, $filteredPayload, $validated) {
            $nhanVien->update($filteredPayload);

            // Đồng bộ trạng thái và thông tin tài khoản
            $isAccountActive = ($validated['trang_thai_nhan_vien'] === 'Đang làm việc');
            $taiKhoan = TaiKhoan::where('ma_nhan_vien', $nhanVien->ma_nhan_vien)->first();

            if ($taiKhoan) {
                $accUpdates = ['trang_thai' => $isAccountActive];
                if (! empty($validated['ten_tai_khoan'])) {
                    $accUpdates['ten_tai_khoan'] = trim($validated['ten_tai_khoan']);
                }
                if (! empty($validated['mat_khau_moi'])) {
                    $accUpdates['mat_khau'] = Hash::make($validated['mat_khau_moi']);
                }
                $taiKhoan->update($accUpdates);
                $taiKhoan->vaiTros()->sync(
                    ! empty($validated['ma_vai_tro']) ? [$validated['ma_vai_tro']] : []
                );
            } elseif (! empty($validated['ten_tai_khoan'])) {
                $newAcc = TaiKhoan::create([
                    'ten_tai_khoan' => trim($validated['ten_tai_khoan']),
                    'mat_khau' => Hash::make($validated['mat_khau_moi'] ?? 'Admin@123'),
                    'ma_nhan_vien' => $nhanVien->ma_nhan_vien,
                    'trang_thai' => $isAccountActive,
                ]);

                if (! empty($validated['ma_vai_tro'])) {
                    $newAcc->vaiTros()->sync([$validated['ma_vai_tro']]);
                }
            }
        });

        return redirect()
            ->route('nhanvien.index')
            ->with('success', "Đã cập nhật hồ sơ nhân viên {$nhanVien->ho_va_ten} thành công.");
    }

    /**
     * Xóa hoặc chuyển trạng thái nghỉ việc cho nhân viên (NS_014).
     */
    public function destroy(Request $request, string $ma_nhan_vien)
    {
        $nhanVien = NhanVien::findOrFail($ma_nhan_vien);
        $this->authorizeEmployeeScope($request, $nhanVien, 'NS_014');

        DB::transaction(function () use ($nhanVien) {
            TaiKhoan::where('ma_nhan_vien', $nhanVien->ma_nhan_vien)
                ->update(['trang_thai' => false]);
            $nhanVien->update([
                'trang_thai_nhan_vien' => 'Đã nghỉ việc',
                'ngay_thoi_viec' => $nhanVien->ngay_thoi_viec ?: now()->toDateString(),
            ]);
        });

        return redirect()
            ->route('nhanvien.index')
            ->with('success', "Đã ngừng hoạt động nhân viên {$nhanVien->ho_va_ten}.");
    }

    /**
     * Chuẩn hóa tên trường từ form sang đúng tên cột trong CSDL.
     */
    private function normalizeRequestInputs(Request $request): void
    {
        $merge = [];

        if (! $request->filled('ho_va_ten') && $request->filled('ho_ten')) {
            $merge['ho_va_ten'] = $request->input('ho_ten');
        }
        if (! $request->filled('so_di_dong') && $request->filled('so_dien_thoai')) {
            $merge['so_di_dong'] = $request->input('so_dien_thoai');
        }
        if (! $request->filled('so_cccd') && $request->filled('cccd')) {
            $merge['so_cccd'] = $request->input('cccd');
        }
        if (! $request->filled('ma_vi_tri_cong_viec') && $request->filled('ma_vi_tri')) {
            $merge['ma_vi_tri_cong_viec'] = $request->input('ma_vi_tri');
        }
        if (! $request->filled('ngay_vao_lam_viec') && $request->filled('ngay_vao_lam')) {
            $merge['ngay_vao_lam_viec'] = $request->input('ngay_vao_lam');
        }
        if (! $request->filled('noi_o_dia_chi') && $request->filled('dia_chi')) {
            $merge['noi_o_dia_chi'] = $request->input('dia_chi');
        }
        if (! $request->filled('gioi_tinh')) {
            $merge['gioi_tinh'] = 'Nam';
        }

        // Chuẩn hóa trạng thái nếu truyền không dấu
        $statusMap = [
            'Dang lam viec' => 'Đang làm việc',
            'Thu viec' => 'Đang làm việc',
            'Khoa' => 'Tạm khóa',
            'Tam khoa' => 'Tạm khóa',
            'Nghi viec' => 'Đã nghỉ việc',
            'Da nghi viec' => 'Đã nghỉ việc',
            'active' => 'Đang làm việc',
            'leave' => 'Tạm khóa',
            'resigned' => 'Đã nghỉ việc',
        ];
        if ($request->filled('trang_thai_nhan_vien') && isset($statusMap[$request->input('trang_thai_nhan_vien')])) {
            $merge['trang_thai_nhan_vien'] = $statusMap[$request->input('trang_thai_nhan_vien')];
        }

        if (! empty($merge)) {
            $request->merge($merge);
        }
    }

    /**
     * Tách họ và tên từ họ và tên đầy đủ.
     */
    private function splitFullName(string $fullName): array
    {
        $parts = preg_split('/\s+/', trim($fullName)) ?: [];
        if (count($parts) <= 1) {
            return [$fullName, $fullName];
        }

        $ten = array_pop($parts);
        $ho = implode(' ', $parts);

        return [$ho, $ten];
    }

    /**
     * Kiểm tra phạm vi quyền của user hiện tại đối với nhân viên mục tiêu.
     */
    private function authorizeEmployeeScope(Request $request, NhanVien $target, string $maChucNang = 'NS_012'): void
    {
        $user = $request->user();
        if (! $user) {
            return;
        }

        $scope = $user->getDataScope($maChucNang);
        if ($scope === 'all') {
            return;
        }

        if ($scope === 'department') {
            $userDept = optional($user->nhanVien)->ma_phong_ban;
            if ($userDept && $userDept === $target->ma_phong_ban) {
                return;
            }
        }

        if ($scope === 'self' && $user->ma_nhan_vien === $target->ma_nhan_vien) {
            return;
        }

        abort(403, 'Bạn không có quyền thao tác trên nhân viên ngoài phạm vi được phân công.');
    }
}
