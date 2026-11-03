<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đặt lại mật khẩu mới - HRM Project</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/css/login.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4 antialiased">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
        <!-- Header -->
        <div class="bg-emerald-600 px-6 py-5 text-center">
            <h1 class="text-xl font-bold text-white uppercase tracking-wide">Đặt Lại Mật Khẩu Mới</h1>
            <p class="text-xs text-emerald-100 mt-1">Xác thực mã OTP và thiết lập mật khẩu an toàn</p>
        </div>

        <div class="p-6 sm:p-8">
            <!-- Thông báo gửi OTP thành công -->
            @if (session('success_message'))
                <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 p-3.5 text-sm text-emerald-700 font-medium">
                    {{ session('success_message') }}
                </div>
            @endif

            <!-- Thông báo lỗi (Sai OTP, OTP hết hạn 5 phút, mật khẩu không khớp chính sách) -->
            @if ($errors->any())
                <div class="mb-5 rounded-xl bg-red-50 border border-red-200 p-3.5 text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <div class="flex items-start gap-2">
                            <span class="font-bold">•</span>
                            <span>{{ $error }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Biểu mẫu xác nhận OTP và cập nhật mật khẩu mới -->
            <form action="{{ route('password.update') }}" method="POST" class="space-y-4" novalidate>
                @csrf

                <!-- Mã OTP 6 chữ số -->
                <div>
                    <label for="ma_otp" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Mã xác thực OTP (6 chữ số)
                    </label>
                    <input type="text"
                           name="ma_otp"
                           id="ma_otp"
                           value="{{ old('ma_otp') }}"
                           maxlength="6"
                           placeholder="000000"
                           required
                           autofocus
                           class="w-full px-4 py-2.5 text-center text-xl font-bold tracking-[0.4em] text-slate-800 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                </div>

                <!-- Mật khẩu mới -->
                <div>
                    <label for="new_password" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Mật khẩu mới
                    </label>
                    <input type="password"
                           name="new_password"
                           id="new_password"
                           placeholder="Nhập mật khẩu mới..."
                           required
                           class="w-full px-4 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    <p class="text-xs text-slate-400 mt-1">
                        Tối thiểu 8 ký tự, gồm chữ hoa, chữ thường, số và ký tự đặc biệt.
                    </p>
                </div>

                <!-- Xác nhận mật khẩu mới -->
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Xác nhận mật khẩu mới
                    </label>
                    <input type="password"
                           name="new_password_confirmation"
                           id="new_password_confirmation"
                           placeholder="Nhập lại mật khẩu mới..."
                           required
                           class="w-full px-4 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                </div>

                <button type="submit"
                        class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white text-sm font-semibold rounded-xl shadow-sm transition cursor-pointer">
                    Xác nhận Đặt lại mật khẩu
                </button>
            </form>

            <!-- Gửi lại mã OTP mới -->
            <div class="mt-5 pt-4 border-t border-slate-200 flex items-center justify-between text-xs">
                <span class="text-slate-500">Chưa nhận được mã hoặc mã hết hạn?</span>
                <form action="{{ route('password.otp.resend') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="font-semibold text-emerald-600 hover:text-emerald-700 hover:underline cursor-pointer">
                        Gửi lại mã OTP
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-slate-50 px-6 py-3 border-t border-slate-200 text-center">
            <a href="{{ route('login') }}" class="text-xs font-medium text-slate-600 hover:text-slate-900">
                &larr; Hủy và quay lại Đăng nhập
            </a>
        </div>
    </div>

</body>
</html>