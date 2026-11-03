<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Khôi phục mật khẩu - HRM Project</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/css/login.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4 antialiased">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
        <!-- Header -->
        <div class="bg-amber-500 px-6 py-5 text-center">
            <h1 class="text-xl font-bold text-white uppercase tracking-wide">Khôi Phục Mật Khẩu</h1>
            <p class="text-xs text-amber-50 mt-1">Nhận mã xác thực OTP 6 số qua Email nhân viên</p>
        </div>

        <div class="p-6 sm:p-8">
            <!-- Thông báo lỗi -->
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

            <p class="text-sm text-slate-600 mb-5 leading-relaxed">
                Nhập <strong>Tên tài khoản</strong> hoặc <strong>Email nhân viên</strong> của bạn. Hệ thống sẽ tạo mã OTP gồm 6 chữ số (hiệu lực 5 phút) và gửi tới hộp thư của bạn.
            </p>

            <!-- Biểu mẫu gửi yêu cầu OTP -->
            <form action="{{ route('password.email') }}" method="POST" class="space-y-5" novalidate>
                @csrf

                <div>
                    <label for="login_identifier" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Tên tài khoản hoặc Email
                    </label>
                    <input type="text"
                           name="login_identifier"
                           id="login_identifier"
                           value="{{ old('login_identifier') }}"
                           placeholder="Nhập tên tài khoản hoặc email..."
                           required
                           autofocus
                           class="w-full px-4 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                </div>

                <button type="submit"
                        class="w-full py-2.5 px-4 bg-amber-500 hover:bg-amber-600 active:bg-amber-700 text-white text-sm font-semibold rounded-xl shadow-sm transition cursor-pointer">
                    Gửi mã xác thực OTP
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="bg-slate-50 px-6 py-3.5 border-t border-slate-200 text-center">
            <a href="{{ route('login') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 hover:underline">
                &larr; Quay lại trang Đăng nhập
            </a>
        </div>
    </div>

</body>
</html>