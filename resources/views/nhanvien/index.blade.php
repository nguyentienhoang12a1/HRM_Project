@extends('layout.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">
        <!-- Tiêu đề & Nút thêm mới -->
        
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Quản lý Nhân viên & Tài khoản</h1>
                <p class="text-sm text-slate-500 mt-1">
                    Phạm vi dữ liệu: <span class="font-semibold uppercase text-blue-600">{{ $scope }}</span>
                </p>
            </div>
            <div class="flex items-center gap-2">
                @if (auth()->check() && \App\Models\TaiKhoan::with('phanQuyen')->find(auth()->id())?->isAdmin())
                    <a href="{{ route('admin.roles.index') }}"
                        class="px-4 py-2 text-sm font-medium text-amber-700 bg-amber-100 hover:bg-amber-200 rounded-lg transition">
                        Phân quyền (UC-ROLE-01)
                    </a>
                @endif
                <a href="{{ route('nhanvien.create') }}"
                    class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition">
                    + Thêm Nhân viên & Cấp TK
                </a>
            </div>
        </div>

        <!-- Thông báo thành công / lỗi -->
        @if (session('success_message'))
            <div class="mb-4 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium">
                {{ session('success_message') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-600 text-sm">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Thanh tìm kiếm -->
        <form action="{{ route('nhanvien.index') }}" method="GET"
            class="mb-5 flex flex-wrap items-center gap-2 bg-white p-3 rounded-xl shadow-sm border border-slate-200">
            <input type="text" name="keyword" value="{{ request('keyword') }}"
                placeholder="Tìm theo Mã NV, Họ tên hoặc Email nhận OTP..."
                class="flex-1 min-w-[240px] px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-slate-800 hover:bg-slate-900 rounded-lg transition">
                Tìm kiếm
            </button>
            <a href="{{ route('nhanvien.index') }}"
                class="px-3 py-2 text-sm text-slate-600 hover:bg-slate-100 rounded-lg transition">
                Làm mới
            </a>
        </form>

        <!-- Bảng dữ liệu -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 font-semibold">
                            <th class="py-3.5 px-4">Mã NV</th>
                            <th class="py-3.5 px-4">Họ và tên</th>
                            <th class="py-3.5 px-4">Email (Nhận OTP)</th>
                            <th class="py-3.5 px-4">Chức vụ / Phòng ban</th>
                            <th class="py-3.5 px-4">Tài khoản</th>
                            <th class="py-3.5 px-4">Quyền</th>
                            <th class="py-3.5 px-4">Trạng thái</th>
                            <th class="py-3.5 px-4 text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 text-slate-700">
                        @forelse ($nhanViens as $nv)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-4 font-bold text-blue-600">{{ $nv->ma_nhan_vien }}</td>
                                <td class="py-3 px-4">
                                    <div class="font-medium text-slate-900">{{ $nv->ho_va_ten }}</div>
                                    <div class="text-xs text-slate-400">SĐT: {{ $nv->so_dien_thoai ?? '---' }}</div>
                                </td>
                                <td class="py-3 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-sky-50 text-sky-700 border border-sky-200">
                                        {{ $nv->email }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="font-medium">{{ optional($nv->chucVu)->ten_chuc_vu }}</div>
                                    <div class="text-xs text-slate-500">
                                        {{ optional(optional($nv->chucVu)->phongBan)->ten_phong }}</div>
                                </td>
                                <td class="py-3 px-4 font-mono font-semibold text-slate-800">
                                    {{ optional($nv->taiKhoan)->ten_tai_khoan ?? 'Chưa cấp' }}
                                </td>
                                <td class="py-3 px-4">
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                        {{ optional(optional($nv->taiKhoan)->phanQuyen)->ten_quyen ?? '---' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-medium {{ $nv->trang_thai === 'Dang lam viec' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                                        {{ $nv->trang_thai }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center space-x-1 whitespace-nowrap">
                                    <a href="{{ route('nhanvien.edit', $nv->ma_nhan_vien) }}"
                                        class="inline-block px-3 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                                        Sửa
                                    </a>
                                    <form action="{{ route('nhanvien.destroy', $nv->ma_nhan_vien) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Xóa nhân viên {{ $nv->ho_va_ten }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
                                            Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-8 text-center text-slate-400">Không có dữ liệu nhân viên.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
