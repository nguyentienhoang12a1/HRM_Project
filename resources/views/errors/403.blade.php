@extends('layout.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-50 text-red-600 text-2xl font-extrabold mb-4">
            403
        </div>
        <h1 class="text-xl font-bold text-slate-800 mb-2">Từ chối truy cập</h1>
        <p class="text-sm text-slate-500 mb-6">
            {{ $message ?? 'Bạn không có quyền thực hiện thao tác hoặc truy cập vào khu vực dữ liệu này.' }}
        </p>
        <a href="{{ route('dashboard') }}"
           class="inline-block px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm transition">
            Quay về Trang chủ
        </a>
    </div>
</div>
@endsection