@extends('layout.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-800">Quản lý Phân quyền Truy cập</h1>
        <a href="{{ route('nhanvien.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50">
            Quản lý Nhân viên
        </a>
    </div>

    @if (session('success_message'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium">
            {{ session('success_message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
            @foreach ($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    @foreach ($accounts as $acc)
        <form id="role-form-{{ $acc->id }}" action="{{ route('admin.roles.update', $acc->id) }}" method="POST">
            @csrf
            @method('PUT')
        </form>
    @endforeach

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 font-semibold">
                        <th class="py-3 px-4">Mã NV</th>
                        <th class="py-3 px-4">Tài khoản & Nhân viên</th>
                        <th class="py-3 px-4">Chức vụ & Phòng ban</th>
                        <th class="py-3 px-4">Quyền hệ thống</th>
                        <th class="py-3 px-4">Trạng thái</th>
                        <th class="py-3 px-4 text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($accounts as $acc)
                    <tr class="hover:bg-slate-50/70">
                        <td class="py-3 px-4 font-bold text-slate-700">{{ $acc->ma__nhan_vien }}</td>
                        <td class="py-3 px-4">
                            <div class="font-bold text-blue-600">{{ $acc->ten_tai_khoan }}</div>
                            <div class="text-slate-800">{{ optional($acc->nhanVien)->ho_va_ten }}</div>
                            <div class="text-xs text-slate-400">{{ optional($acc->nhanVien)->email }}</div>
                        </td>
                        <td class="py-3 px-4">
                            <select name="ma_chuc_vu" form="role-form-{{ $acc->id }}" class="w-full px-2.5 py-1.5 text-sm border border-slate-300 rounded-lg">
                                @foreach ($chucVus as $cv)
                                    <option value="{{ $cv->ma_chuc_vu }}" @selected(optional($acc->nhanVien)->ma_chuc_vu === $cv->ma_chuc_vu)>
                                        {{ $cv->ten_chuc_vu }} - {{ optional($cv->phongBan)->ten_phong }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="py-3 px-4">
                            <select name="ma_quyen" form="role-form-{{ $acc->id }}" class="w-full px-2.5 py-1.5 text-sm border border-slate-300 rounded-lg">
                                @foreach ($phanQuyens as $pq)
                                    <option value="{{ $pq->ma_quyen }}" @selected($acc->ma_quyen === $pq->ma_quyen)>
                                        {{ $pq->ten_quyen }} ({{ $pq->mo_ta }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="py-3 px-4">
                            @php $tt = optional($acc->nhanVien)->trang_thai ?? 'Dang lam viec'; @endphp
                            <select name="trang_thai" form="role-form-{{ $acc->id }}" class="w-full px-2.5 py-1.5 text-sm border border-slate-300 rounded-lg">
                                <option value="Dang lam viec" @selected($tt === 'Dang lam viec')>Đang làm việc</option>
                                <option value="Thu viec" @selected($tt === 'Thu viec')>Thử việc</option>
                                <option value="Khoa" @selected($tt === 'Khoa')>Tạm khóa</option>
                                <option value="Nghi viec" @selected($tt === 'Nghi viec')>Nghỉ việc</option>
                            </select>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <button type="submit" form="role-form-{{ $acc->id }}"
                                    class="px-3.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition">
                                Lưu thay đổi
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection