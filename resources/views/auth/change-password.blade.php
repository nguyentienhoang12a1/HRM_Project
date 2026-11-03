@extends('layout.app')

@section('content')
<div class="p-6 max-w-lg mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="bg-slate-800 px-6 py-4">
            <h2 class="text-base font-bold text-white uppercase">Đổi mật khẩu cá nhân</h2>
        </div>

        <div class="p-6">
            @if (session('success_message'))
                <div class="mb-4 p-3 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium">
                    {{ session('success_message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-600 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('password.change.submit') }}" method="POST" class="space-y-4" novalidate>
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Mật khẩu mới</label>
                    <input type="password" name="new_password" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-slate-400 mt-1">Tối thiểu 8 ký tự, gồm chữ hoa, chữ thường, số và ký tự đặc biệt.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Xác nhận mật khẩu mới</label>
                    <input type="password" name="new_password_confirmation" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit"
                        class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                    Xác nhận đổi mật khẩu
                </button>
            </form>
        </div>
    </div>
</div>
@endsection