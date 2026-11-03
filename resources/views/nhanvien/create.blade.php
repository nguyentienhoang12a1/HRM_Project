@extends('layout.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Thêm Nhân viên & Cấp Tài khoản</h1>
        <a href="{{ route('nhanvien.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">
            &larr; Quay lại danh sách
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-sm text-red-600 space-y-1">
            @foreach ($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('nhanvien.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Khối 1: Hồ sơ Nhân viên -->
            <div class="space-y-4">
                <h2 class="text-sm font-bold uppercase tracking-wider text-blue-600 border-b pb-2">1. Hồ sơ nhân viên</h2>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Mã nhân viên (*)</label>
                    <input type="text" name="ma_nhan_vien" value="{{ old('ma_nhan_vien', $suggestedCode) }}" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Họ và tên (*)</label>
                    <input type="text" name="ho_va_ten" value="{{ old('ho_va_ten') }}" required
                           placeholder="Nhập họ và tên..."
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-emerald-700 mb-1">Email nhận mã OTP (*)</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           placeholder="Nhập Gmail thật để test OTP..."
                           class="w-full px-3.5 py-2 text-sm border border-emerald-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Chức vụ (*)</label>
                        <select name="ma_chuc_vu" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg">
                            <option value="">-- Chọn --</option>
                            @foreach ($chucVus as $cv)
                                <option value="{{ $cv->ma_chuc_vu }}" @selected(old('ma_chuc_vu') === $cv->ma_chuc_vu)>
                                    {{ $cv->ten_chuc_vu }} ({{ optional($cv->phongBan)->ten_phong }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Trạng thái (*)</label>
                        <select name="trang_thai" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg">
                            <option value="Dang lam viec">Đang làm việc</option>
                            <option value="Thu viec">Thử việc</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Số điện thoại</label>
                        <input type="text" name="so_dien_thoai" value="{{ old('so_dien_thoai') }}"
                               class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Ngày sinh</label>
                        <input type="date" name="ngay_sinh" value="{{ old('ngay_sinh') }}"
                               class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Quê quán</label>
                    <input type="text" name="que_quan" value="{{ old('que_quan') }}"
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg">
                </div>
            </div>

            <!-- Khối 2: Tài khoản & Phân quyền -->
            <div class="space-y-4">
                <h2 class="text-sm font-bold uppercase tracking-wider text-blue-600 border-b pb-2">2. Tài khoản đăng nhập</h2>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tên tài khoản (*)</label>
                    <input type="text" name="ten_tai_khoan" value="{{ old('ten_tai_khoan') }}" required
                           placeholder="VD: quangtm"
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Mật khẩu khởi tạo (*)</label>
                    <input type="text" name="mat_khau" value="{{ old('mat_khau', 'Admin@123') }}" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Phân quyền hệ thống (*)</label>
                    <select name="ma_quyen" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg">
                        @foreach ($phanQuyens as $pq)
                            <option value="{{ $pq->ma_quyen }}" @selected((int) old('ma_quyen', 5) === $pq->ma_quyen)>
                                {{ $pq->ten_quyen }} ({{ $pq->mo_ta }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="p-3.5 rounded-lg bg-slate-50 border border-slate-200 text-xs text-slate-600 leading-relaxed">
                    Khi nhân viên đăng nhập bằng <strong>Tên tài khoản</strong> và <strong>Mật khẩu</strong> này, hệ thống sẽ tự động sinh mã OTP 6 chữ số (hạn 5 phút) và gửi tới địa chỉ <strong>Email</strong> đã khai báo.
                </div>

                <button type="submit"
                        class="w-full py-2.5 px-4 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition">
                    Lưu Nhân viên & Cấp Tài khoản
                </button>
            </div>
        </div>
    </form>
</div>
@endsection