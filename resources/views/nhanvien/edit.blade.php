@extends('layout.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Cập nhật Nhân viên: {{ $nhanVien->ma_nhan_vien }}</h1>
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

    <form action="{{ route('nhanvien.update', $nhanVien->ma_nhan_vien) }}" method="POST" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <h2 class="text-sm font-bold uppercase tracking-wider text-blue-600 border-b pb-2">1. Hồ sơ nhân viên</h2>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Họ và tên (*)</label>
                    <input type="text" name="ho_va_ten" value="{{ old('ho_va_ten', $nhanVien->ho_va_ten) }}" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-emerald-700 mb-1">Email nhận mã OTP (*)</label>
                    <input type="email" name="email" value="{{ old('email', $nhanVien->email) }}" required
                           class="w-full px-3.5 py-2 text-sm border border-emerald-400 rounded-lg font-medium">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Chức vụ (*)</label>
                        <select name="ma_chuc_vu" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg">
                            @foreach ($chucVus as $cv)
                                <option value="{{ $cv->ma_chuc_vu }}" @selected(old('ma_chuc_vu', $nhanVien->ma_chuc_vu) === $cv->ma_chuc_vu)>
                                    {{ $cv->ten_chuc_vu }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Trạng thái (*)</label>
                        @php $tt = old('trang_thai', $nhanVien->trang_thai); @endphp
                        <select name="trang_thai" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg">
                            <option value="Dang lam viec" @selected($tt === 'Dang lam viec')>Đang làm việc</option>
                            <option value="Thu viec" @selected($tt === 'Thu viec')>Thử việc</option>
                            <option value="Khoa" @selected($tt === 'Khoa')>Tạm khóa</option>
                            <option value="Nghi viec" @selected($tt === 'Nghi viec')>Nghỉ việc</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Số điện thoại</label>
                        <input type="text" name="so_dien_thoai" value="{{ old('so_dien_thoai', $nhanVien->so_dien_thoai) }}"
                               class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Ngày sinh</label>
                        <input type="date" name="ngay_sinh" value="{{ old('ngay_sinh', $nhanVien->ngay_sinh) }}"
                               class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Quê quán</label>
                    <input type="text" name="que_quan" value="{{ old('que_quan', $nhanVien->que_quan) }}"
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg">
                </div>
            </div>

            <div class="space-y-4">
                <h2 class="text-sm font-bold uppercase tracking-wider text-blue-600 border-b pb-2">2. Tài khoản & Quyền</h2>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tên tài khoản (*)</label>
                    <input type="text" name="ten_tai_khoan"
                           value="{{ old('ten_tai_khoan', optional($nhanVien->taiKhoan)->ten_tai_khoan) }}" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Đặt lại mật khẩu mới (Tùy chọn)</label>
                    <input type="password" name="mat_khau_moi" placeholder="Để trống nếu giữ nguyên..."
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Quyền hệ thống (*)</label>
                    <select name="ma_quyen" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg">
                        @foreach ($phanQuyens as $pq)
                            <option value="{{ $pq->ma_quyen }}"
                                @selected((int) old('ma_quyen', optional($nhanVien->taiKhoan)->ma_quyen) === $pq->ma_quyen)>
                                {{ $pq->ten_quyen }} ({{ $pq->mo_ta }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                        class="w-full py-2.5 px-4 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition">
                    Lưu Cập Nhật
                </button>
            </div>
        </div>
    </form>
</div>
@endsection