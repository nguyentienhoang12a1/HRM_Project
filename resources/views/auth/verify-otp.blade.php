<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực mã OTP - HRM System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
        <div class="bg-emerald-600 px-6 py-4 text-center">
            <h2 class="text-lg font-bold text-white uppercase tracking-wide">Xác thực mã OTP qua Email</h2>
        </div>

        <div class="p-6">
            @if (session('success_message'))
                <div class="mb-4 p-3 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium">
                    {{ session('success_message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-600 text-sm">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <p class="text-sm text-slate-600 mb-4">
                Vui lòng nhập mã OTP gồm <strong>6 chữ số</strong> đã được gửi đến Email của bạn. Mã có hiệu lực trong vòng <strong>5 phút</strong>.
            </p>

            <form action="{{ route('otp.verify') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="ma_otp" class="block text-sm font-semibold text-slate-700 mb-1">Mã xác thực OTP</label>
                    <input type="text" name="ma_otp" id="ma_otp" maxlength="6" required autofocus
                           placeholder="000000"
                           class="w-full px-4 py-3 text-center text-2xl font-bold tracking-[0.5em] border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <button type="submit"
                        class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow-sm transition">
                    Xác nhận OTP
                </button>
            </form>

            <div class="mt-5 pt-4 border-t border-slate-200 flex items-center justify-between text-sm">
                <span class="text-slate-500">Chưa nhận được mã?</span>
                <form action="{{ route('otp.resend') }}" method="POST">
                    @csrf
                    <button type="submit" class="font-semibold text-emerald-600 hover:text-emerald-700">
                        Gửi lại mã OTP mới
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>