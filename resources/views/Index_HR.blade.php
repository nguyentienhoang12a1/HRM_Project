<!DOCTYPE html>

<html lang="vi"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>LiHKH - Hệ thống quản lý nhân viên</title>
<!-- Tailwind CSS v3 -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Google Fonts: Inter -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;family=Caveat:wght@600;700&amp;display=swap" rel="stylesheet"/>
<script>
    tailwind.config = {
    theme: {
    extend: {
        fontFamily: {
        sans: ['Inter', 'sans-serif'],
        handwriting: ['Caveat', 'cursive'],
        },
        colors: {
        brand: {
            50: '#eef6ff',
            100: '#d9eaff',
            500: '#2563eb',
            600: '#1d5bd8',
            700: '#1e40af',
        }
        }
    }
    }
}
</script>
<!-- Custom Styles for Scrollbars & Watermark -->
<link rel="stylesheet" href="{{ asset('css/Index_HR.css') }}">
</head>
<body class="min-h-screen flex flex-col font-sans text-slate-700 antialiased selection:bg-blue-100 selection:text-blue-700">
<!-- BEGIN: TopHeader -->
<header class="h-16 bg-white border-b border-slate-200/80 px-6 flex items-center justify-between sticky top-0 z-40 shadow-sm" data-purpose="top-navigation">
<!-- Brand Logo Section -->
<div class="flex items-center gap-3 w-60 shrink-0">
<div class="flex items-center gap-2">
<svg class="w-8 h-8 text-blue-600" fill="none" viewbox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
<path d="M12 6C8.68629 6 6 8.68629 6 12V24C6 27.3137 8.68629 30 12 30H16C17.1046 30 18 29.1046 18 28V12C18 8.68629 15.3137 6 12 6Z" fill="#2563EB"></path>
<path d="M28 34C31.3137 34 34 31.3137 34 28V16C34 12.6863 31.3137 10 28 10H24C22.8954 10 22 10.8954 22 12V28C22 31.3137 24.6863 34 28 34Z" fill="#38BDF8"></path>
</svg>
<span class="text-2xl font-bold tracking-tight text-slate-800">LiHKH</span>
</div>
</div>
<!-- Search Input -->
<div class="flex-1 max-w-xl px-4">
<div class="relative w-full">
<span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</span>
<input class="w-full pl-10 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all placeholder:text-slate-400" placeholder="Tìm kiếm nhân viên, phòng ban, chức vụ..." type="text"/>
</div>
</div>
<!-- User Profile & Notifications -->
<div class="flex items-center gap-5">
<!-- Notification Icon with Badge -->
<button class="relative p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-full transition-colors" title="Thông báo">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
<span class="absolute top-1 right-1 flex items-center justify-center min-w-[16px] h-4 px-1 text-[10px] font-bold text-white bg-red-500 rounded-full border-2 border-white">
          3
        </span>
</button>
<!-- User Card -->
<div class="flex items-center gap-3 pl-3 border-l border-slate-200 cursor-pointer group">
<div class="w-9 h-9 rounded-full ring-2 ring-blue-500/20 overflow-hidden bg-slate-100">
<img alt="Nguyễn Thị Linh" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAetwE3wB2yePZ85YUZcLqla2sjddVPLBxHtPtkUYDAKrbOvhwn08LrEv6fHURT37RJCZKDNS7mi5uFAOe2ay5lTSK31KrANBWzGKdJoKwgFfMwuwPXmJgb-ll2zq06ZukjNT0xrL3_y63b8E8S0KCZVldg1dgJzztLo5CA3LHJikI5qMj98vozlCMDj5YcSPnKD2bD3ZRJ77crg9d7Qokf4ozdyhdCmS9yI2xogV_m"/>
</div>
<div class="flex flex-col text-left">
<span class="text-xs font-semibold text-slate-800 group-hover:text-blue-600 transition-colors">Nguyễn Thị Linh</span>
<span class="text-[11px] text-slate-400 font-medium">Admin</span>
</div>
<svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-slate-600 transition-colors ml-0.5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="m19.5 8.25-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
</div>
</header>
<!-- END: TopHeader -->
<div class="flex flex-1 overflow-hidden">
<!-- BEGIN: LeftSidebar -->
<aside class="w-60 bg-white border-r border-slate-200/80 flex flex-col justify-between p-4 shrink-0 relative overflow-hidden" data-purpose="sidebar-navigation">
<!-- Navigation Links -->
<nav class="space-y-1.5 relative z-10">
<!-- Active Link -->
<a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-white bg-blue-600 shadow-md shadow-blue-500/25 transition-all" href="#">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
          Trang chủ
        </a>
<!-- Inactive Links -->
<a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-colors" href="#">
<svg class="w-5 h-5 text-slate-400 group-hover:text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
          Nhân viên
        </a>
<a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-colors" href="#">
<svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
          Phòng ban
        </a>
<a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-colors" href="#">
<svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
          Chấm công
        </a>
<a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-colors" href="#">
<svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
          Lương &amp; Phúc lợi
        </a>
<a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-colors" href="#">
<svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
          Hợp đồng
        </a>
<a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-colors" href="#">
<svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
          Đánh giá
        </a>
<a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-colors" href="#">
<svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
          Báo cáo
        </a>
<a class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-colors" href="#">
<svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.38.138.75.43 1 .294.241.62.585 1.004.827.424.27.534.819.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.6 6.6 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.216.456a1.125 1.125 0 0 1-1.37-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-1l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
          Cài đặt
        </a>
</nav>
<!-- Watermark Art Typography at Sidebar Bottom -->
<div class="relative pt-12 pb-4 text-center select-none pointer-events-none opacity-40">
<div class="font-handwriting text-3xl font-bold text-blue-700 leading-tight tracking-wide -rotate-6">
          Great<br/>People<br/>Build<br/>Great<br/>Things
        </div>
</div>
</aside>
<!-- END: LeftSidebar -->
<!-- BEGIN: MainContentAndRightSidebar -->
<div class="flex-1 flex overflow-y-auto">
<!-- Center Main Section -->
<main class="flex-1 p-6 space-y-6 overflow-x-hidden" data-purpose="main-dashboard-content">
<!-- BEGIN: WelcomeBanner -->
<section class="relative rounded-2xl overflow-hidden border border-blue-100 shadow-sm" data-purpose="welcome-banner">
<!-- Background image layer with modern office setting -->
<div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDwm-f0HBTTdcx7OTxp3cfSITCBLowJWnDhJ7UTHzlL15i3fW5QYJLeyBcYJ4mCzAKEpSZB7iOSN6Ru5cKN0Cw1dIlvGRDh5elzekvxqJNdIG67xCpzcVbbnqlrJHYRJdvPCGsTQCdkrkNbHgxIyL2laweTHhgfEyh6nfYc2nfG9OUnL4YxYw6HqwFo-Y-zPOBEjKvIrE4_0IKVyfuIN8uHjziD4x6pikwWAPCn9kMa');">
</div>
<!-- Semi-transparent gradient overlay to ensure text contrast matching snapshot -->
<div class="absolute inset-0 bg-gradient-to-r from-blue-50/95 via-sky-50/85 to-white/30 backdrop-blur-[1px]"></div>
<div class="relative z-10 p-7 flex items-center justify-between min-h-[175px]">
<div class="max-w-xl space-y-2">
<!-- Logo & Title -->
<div class="flex items-center gap-2 mb-1">
<svg class="w-6 h-6 text-blue-600" fill="none" viewbox="0 0 40 40">
<path d="M12 6C8.68629 6 6 8.68629 6 12V24C6 27.3137 8.68629 30 12 30H16C17.1046 30 18 29.1046 18 28V12C18 8.68629 15.3137 6 12 6Z" fill="#2563EB"></path>
<path d="M28 34C31.3137 34 34 31.3137 34 28V16C34 12.6863 31.3137 10 28 10H24C22.8954 10 22 10.8954 22 12V28C22 31.3137 24.6863 34 28 34Z" fill="#38BDF8"></path>
</svg>
<span class="text-xl font-bold tracking-tight text-slate-800">LiHKH</span>
</div>
<h1 class="text-2xl font-bold text-slate-900 tracking-tight">Xin chào, Nguyễn Thị Linh!</h1>
<p class="text-xs md:text-sm text-slate-600 leading-relaxed font-normal">
                Chào mừng bạn quay trở lại hệ thống quản lý nhân viên.<br/>
                Cùng xây dựng một môi trường làm việc hiệu quả và phát triển bền vững!
              </p>
</div>
<!-- Decorative Slogan on Banner Right -->
<div class="hidden md:block pr-6 select-none opacity-85">
<div class="font-handwriting text-3xl font-bold text-slate-700 leading-tight text-right -rotate-2">
                Great<br/>People<br/>Build<br/>Great<br/>Things
              </div>
</div>
</div>
</section>
<!-- END: WelcomeBanner -->
<!-- BEGIN: KPIStatsCards -->
<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4.5" data-purpose="stat-metrics">
<!-- Card 1: Tổng số nhân viên -->
<div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
<div class="flex items-center gap-3.5 mb-2.5">
<div class="w-10 h-10 rounded-xl bg-blue-100/70 text-blue-600 flex items-center justify-center shrink-0">
<svg class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20">
<path d="M9 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM17 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 0 0-1.5-4.33A5 5 0 0 1 19 16v1h-6.07ZM6 11a5 5 0 0 1 5 5v1H1v-1a5 5 0 0 1 5-5Z"></path>
</svg>
</div>
<span class="text-xs font-medium text-slate-500">Tổng số nhân viên</span>
</div>
<div>
<div class="text-2xl font-bold text-slate-800 tracking-tight">128</div>
<div class="mt-1 flex items-center text-[11px] text-emerald-600 font-semibold gap-1">
<span>↑ 12%</span>
<span class="text-slate-400 font-normal">so với tháng trước</span>
</div>
</div>
</div>
<!-- Card 2: Nhân viên đang làm việc -->
<div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
<div class="flex items-center gap-3.5 mb-2.5">
<div class="w-10 h-10 rounded-xl bg-indigo-100/70 text-indigo-600 flex items-center justify-center shrink-0">
<svg class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20">
<path d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-7 9a7 7 0 1 1 14 0H3Z"></path>
</svg>
</div>
<span class="text-xs font-medium text-slate-500">Nhân viên đang làm việc</span>
</div>
<div>
<div class="text-2xl font-bold text-slate-800 tracking-tight">118</div>
<div class="mt-1 flex items-center text-[11px] text-emerald-600 font-semibold gap-1">
<span>↑ 10%</span>
<span class="text-slate-400 font-normal">so với tháng trước</span>
</div>
</div>
</div>
<!-- Card 3: Hợp đồng sắp hết hạn -->
<div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
<div class="flex items-center gap-3.5 mb-2.5">
<div class="w-10 h-10 rounded-xl bg-teal-100/70 text-teal-600 flex items-center justify-center shrink-0">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<span class="text-xs font-medium text-slate-500">Hợp đồng sắp hết hạn</span>
</div>
<div>
<div class="text-2xl font-bold text-slate-800 tracking-tight">5</div>
<div class="mt-1 flex items-center text-[11px] text-rose-500 font-semibold gap-1">
<span>↑ 2%</span>
<span class="text-slate-400 font-normal">so với tháng trước</span>
</div>
</div>
</div>
<!-- Card 4: Ngày nghỉ hôm nay -->
<div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
<div class="flex items-center gap-3.5 mb-2.5">
<div class="w-10 h-10 rounded-xl bg-amber-100/70 text-amber-600 flex items-center justify-center shrink-0">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<span class="text-xs font-medium text-slate-500">Ngày nghỉ hôm nay</span>
</div>
<div>
<div class="text-2xl font-bold text-slate-800 tracking-tight">3</div>
<div class="mt-1 flex items-center text-[11px] text-emerald-600 font-semibold gap-1">
<span>↓ 25%</span>
<span class="text-slate-400 font-normal">so với tháng trước</span>
</div>
</div>
</div>
</section>
<!-- END: KPIStatsCards -->
<!-- BEGIN: ChartsSection -->
<section class="grid grid-cols-1 lg:grid-cols-12 gap-6" data-purpose="charts-row">
<!-- Chart Left: Tổng quan nhân sự (Line chart) -->
<div class="lg:col-span-6 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
<div class="flex items-center justify-between mb-4">
<h2 class="text-sm font-bold text-slate-800">Tổng quan nhân sự</h2>
<!-- Range filter -->
<div class="relative">
<select class="text-xs font-medium text-slate-600 bg-slate-50 border border-slate-200 rounded-lg py-1.5 pl-2.5 pr-7 appearance-none focus:outline-none focus:ring-1 focus:ring-blue-500">
<option>6 tháng gần đây</option>
<option>Năm nay</option>
</select>
<div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="m19.5 8.25-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
</div>
</div>
<!-- SVG Visual Line Chart with realistic axes & data points -->
<div class="relative h-56 w-full pt-2">
<svg class="w-full h-full overflow-visible" preserveaspectratio="none" viewbox="0 0 500 200">
<!-- Horizontal Grid Lines -->
<line stroke="#f1f5f9" stroke-width="1" x1="35" x2="490" y1="20" y2="20"></line>
<line stroke="#f1f5f9" stroke-width="1" x1="35" x2="490" y1="55" y2="55"></line>
<line stroke="#f1f5f9" stroke-width="1" x1="35" x2="490" y1="90" y2="90"></line>
<line stroke="#f1f5f9" stroke-width="1" x1="35" x2="490" y1="125" y2="125"></line>
<line stroke="#f1f5f9" stroke-width="1" x1="35" x2="490" y1="160" y2="160"></line>
<!-- Y Axis Labels -->
<text fill="#94a3b8" font-size="10" text-anchor="end" x="25" y="24">150</text>
<text fill="#94a3b8" font-size="10" text-anchor="end" x="25" y="59">120</text>
<text fill="#94a3b8" font-size="10" text-anchor="end" x="25" y="94">90</text>
<text fill="#94a3b8" font-size="10" text-anchor="end" x="25" y="129">60</text>
<text fill="#94a3b8" font-size="10" text-anchor="end" x="25" y="164">30</text>
<text fill="#94a3b8" font-size="10" text-anchor="end" x="25" y="195">0</text>
<!-- Area fill for line 1 -->
<defs>
<lineargradient id="areaGradient" x1="0" x2="0" y1="0" y2="1">
<stop offset="0%" stop-color="#3b82f6" stop-opacity="0.15"></stop>
<stop offset="100%" stop-color="#3b82f6" stop-opacity="0.0"></stop>
</lineargradient>
</defs>
<path d="M 50,110 L 130,95 L 210,80 L 290,72 L 370,62 L 460,48 L 460,195 L 50,195 Z" fill="url(#areaGradient)"></path>
<!-- Line 1: Tổng nhân viên (Blue) -->
<path d="M 50,110 L 130,95 L 210,80 L 290,72 L 370,62 L 460,48" fill="none" stroke="#2563eb" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
<!-- Circles on line 1 -->
<circle cx="50" cy="110" fill="#2563eb" r="3.5"></circle>
<circle cx="130" cy="95" fill="#2563eb" r="3.5"></circle>
<circle cx="210" cy="80" fill="#2563eb" r="3.5"></circle>
<circle cx="290" cy="72" fill="#2563eb" r="3.5"></circle>
<circle cx="370" cy="62" fill="#2563eb" r="3.5"></circle>
<circle cx="460" cy="48" fill="#2563eb" r="3.5"></circle>
<!-- Line 2: Nhân viên mới (Light Blue) -->
<path d="M 50,150 L 130,140 L 210,132 L 290,118 L 370,110 L 460,95" fill="none" stroke="#38bdf8" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
<!-- Circles on line 2 -->
<circle cx="50" cy="150" fill="#38bdf8" r="3"></circle>
<circle cx="130" cy="140" fill="#38bdf8" r="3"></circle>
<circle cx="210" cy="132" fill="#38bdf8" r="3"></circle>
<circle cx="290" cy="118" fill="#38bdf8" r="3"></circle>
<circle cx="370" cy="110" fill="#38bdf8" r="3"></circle>
<circle cx="460" cy="95" fill="#38bdf8" r="3"></circle>
<!-- X Axis Labels -->
<text fill="#94a3b8" font-size="10" text-anchor="middle" x="50" y="195">Tháng 1</text>
<text fill="#94a3b8" font-size="10" text-anchor="middle" x="130" y="195">Tháng 2</text>
<text fill="#94a3b8" font-size="10" text-anchor="middle" x="210" y="195">Tháng 3</text>
<text fill="#94a3b8" font-size="10" text-anchor="middle" x="290" y="195">Tháng 4</text>
<text fill="#94a3b8" font-size="10" text-anchor="middle" x="370" y="195">Tháng 5</text>
<text fill="#94a3b8" font-size="10" text-anchor="middle" x="460" y="195">Tháng 6</text>
</svg>
</div>
<!-- Legend -->
<div class="flex items-center justify-center gap-6 mt-3 text-xs text-slate-500 font-medium">
<div class="flex items-center gap-2">
<span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
<span>Tổng nhân viên</span>
</div>
<div class="flex items-center gap-2">
<span class="w-2.5 h-2.5 rounded-full bg-sky-400"></span>
<span>Nhân viên mới</span>
</div>
</div>
</div>
<!-- Chart Right: Cơ cấu nhân sự theo phòng ban (Donut Chart) -->
<div class="lg:col-span-6 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
<h2 class="text-sm font-bold text-slate-800 mb-2">Cơ cấu nhân sự theo phòng ban</h2>
<div class="flex items-center justify-between gap-4 py-2">
<!-- Donut Chart representation -->
<div class="relative w-44 h-44 shrink-0 flex items-center justify-center">
<svg class="w-full h-full -rotate-90" viewbox="0 0 100 100">
<!-- Background ring -->
<circle cx="50" cy="50" fill="none" r="38" stroke="#f1f5f9" stroke-width="14"></circle>
<!-- Kinh doanh (32.8%) = 78.4 -->
<circle cx="50" cy="50" fill="none" r="38" stroke="#2563eb" stroke-dasharray="78.4 238.7" stroke-dashoffset="0" stroke-width="14"></circle>
<!-- Khác (23.4%) = 56.0 -->
<circle cx="50" cy="50" fill="none" r="38" stroke="#94a3b8" stroke-dasharray="56 238.7" stroke-dashoffset="-78.4" stroke-width="14"></circle>
<!-- Marketing (14.1%) = 33.6 -->
<circle cx="50" cy="50" fill="none" r="38" stroke="#38bdf8" stroke-dasharray="33.6 238.7" stroke-dashoffset="-134.4" stroke-width="14"></circle>
<!-- Kế toán (12.5%) = 29.8 -->
<circle cx="50" cy="50" fill="none" r="38" stroke="#22c55e" stroke-dasharray="29.8 238.7" stroke-dashoffset="-168" stroke-width="14"></circle>
<!-- Nhân sự (9.4%) = 22.4 -->
<circle cx="50" cy="50" fill="none" r="38" stroke="#f59e0b" stroke-dasharray="22.4 238.7" stroke-dashoffset="-197.8" stroke-width="14"></circle>
<!-- IT (7.8%) = 18.6 -->
<circle cx="50" cy="50" fill="none" r="38" stroke="#8b5cf6" stroke-dasharray="18.6 238.7" stroke-dashoffset="-220.2" stroke-width="14"></circle>
</svg>
<!-- Inner Center text -->
<div class="absolute inset-0 flex flex-col items-center justify-center text-center pointer-events-none">
<span class="text-xl font-bold text-slate-800 leading-tight">128</span>
<span class="text-[11px] text-slate-400 font-medium">nhân viên</span>
</div>
</div>
<!-- Breakdown Category List -->
<div class="flex-1 space-y-2 text-xs">
<!-- Kinh doanh -->
<div class="flex items-center justify-between text-slate-600">
<div class="flex items-center gap-2">
<span class="w-2.5 h-2.5 rounded-full bg-blue-600 shrink-0"></span>
<span>Kinh doanh</span>
</div>
<span class="font-semibold text-slate-800">42 <span class="font-normal text-slate-400 text-[11px]">(32.8%)</span></span>
</div>
<!-- Marketing -->
<div class="flex items-center justify-between text-slate-600">
<div class="flex items-center gap-2">
<span class="w-2.5 h-2.5 rounded-full bg-sky-400 shrink-0"></span>
<span>Marketing</span>
</div>
<span class="font-semibold text-slate-800">18 <span class="font-normal text-slate-400 text-[11px]">(14.1%)</span></span>
</div>
<!-- Kế toán -->
<div class="flex items-center justify-between text-slate-600">
<div class="flex items-center gap-2">
<span class="w-2.5 h-2.5 rounded-full bg-green-500 shrink-0"></span>
<span>Kế toán</span>
</div>
<span class="font-semibold text-slate-800">16 <span class="font-normal text-slate-400 text-[11px]">(12.5%)</span></span>
</div>
<!-- Nhân sự -->
<div class="flex items-center justify-between text-slate-600">
<div class="flex items-center gap-2">
<span class="w-2.5 h-2.5 rounded-full bg-amber-500 shrink-0"></span>
<span>Nhân sự</span>
</div>
<span class="font-semibold text-slate-800">12 <span class="font-normal text-slate-400 text-[11px]">(9.4%)</span></span>
</div>
<!-- IT -->
<div class="flex items-center justify-between text-slate-600">
<div class="flex items-center gap-2">
<span class="w-2.5 h-2.5 rounded-full bg-purple-500 shrink-0"></span>
<span>IT</span>
</div>
<span class="font-semibold text-slate-800">10 <span class="font-normal text-slate-400 text-[11px]">(7.8%)</span></span>
</div>
<!-- Khác -->
<div class="flex items-center justify-between text-slate-600">
<div class="flex items-center gap-2">
<span class="w-2.5 h-2.5 rounded-full bg-slate-400 shrink-0"></span>
<span>Khác</span>
</div>
<span class="font-semibold text-slate-800">30 <span class="font-normal text-slate-400 text-[11px]">(23.4%)</span></span>
</div>
</div>
</div>
</div>
</section>
<!-- END: ChartsSection -->
<!-- BEGIN: BottomListsSection -->
<section class="grid grid-cols-1 lg:grid-cols-12 gap-6" data-purpose="recent-data-tables">
<!-- Recent Activities List -->
<div class="lg:col-span-6 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
<div class="flex items-center justify-between mb-4">
<h2 class="text-sm font-bold text-slate-800">Hoạt động gần đây</h2>
<a class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1 group" href="#">
                Xem tất cả
                <span class="group-hover:translate-x-0.5 transition-transform">→</span>
</a>
</div>
<div class="space-y-3.5">
<!-- Item 1 -->
<div class="flex items-center justify-between text-xs py-1">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
<svg class="w-4 h-4" fill="currentColor" viewbox="0 0 20 20">
<path d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-7 9a7 7 0 1 1 14 0H3Z"></path>
</svg>
</div>
<p class="text-slate-600 truncate max-w-xs md:max-w-sm">
<strong class="font-semibold text-slate-800">Nguyễn Văn A</strong> đã được thêm vào phòng ban <span class="font-medium text-slate-700">Kinh doanh</span>
</p>
</div>
<span class="text-[11px] text-slate-400 shrink-0">2 giờ trước</span>
</div>
<!-- Item 2 -->
<div class="flex items-center justify-between text-xs py-1">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<p class="text-slate-600 truncate max-w-xs md:max-w-sm">
<strong class="font-semibold text-slate-800">Trần Thị Bích</strong> đã hoàn thành chấm công
                  </p>
</div>
<span class="text-[11px] text-slate-400 shrink-0">3 giờ trước</span>
</div>
<!-- Item 3 -->
<div class="flex items-center justify-between text-xs py-1">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<p class="text-slate-600 truncate max-w-xs md:max-w-sm">
                    Hợp đồng của <strong class="font-semibold text-slate-800">Lê Minh C</strong> sẽ hết hạn trong 5 ngày
                  </p>
</div>
<span class="text-[11px] text-slate-400 shrink-0">5 giờ trước</span>
</div>
<!-- Item 4 -->
<div class="flex items-center justify-between text-xs py-1">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<p class="text-slate-600 truncate max-w-xs md:max-w-sm">
<strong class="font-semibold text-slate-800">Phạm Thị D</strong> đã cập nhật thông tin cá nhân
                  </p>
</div>
<span class="text-[11px] text-slate-400 shrink-0">6 giờ trước</span>
</div>
<!-- Item 5 -->
<div class="flex items-center justify-between text-xs py-1">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<p class="text-slate-600 truncate max-w-xs md:max-w-sm">
<strong class="font-semibold text-slate-800">Báo cáo tháng 6</strong> đã được tạo thành công
                  </p>
</div>
<span class="text-[11px] text-slate-400 shrink-0">8 giờ trước</span>
</div>
</div>
</div>
<!-- New Employees List -->
<div class="lg:col-span-6 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
<div class="flex items-center justify-between mb-4">
<h2 class="text-sm font-bold text-slate-800">Nhân viên mới</h2>
<a class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1 group" href="#">
                Xem tất cả
                <span class="group-hover:translate-x-0.5 transition-transform">→</span>
</a>
</div>
<div class="space-y-3">
<!-- Employee 1 -->
<div class="flex items-center justify-between text-xs py-1">
<div class="flex items-center gap-3">
<img alt="Trần Anh Tuấn" class="w-8 h-8 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA18pOYel6DCpHd63jF28dNr0Tt2lxipgXJRq0Zpqa5Anbj1HHTSvX2NtrSy0ksn5RTZJgHInI1y8EcVdPICbZBXP5mlSBVioVicPUuBmt-Wpf7LR8aNdIpLrkIqN-DkWDm2f9zO9qcZ9W7cYTG4E4RJNPMwLDOcrhqWoMnOcHvgUTq-7uomuLvTjiBI-xkAS4aRvu0_A5A_Vzmw7flJaFhVLSO4SAqUo132-2tGLBI"/>
<div>
<h3 class="font-semibold text-slate-800">Trần Anh Tuấn</h3>
<p class="text-[11px] text-slate-400">Kinh doanh</p>
</div>
</div>
<span class="text-[11px] text-slate-400">20/06/2025</span>
</div>
<!-- Employee 2 -->
<div class="flex items-center justify-between text-xs py-1">
<div class="flex items-center gap-3">
<img alt="Lê Thu Hà" class="w-8 h-8 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBO-etYb1JU-1kMc7CkWpzjqEb5gT5PN4XJp0GrbdqqcLM_SdxCFUgCwlD5xTEGjKlqDqWg9y573ONP3x7FxgXzRR2IwXg42x_92CuiNR2R2_2rxQAlaX7N090CFQdo3RraD6e0eMJf5Uj2uqYXhl_n2zDVqlbEnGN6x8b-sOXCoNswAJniUXLC-1fqF39YuJmOmhC-hpo_x0gAsne7J4XTqoU7XAC7h9Aro1NyhqNF"/>
<div>
<h3 class="font-semibold text-slate-800">Lê Thu Hà</h3>
<p class="text-[11px] text-slate-400">Marketing</p>
</div>
</div>
<span class="text-[11px] text-slate-400">18/06/2025</span>
</div>
<!-- Employee 3 -->
<div class="flex items-center justify-between text-xs py-1">
<div class="flex items-center gap-3">
<img alt="Phạm Văn Nam" class="w-8 h-8 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAPre10yDuoyOeRzvgDonGpuGIEdStpySxm4qPFZBkq8JDVrtxWKAtuu2IQw4mWNxJHY5_HNftfV66wCkDceTu7SaxcLxn_ZErLkmiUc2LHEOjWNaRkBNOo9GvetRcVqsAALIePko21gCOsKwXOC7LfdreudQgSbVxZ5HGUC38s5xsVGMfKRoNjV5b0Ftx6H4gSHhy4Tof83SRtMY3PVo5R1v5tTp1M_Bpkh4jp5t3W"/>
<div>
<h3 class="font-semibold text-slate-800">Phạm Văn Nam</h3>
<p class="text-[11px] text-slate-400">Kế toán</p>
</div>
</div>
<span class="text-[11px] text-slate-400">16/06/2025</span>
</div>
<!-- Employee 4 -->
<div class="flex items-center justify-between text-xs py-1">
<div class="flex items-center gap-3">
<img alt="Nguyễn Thị Mai" class="w-8 h-8 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAr73tEdoH5zo_D9PgSZZm6rRhIkFtD2DxX1gV1nyeGlN-FYe0x0oVfihn8uBzXwvzziS51ANQtByz0FKTyogO5ys2LjX0thB7aIrJxafvhmo5aj-kAVpfOgBuKzU9riuAlAxLDr2SHfBnjrcBnRt9szsZxvfwgGDklLT3NlrIlEZDwLnetDCpQ1KbVEw_YolIlJ6nRxYTwJEGOe0X0lPp6muyQ4Foa89hV6PA1QsYj"/>
<div>
<h3 class="font-semibold text-slate-800">Nguyễn Thị Mai</h3>
<p class="text-[11px] text-slate-400">Nhân sự</p>
</div>
</div>
<span class="text-[11px] text-slate-400">14/06/2025</span>
</div>
<!-- Employee 5 -->
<div class="flex items-center justify-between text-xs py-1">
<div class="flex items-center gap-3">
<img alt="Hoàng Đức Anh" class="w-8 h-8 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCE7QabmHZUVTlMi6-XDaghzGponWR7Pv4YC3q-_bhcmZMUgrjsFGX1VDjStVnjcp5ycOn6S8DFSGTBs4Hfy-IEWpT_VDLGkJVfubIXD_tv1gyHT1ZoPFvBH_kX_vvaUCNLXIZxDhqtclgcbXjFaGU-eND2xtjQfy_abwE6gD6KKDtUJ1TQ-zupUw35deFemtWwDm75PzZcBmqMXO9NzdFM1PPibpuFd-EQAQC_7Dyt"/>
<div>
<h3 class="font-semibold text-slate-800">Hoàng Đức Anh</h3>
<p class="text-[11px] text-slate-400">IT</p>
</div>
</div>
<span class="text-[11px] text-slate-400">12/06/2025</span>
</div>
</div>
</div>
</section>
<!-- END: BottomListsSection -->
</main>
<!-- BEGIN: RightSidebar -->
<aside class="w-80 bg-[#f8fafc] border-l border-slate-200/80 p-6 space-y-6 shrink-0" data-purpose="quick-actions-and-schedule">
<!-- Quick Actions Panel -->
<div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
<h2 class="text-sm font-bold text-slate-800 mb-4">Thao tác nhanh</h2>
<div class="grid grid-cols-2 gap-3">
<!-- Action 1: Thêm nhân viên -->
<button class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-blue-100 hover:border-blue-300 hover:bg-blue-50/40 transition-all group">
<div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.765Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<span class="text-xs font-semibold text-slate-700 group-hover:text-blue-600 text-center">Thêm nhân viên</span>
</button>
<!-- Action 2: Quản lý phòng ban -->
<button class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-blue-100 hover:border-blue-300 hover:bg-blue-50/40 transition-all group">
<div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<span class="text-xs font-semibold text-slate-700 group-hover:text-blue-600 text-center leading-snug">Quản lý phòng ban</span>
</button>
<!-- Action 3: Chấm công -->
<button class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-blue-100 hover:border-blue-300 hover:bg-blue-50/40 transition-all group">
<div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<span class="text-xs font-semibold text-slate-700 group-hover:text-blue-600 text-center">Chấm công</span>
</button>
<!-- Action 4: Tạo hợp đồng -->
<button class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-blue-100 hover:border-blue-300 hover:bg-blue-50/40 transition-all group">
<div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<span class="text-xs font-semibold text-slate-700 group-hover:text-blue-600 text-center leading-snug">Tạo hợp đồng</span>
</button>
<!-- Action 5: Xem báo cáo -->
<button class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-blue-100 hover:border-blue-300 hover:bg-blue-50/40 transition-all group">
<div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<span class="text-xs font-semibold text-slate-700 group-hover:text-blue-600 text-center">Xem báo cáo</span>
</button>
<!-- Action 6: Cài đặt -->
<button class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-blue-100 hover:border-blue-300 hover:bg-blue-50/40 transition-all group">
<div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.38.138.75.43 1 .294.241.62.585 1.004.827.424.27.534.819.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.6 6.6 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.216.456a1.125 1.125 0 0 1-1.37-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-1l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<span class="text-xs font-semibold text-slate-700 group-hover:text-blue-600 text-center">Cài đặt</span>
</button>
</div>
</div>
<!-- Work Schedule Panel (Timeline) -->
<div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
<div class="flex items-center justify-between mb-4">
<h2 class="text-sm font-bold text-slate-800">Lịch làm việc</h2>
<a class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1 group" href="#">
              Xem tất cả
              <span class="group-hover:translate-x-0.5 transition-transform">→</span>
</a>
</div>
<!-- Date Navigation Bar -->
<div class="flex items-center justify-between bg-slate-50 px-3 py-2 rounded-xl border border-slate-100 mb-5">
<button class="p-1 text-slate-400 hover:text-slate-600 transition-colors">
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M15.75 19.5 8.25 12l7.5-7.5" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</button>
<span class="text-xs font-semibold text-slate-800">Thứ 3, 24/06/2025</span>
<button class="p-1 text-slate-400 hover:text-slate-600 transition-colors">
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="m8.25 4.5 7.5 7.5-7.5 7.5" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</button>
</div>
<!-- Vertical Timeline list -->
<div class="relative pl-6 space-y-6 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-200">
<!-- Event 1 -->
<div class="relative group">
<span class="absolute -left-[1.85rem] top-1 w-2.5 h-2.5 rounded-full bg-blue-600 ring-4 ring-white"></span>
<div class="flex items-baseline gap-2 mb-0.5">
<span class="text-xs font-semibold text-blue-600">08:00</span>
<span class="text-xs font-semibold text-slate-800">Họp phòng ban Kinh doanh</span>
</div>
<p class="text-[11px] text-slate-400">Phòng họp 1</p>
</div>
<!-- Event 2 -->
<div class="relative group">
<span class="absolute -left-[1.85rem] top-1 w-2.5 h-2.5 rounded-full bg-blue-600 ring-4 ring-white"></span>
<div class="flex items-baseline gap-2 mb-0.5">
<span class="text-xs font-semibold text-blue-600">10:30</span>
<span class="text-xs font-semibold text-slate-800">Phỏng vấn ứng viên</span>
</div>
<p class="text-[11px] text-slate-400">Phòng họp 2</p>
</div>
<!-- Event 3 -->
<div class="relative group">
<span class="absolute -left-[1.85rem] top-1 w-2.5 h-2.5 rounded-full bg-blue-600 ring-4 ring-white"></span>
<div class="flex items-baseline gap-2 mb-0.5">
<span class="text-xs font-semibold text-blue-600">14:00</span>
<span class="text-xs font-semibold text-slate-800">Đào tạo nội bộ</span>
</div>
<p class="text-[11px] text-slate-400">Phòng đào tạo</p>
</div>
</div>
</div>
</aside>
<!-- END: RightSidebar -->
</div>
<!-- END: MainContentAndRightSidebar -->
</div>
</body></html>