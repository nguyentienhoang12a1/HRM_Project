<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Đăng nhập - Hệ thống quản lí nhân viên LiHKh</title>
    <!-- Tailwind CSS CDN with forms plugin -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            500: '#2563eb',
                            600: '#1d4ed8',
                            700: '#1e40af',
                            800: '#1e3a8a',
                            900: '#172554'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Custom Style for fine-tuned layout and background styling -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="bg-[#eaf1fb] text-slate-800 min-h-screen flex items-center justify-center p-0 m-0 font-sans select-none overflow-x-hidden">
    <!-- BEGIN: MainContainer -->
    <main class="w-full min-h-screen flex flex-col lg:flex-row bg-[#ebf3fd]" data-purpose="login-split-container">
        <!-- BEGIN: LeftHeroSection -->
        <section class="relative lg:w-1/2 min-h-[680px] lg:min-h-screen flex flex-col justify-between overflow-hidden bg-white" data-purpose="hero-overview">
            <!-- Realistic Office Background Layer with subtle brightness filter -->
            <div class="absolute inset-0 z-0">
                <img alt="LiHKh Office Workspace" class="w-full h-full object-cover object-left" src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&amp;fit=crop&amp;w=1600&amp;q=80">
                <!-- Subtle gradient overlay to boost text contrast and recreate soft lighting -->
                <div class="absolute inset-0 bg-gradient-to-b from-white/95 via-white/70 to-white/20 pointer-events-none"></div>
            </div>
            <!-- Top Branding and Slogan Area -->
            <div class="relative z-10 p-8 sm:p-12 lg:p-14">
                <!-- Logo Header -->
                <div class="flex items-center gap-3.5 mb-8" data-purpose="brand-logo">
                    <!-- Stylized LiHKh Icon -->
                    <div class="w-11 h-11 flex-shrink-0 flex items-center justify-center text-blue-600">
                        <svg class="w-full h-full" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 6C11.7909 6 10 7.79086 10 10V32C10 37.5228 14.4772 42 20 42C23.3137 42 26 39.3137 26 36V22C26 19.7909 24.2091 18 22 18C19.7909 18 18 19.7909 18 22V32C18 33.1046 17.1046 34 16 34C14.8954 34 14 33.1046 14 32V10C14 7.79086 12.2091 6 10 6" fill="currentColor"></path>
                            <path d="M34 42C36.2091 42 38 40.2091 38 38V16C38 10.4772 33.5228 6 28 6C24.6863 6 22 8.68629 22 12V26C22 28.2091 23.7909 30 26 30C28.2091 30 30 28.2091 30 26V16C30 14.8954 30.8954 14 32 14C33.1046 14 34 14.8954 34 16V38C34 40.2091 35.7909 42 38 42" fill="#2563EB"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 leading-none">LiHKh</h1>
                        <p class="text-xs font-semibold text-slate-600 tracking-wider mt-1">Together for a Better Tomorrow</p>
                    </div>
                </div>
                <!-- System Title & Key Values -->
                <div class="max-w-xl">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#11244e] tracking-tight leading-[1.18] mb-4">
                        Hệ thống quản lí<br>nhân viên công ty
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base font-medium flex items-center flex-wrap gap-2">
                        <span class="">Quản lý hiệu quả</span>
                        <span class="text-slate-400 font-bold">•</span>
                        <span class="">Kết nối đội ngũ</span>
                        <span class="text-slate-400 font-bold">•</span>
                        <span class="">Phát triển bền vững</span>
                    </p>
                </div>
            </div>
            <!-- Mid Decorative Wall Quote -->
            <div class="relative z-10 px-8 sm:px-12 lg:px-14 self-end text-right hidden sm:block pointer-events-none mt-auto mb-16 mr-6">
                <div class="script-font text-slate-600/90 text-2xl sm:text-3xl leading-snug tracking-wide select-none drop-shadow-sm">
                    Great<br>People<br>Build<br>Great<br>Things
                </div>
            </div>
            <!-- Bottom Feature Banner with Dynamic Curved Wave -->
            <div class="relative z-20 mt-auto" data-purpose="features-bar">
                <!-- SVG Wave Transition -->
                <div class="w-full overflow-hidden leading-none -mb-1">
                    <svg class="w-full h-12 sm:h-16 text-blue-600 fill-current preserve-3d" preserveAspectRatio="none" viewBox="0 0 1200 120">
                        <path d="M0,0 C250,90 450,15 700,60 C950,105 1100,30 1200,45 L1200,120 L0,120 Z"></path>
                    </svg>
                </div>
                <!-- 4 Key Modules Strip -->
                <div class="bg-blue-600 text-white px-6 sm:px-10 py-6">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-4xl mx-auto items-center">
                        <!-- Feature 1 -->
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-white/10 flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm font-medium leading-tight">Quản lý<br>nhân sự</span>
                        </div>
                        <!-- Feature 2 -->
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-white/10 flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2zm7-7a2 2 0 100-4 2 2 0 000 4z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm font-medium leading-tight">Chấm công<br>&amp; nghỉ phép</span>
                        </div>
                        <!-- Feature 3 -->
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-white/10 flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm font-medium leading-tight">Báo cáo<br>dữ liệu</span>
                        </div>
                        <!-- Feature 4 -->
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-white/10 flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm font-medium leading-tight">Phân quyền<br>an toàn</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END: LeftHeroSection -->
        <!-- BEGIN: RightAuthSection -->
        <section class="lg:w-1/2 flex items-center justify-center p-6 sm:p-10 lg:p-16 bg-[#ebf3fd]" data-purpose="login-form-wrapper">
            <!-- Login Card -->
            <div class="w-full max-w-lg bg-white rounded-3xl shadow-[0_15px_45px_-10px_rgba(30,64,175,0.1)] p-8 sm:p-12 border border-blue-50/50 flex flex-col justify-between" data-purpose="login-card">
                <div>
                    <!-- Logo in Form -->
                    <div class="flex flex-col items-center justify-center mb-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 flex-shrink-0 text-blue-600">
                                <svg class="w-full h-full" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 6C11.7909 6 10 7.79086 10 10V32C10 37.5228 14.4772 42 20 42C23.3137 42 26 39.3137 26 36V22C26 19.7909 24.2091 18 22 18C19.7909 18 18 19.7909 18 22V32C18 33.1046 17.1046 34 16 34C14.8954 34 14 33.1046 14 32V10C14 7.79086 12.2091 6 10 6" fill="currentColor"></path>
                                    <path d="M34 42C36.2091 42 38 40.2091 38 38V16C38 10.4772 33.5228 6 28 6C24.6863 6 22 8.68629 22 12V26C22 28.2091 23.7909 30 26 30C28.2091 30 30 28.2091 30 26V16C30 14.8954 30.8954 14 32 14C33.1046 14 34 14.8954 34 16V38C34 40.2091 35.7909 42 38 42" fill="#2563EB"></path>
                                </svg>
                            </div>
                            <span class="text-3xl font-extrabold tracking-tight text-slate-900">LiHKh</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 text-center tracking-tight">Chào mừng bạn trở lại!</h3>
                        
                        {{-- Thông báo lỗi Session --}}
                        @if (session('error'))
                            <div class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Thông báo thành công --}}
                        @if (session('success'))
                            <div class="mb-4 p-3 rounded-xl bg-green-50 border border-green-200 text-green-600 text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        <p class="text-sm text-slate-500 text-center mt-1.5 font-normal">Vui lòng đăng nhập để tiếp tục sử dụng hệ thống</p>
                    </div>
                    <!-- Login Form Elements -->
                    <form class="space-y-4"
                            data-purpose="credential-form"
                            action="{{ route('login.submit') }}"
                            method="POST">

                            @csrf
                        <!-- Username Input -->
                        <div>
                            <label class="sr-only" for="username">Tên đăng nhập</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path>
                                    </svg>
                                </div>
                                {{-- dữ lại tài khoản khi đăng nhập sai --}}
                                <input
                                    class="block w-full pl-11 pr-4 py-3.5 bg-white text-sm text-slate-800 border border-slate-200 rounded-xl"
                                    id="username"
                                    name="username"
                                    value="{{ old('username') }}"
                                    placeholder="Tên đăng nhập"
                                    type="text"
                                >
                                {{-- Hiển thị báo lỗi --}}
                                @if ($errors->has('username'))
                                    <p class="text-sm text-red-500 mt-2">
                                        {{ $errors->first('username') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <!-- Password Input -->
                        <div>
                            <label class="sr-only" for="password">Mật khẩu</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path>
                                    </svg>
                                </div>
                                {{-- dữ lại mk khi đăng nhập sai --}}
                                <input
                                    class="block w-full pl-11 pr-11 py-3.5 bg-white text-sm text-slate-800 border border-slate-200 rounded-xl"
                                    id="password"
                                    name="password"
                                    placeholder="Mật khẩu"
                                    type="password"
                                >
                                {{-- Hiển thị báo lỗi --}}
                                @if ($errors->has('password'))
                                    <p class="text-sm text-red-500 mt-2">
                                        {{ $errors->first('password') }}
                                    </p>
                                @endif

                                <!-- Eye icon for password toggle -->
                                <button aria-label="Ẩn hiện mật khẩu" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition" id="togglePassword" type="button">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- Remember me & Forgot Password -->
                        <div class="flex items-center justify-between pt-1 pb-1">
                            <label class="flex items-center space-x-2.5 cursor-pointer">
                                <input checked="" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 transition cursor-pointer" type="checkbox">
                                <span class="text-sm text-slate-700 font-medium">Ghi nhớ đăng nhập</span>
                            </label>
                            <a class="text-sm font-medium text-blue-600 hover:text-blue-700 transition" href="#">
                                Quên mật khẩu?
                            </a>
                        </div>
                        <!-- Primary Submit Button -->
                        <div>
                            <button class="w-full flex items-center justify-center gap-2 py-3.5 px-4 text-base font-semibold rounded-xl text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 transition duration-150 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="submit">
                                <span class="">Đăng nhập</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <!-- Divider -->
                    <div class="relative my-7">
                        <div class="absolute inset-0 flex items-center">


                            <!-- Card Footer -->
                            <footer class="mt-8 text-center" data-purpose="copyright">
                                <p class="text-xs text-slate-500 font-normal">
                                    © 2025 LiHKh. All rights reserved.
                                </p>
                            </footer>
                        </div>
        </section>
        <!-- END: RightAuthSection -->
    </main>
    <!-- END: MainContainer -->
    <!-- BEGIN: InteractiveScripts -->
    <script src="{{ asset('js/login.js') }}"></script>
    <!-- END: InteractiveScripts -->


</body>

</html>