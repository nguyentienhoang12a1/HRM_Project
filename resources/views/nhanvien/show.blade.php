<!DOCTYPE html>
<html class="h-full" lang="vi">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Hồ sơ chi tiết nhân viên: {{ $nhanVien->ho_va_ten }} ({{ $nhanVien->ma_nhan_vien }}) - LiHKh HRM</title>
<!-- Material Symbols Outlined -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Plus Jakarta Sans Font -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS with plugins -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          "colors": {
            "primary": "#00288e",
            "surface-bright": "#faf8ff",
            "on-tertiary": "#ffffff",
            "on-primary-fixed": "#001453",
            "error": "#ba1a1a",
            "error-container": "#ffdad6",
            "on-secondary-fixed": "#00174b",
            "on-primary": "#ffffff",
            "outline": "#757684",
            "inverse-on-surface": "#eef0ff",
            "on-primary-fixed-variant": "#173bab",
            "secondary-fixed": "#dbe1ff",
            "on-secondary-container": "#fefcff",
            "surface-variant": "#dae2fd",
            "surface-container-lowest": "#ffffff",
            "on-secondary": "#ffffff",
            "primary-fixed-dim": "#b8c4ff",
            "on-tertiary-fixed": "#002113",
            "surface-container-low": "#f2f3ff",
            "on-error-container": "#93000a",
            "on-primary-container": "#a8b8ff",
            "inverse-primary": "#b8c4ff",
            "tertiary": "#003d27",
            "inverse-surface": "#0f172a",
            "on-error": "#ffffff",
            "surface-tint": "#3755c3",
            "on-tertiary-container": "#3fd298",
            "secondary-container": "#1e40af",
            "secondary-fixed-dim": "#b4c5ff",
            "on-background": "#131b2e",
            "tertiary-fixed-dim": "#4edea3",
            "tertiary-container": "#00563a",
            "surface-dim": "#d2d9f4",
            "tertiary-fixed": "#6ffbbe",
            "on-surface": "#131b2e",
            "surface-container": "#eaedff",
            "primary-container": "#1e40af",
            "secondary": "#0051d5",
            "outline-variant": "#c4c5d5",
            "surface-container-highest": "#dae2fd",
            "primary-fixed": "#dde1ff",
            "surface": "#f8fafc",
            "background": "#f8fafc",
            "on-secondary-fixed-variant": "#003ea8",
            "surface-container-high": "#e2e7ff",
            "on-tertiary-fixed-variant": "#005236",
            "on-surface-variant": "#444653"
          },
          "borderRadius": {
            "DEFAULT": "0.25rem",
            "lg": "0.5rem",
            "xl": "0.75rem",
            "full": "9999px"
          },
          "fontFamily": {
            "data-mono": ["Plus Jakarta Sans"],
            "headline-md": ["Plus Jakarta Sans"],
            "headline-lg": ["Plus Jakarta Sans"],
            "body-md": ["Plus Jakarta Sans"],
            "title-md": ["Plus Jakarta Sans"],
            "title-sm": ["Plus Jakarta Sans"]
          }
        }
      }
    }
</script>
<style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      display: inline-block;
      vertical-align: middle;
      line-height: 1;
    }
    .material-symbols-outlined.fill {
      font-variation-settings: 'FILL' 1;
    }
</style>
</head>
<body class="bg-background text-on-surface antialiased h-full flex overflow-hidden font-body-md text-[13px]">
<!-- LEFT NAVIGATION SIDEBAR -->
<aside class="fixed top-0 left-0 bottom-0 z-40 w-[220px] h-screen flex flex-col shrink-0 bg-[#172554] border-r border-[#172554] select-none">
    <!-- Header Logo & Portal Title -->
    <div class="p-5 border-b border-white/10 flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-secondary-container flex items-center justify-center text-white shadow-md">
            <span class="material-symbols-outlined text-[24px]">corporate_fare</span>
        </div>
        <div>
            <h1 class="text-[20px] font-bold text-surface-container-lowest tracking-tight leading-none">LiHKh HRM</h1>
            <p class="text-[11px] text-outline-variant mt-1">Hệ thống Quản trị Nhân sự</p>
        </div>
    </div>
    <!-- Navigation Menu Items -->
    <nav class="flex-1 px-3 py-4 space-y-1.5 overflow-y-auto">
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-outline-variant hover:text-surface-container-lowest hover:bg-surface-variant/10 transition-colors" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined text-[20px]">dashboard</span>
            <span>Trang chủ</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-secondary-container text-white font-semibold shadow-sm" href="{{ route('nhanvien.index') }}">
            <span class="material-symbols-outlined text-[20px] fill" style="font-variation-settings: 'FILL' 1;">badge</span>
            <span>Quản lý nhân sự</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-outline-variant hover:text-surface-container-lowest hover:bg-surface-variant/10 transition-colors" href="{{ route('chamcong.index') }}">
            <span class="material-symbols-outlined text-[20px]">schedule</span>
            <span>Chấm công</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-outline-variant hover:text-surface-container-lowest hover:bg-surface-variant/10 transition-colors" href="{{ route('chamcong.lichsu') }}">
            <span class="material-symbols-outlined text-[20px]">history</span>
            <span>Lịch sử chấm công</span>
        </a>
        @if(auth()->check() && auth()->user()->hasRole('VT_Admin'))
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-outline-variant hover:text-surface-container-lowest hover:bg-surface-variant/10 transition-colors" href="{{ route('admin.roles.index') }}">
            <span class="material-symbols-outlined text-[20px]">manage_accounts</span>
            <span>Phân quyền hệ thống</span>
        </a>
        @endif
    </nav>
    <!-- Footer Profile in Sidebar -->
    <div class="p-3 border-t border-white/10 bg-slate-900/50">
        <div class="flex items-center justify-between p-2 rounded-lg hover:bg-white/5 transition-colors">
            <div class="flex items-center gap-2.5 overflow-hidden">
                <div class="w-9 h-9 rounded-full bg-secondary-container text-white font-bold flex items-center justify-center shrink-0">
                    {{ auth()->check() ? mb_substr(optional(auth()->user()->nhanVien)->ho_va_ten ?? auth()->user()->ten_tai_khoan, 0, 1) : 'U' }}
                </div>
                <div class="truncate">
                    <p class="text-[14px] font-semibold text-surface-container-lowest leading-tight truncate">
                        {{ auth()->check() ? (optional(auth()->user()->nhanVien)->ho_va_ten ?? auth()->user()->ten_tai_khoan) : 'Người dùng' }}
                    </p>
                    <p class="text-[11px] text-outline-variant">{{ session('user_roles')[0] ?? 'User' }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="p-1.5 rounded-md text-outline-variant hover:text-error hover:bg-white/10 transition-colors" title="Đăng xuất">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- MAIN WRAPPER (Offset left 240px) -->
<div class="pl-[220px] flex-1 flex flex-col h-screen overflow-hidden">
    <!-- TOP NAVIGATION BAR -->
    <header class="sticky top-0 z-30 flex items-center justify-between h-16 px-6 bg-surface-container-lowest border-b border-outline-variant/30 shrink-0">
        <div class="flex items-center gap-6 flex-1">
            <nav class="hidden md:flex items-center gap-2 text-[12px] text-outline">
                <a class="hover:text-primary transition-colors flex items-center gap-1" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined text-[16px]">home</span>
                    <span>Trang chủ</span>
                </a>
                <span class="text-outline-variant">/</span>
                <a class="hover:text-primary transition-colors" href="{{ route('nhanvien.index') }}">Quản lý nhân sự</a>
                <span class="text-outline-variant">/</span>
                <span class="font-semibold text-primary">Chi tiết nhân viên</span>
                <span class="text-outline-variant">/</span>
                <span class="text-on-surface font-semibold">{{ $nhanVien->ho_va_ten }} ({{ $nhanVien->ma_nhan_vien }})</span>
            </nav>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2.5 pl-1">
                <div class="w-8 h-8 rounded-full bg-primary text-white font-bold flex items-center justify-center text-xs">
                    {{ auth()->check() ? mb_substr(optional(auth()->user()->nhanVien)->ho_va_ten ?? auth()->user()->ten_tai_khoan, 0, 1) : 'U' }}
                </div>
                <span class="font-semibold text-on-surface hidden sm:inline">
                    {{ auth()->check() ? (optional(auth()->user()->nhanVien)->ho_va_ten ?? auth()->user()->ten_tai_khoan) : 'Khách' }}
                </span>
            </div>
        </div>
    </header>

    <!-- SCROLLABLE CONTENT CANVAS -->
    <main class="flex-1 overflow-y-auto bg-surface p-6 space-y-6">
        <!-- TOP ACTION BAR: BACK BUTTON & PRIMARY ACTIONS -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a class="inline-flex items-center gap-2 px-3 py-2 bg-surface-container-lowest border border-outline-variant/50 rounded-lg text-sm font-semibold text-on-surface hover:bg-surface-container-low transition-colors shadow-xs" href="{{ route('nhanvien.index') }}">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    <span>Danh sách nhân viên</span>
                </a>
                <div class="h-7 w-px bg-outline-variant/40 mx-1"></div>
                <div>
                    <h1 class="text-[20px] font-bold text-on-surface tracking-tight">Hồ sơ chi tiết nhân viên</h1>
                    <p class="text-[12px] text-outline">Mã số định danh toàn hệ thống: <span class="font-bold text-primary">{{ $nhanVien->ma_nhan_vien }}</span></p>
                </div>
            </div>
            <!-- Action buttons row -->
            <div class="flex items-center gap-2.5">
                <button onclick="window.print()" class="inline-flex items-center gap-2 px-3.5 py-2 bg-surface-container-lowest border border-outline-variant/60 rounded-lg text-sm font-semibold text-on-surface hover:bg-surface-container-low transition-colors shadow-xs cursor-pointer">
                    <span class="material-symbols-outlined text-[18px] text-outline">print</span>
                    <span>In hồ sơ</span>
                </button>
                @if(auth()->check() && auth()->user()->hasPermission('NS_014'))
                <a href="{{ route('nhanvien.edit', $nhanVien->ma_nhan_vien) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-container text-white rounded-lg text-sm font-semibold hover:bg-primary transition-all shadow-sm active:scale-95">
                    <span class="material-symbols-outlined text-[18px]">edit_square</span>
                    <span>Chỉnh sửa thông tin</span>
                </a>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- SECTION 1: HEADER CARD - EMPLOYEE IDENTITY & QUICK METRICS -->
        <section class="bg-surface-container-lowest rounded-xl border border-outline-variant/30 p-6 shadow-xs">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <!-- Identity block: Avatar + Essential bio -->
                <div class="flex items-start sm:items-center gap-5">
                    <div class="relative shrink-0">
                        <div class="w-24 h-24 rounded-xl bg-gradient-to-tr from-blue-700 to-indigo-500 text-white font-bold text-3xl flex items-center justify-center ring-2 ring-primary/10 shadow-sm">
                            {{ mb_substr($nhanVien->ho_va_ten, 0, 1) }}
                        </div>
                        @if($nhanVien->trang_thai_nhan_vien === 'Đang làm việc')
                            <span class="absolute bottom-1 right-1 w-4 h-4 bg-emerald-500 border-2 border-white rounded-full" title="Đang làm việc"></span>
                        @else
                            <span class="absolute bottom-1 right-1 w-4 h-4 bg-amber-500 border-2 border-white rounded-full" title="{{ $nhanVien->trang_thai_nhan_vien }}"></span>
                        @endif
                    </div>
                    <div class="space-y-2">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <h2 class="text-2xl font-bold text-on-surface tracking-tight">{{ $nhanVien->ho_va_ten }}</h2>
                            @if($nhanVien->trang_thai_nhan_vien === 'Đang làm việc')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                    Đang làm việc
                                </span>
                            @elseif($nhanVien->trang_thai_nhan_vien === 'Tạm khóa')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Tạm khóa
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span>
                                    Đã nghỉ việc
                                </span>
                            @endif
                            <span class="px-2 py-0.5 rounded-md text-xs font-bold bg-surface-container-high text-primary">
                                Mã: {{ $nhanVien->ma_nhan_vien }}
                            </span>
                        </div>
                        <!-- Roles and Division -->
                        <div class="flex flex-wrap items-center gap-2 text-sm text-on-surface">
                            <span class="inline-flex items-center gap-1.5 font-semibold text-primary">
                                <span class="material-symbols-outlined text-[16px]">work</span>
                                {{ optional($nhanVien->chucVu)->ten_chuc_vu ?? 'Chưa gán chức vụ' }}
                            </span>
                            <span class="text-outline-variant">|</span>
                            <span class="text-outline font-medium">{{ optional($nhanVien->viTriCongViec)->ten_vi_tri_cong_viec ?? 'Chưa gán vị trí' }}</span>
                            <span class="text-outline-variant">|</span>
                            <span class="inline-flex items-center gap-1 text-on-surface-variant font-medium">
                                <span class="material-symbols-outlined text-[16px] text-outline">apartment</span>
                                {{ optional($nhanVien->phongBan)->ten_phong_ban ?? 'Chưa gán phòng ban' }}
                            </span>
                        </div>
                        <!-- Contact Pills -->
                        <div class="flex flex-wrap items-center gap-3 pt-1 text-sm">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-surface text-on-surface border border-outline-variant/40">
                                <span class="material-symbols-outlined text-[16px] text-primary">call</span>
                                {{ $nhanVien->so_di_dong ?? 'Chưa cập nhật' }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-surface text-on-surface border border-outline-variant/40">
                                <span class="material-symbols-outlined text-[16px] text-primary">mail</span>
                                {{ $nhanVien->email }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-surface text-outline border border-outline-variant/40">
                                <span class="material-symbols-outlined text-[16px]">cake</span>
                                {{ $nhanVien->ngay_sinh ? \Carbon\Carbon::parse($nhanVien->ngay_sinh)->format('d/m/Y') : 'Chưa cập nhật ngày sinh' }}
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Quick Metrics Stat Wells (Right side) -->
                <div class="flex items-center gap-3 self-stretch lg:self-auto border-t lg:border-t-0 lg:border-l border-outline-variant/30 pt-4 lg:pt-0 lg:pl-6">
                    <div class="flex-1 lg:w-48 p-3.5 rounded-xl bg-surface border border-outline-variant/30 flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[22px]">workspace_premium</span>
                        </div>
                        <div>
                            <p class="text-xs text-outline">Thâm niên công tác</p>
                            <p class="text-sm font-bold text-on-surface leading-tight mt-0.5">
                                {{ $nhanVien->ngay_vao_lam_viec ? \Carbon\Carbon::parse($nhanVien->ngay_vao_lam_viec)->diffForHumans(null, true) : '---' }}
                            </p>
                            <span class="inline-block mt-1 text-[11px] font-semibold text-emerald-700 bg-emerald-100 px-1.5 py-0.5 rounded">Cống hiến</span>
                        </div>
                    </div>
                    <div class="flex-1 lg:w-48 p-3.5 rounded-xl bg-surface border border-outline-variant/30 flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[22px]">calendar_month</span>
                        </div>
                        <div>
                            <p class="text-xs text-outline">Ngày vào làm</p>
                            <p class="text-sm font-bold text-on-surface leading-tight mt-0.5">
                                {{ $nhanVien->ngay_vao_lam_viec ? \Carbon\Carbon::parse($nhanVien->ngay_vao_lam_viec)->format('d/m/Y') : '---' }}
                            </p>
                            <p class="text-xs text-outline mt-1">Hợp đồng chính thức</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: EXPANDABLE INFORMATION GROUPS (8 Nhóm Dữ Liệu Chuẩn) -->
        <section class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-1">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[20px]">account_tree</span>
                        <h3 class="text-base font-bold text-on-surface">Các nhóm thông tin chi tiết</h3>
                        <span class="px-2.5 py-0.5 rounded-full text-xs bg-blue-50 text-primary font-bold border border-blue-200">
                            8 nhóm dữ liệu chuẩn
                        </span>
                    </div>
                    <p class="text-xs text-outline mt-0.5">Dữ liệu hồ sơ đồng bộ từ Cơ sở Dữ liệu Nhân sự HRM</p>
                </div>
                <div class="flex items-center gap-2 text-xs">
                    <button class="text-primary hover:underline font-semibold flex items-center gap-1 cursor-pointer" id="btn-expand-all">
                        <span class="material-symbols-outlined text-[16px]">unfold_more</span>
                        Mở rộng tất cả
                    </button>
                    <span class="text-outline-variant">|</span>
                    <button class="text-outline hover:text-on-surface hover:underline font-medium flex items-center gap-1 cursor-pointer" id="btn-collapse-all">
                        <span class="material-symbols-outlined text-[16px]">unfold_less</span>
                        Thu gọn tất cả
                    </button>
                </div>
            </div>

            <!-- ACCORDION CONTAINER -->
            <div class="space-y-3" id="accordion-container">

                <!-- ACCORDION 01: Thông tin cá nhân và gia đình -->
                <div class="accordion-item bg-surface-container-lowest rounded-xl border border-outline-variant/30 overflow-hidden transition-all shadow-xs">
                    <button aria-expanded="true" class="accordion-toggle w-full p-4 px-5 flex items-center justify-between hover:bg-surface-container-low/40 transition-colors text-left cursor-pointer" type="button">
                        <div class="flex items-center gap-3.5">
                            <span class="w-8 h-8 rounded-lg bg-surface-container text-xs text-primary font-bold flex items-center justify-center shrink-0">
                                01
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-on-surface flex items-center gap-2">
                                    Thông tin cá nhân và gia đình
                                    <span class="px-2 py-0.5 text-[11px] font-semibold text-primary bg-blue-50 rounded-full border border-blue-100">Cơ bản</span>
                                </h4>
                                <p class="text-xs text-outline mt-0.5">Họ tên, ngày sinh, giới tính, quê quán, nơi sinh, tình trạng hôn nhân...</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline chevron-icon text-[22px] transition-transform duration-200 rotate-180">expand_more</span>
                    </button>
                    <div class="accordion-content border-t border-outline-variant/20 p-5 bg-surface-container-lowest">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Họ và tên khai sinh</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->ho_va_ten }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Ngày sinh</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->ngay_sinh ? \Carbon\Carbon::parse($nhanVien->ngay_sinh)->format('d/m/Y') : '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Giới tính</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->gioi_tinh ?? '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Quê quán</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->que_quan ?? '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Nơi sinh</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->noi_sinh ?? '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Tình trạng hôn nhân</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->tinh_trang_hon_nhan ?? 'Độc thân' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Dân tộc / Tôn giáo</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->dan_toc ? 'Dân tộc thiểu số' : 'Kinh' }} / {{ $nhanVien->ton_giao ? 'Có' : 'Không' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Chiều cao / Cân nặng</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">
                                    {{ $nhanVien->chieu_cao ? $nhanVien->chieu_cao . ' m' : '---' }} / {{ $nhanVien->can_nang ? $nhanVien->can_nang . ' kg' : '---' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACCORDION 02: Địa chỉ và liên hệ -->
                <div class="accordion-item bg-surface-container-lowest rounded-xl border border-outline-variant/30 overflow-hidden transition-all shadow-xs">
                    <button aria-expanded="false" class="accordion-toggle w-full p-4 px-5 flex items-center justify-between hover:bg-surface-container-low/40 transition-colors text-left cursor-pointer" type="button">
                        <div class="flex items-center gap-3.5">
                            <span class="w-8 h-8 rounded-lg bg-surface-container text-xs text-primary font-bold flex items-center justify-center shrink-0">
                                02
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-on-surface flex items-center gap-2">
                                    Địa chỉ và liên hệ
                                    <span class="px-2 py-0.5 text-[11px] font-semibold text-outline bg-surface rounded-full border border-outline-variant/40">Liên lạc</span>
                                </h4>
                                <p class="text-xs text-outline mt-0.5">Hộ khẩu thường trú, nơi ở hiện nay, người liên hệ khẩn cấp...</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline chevron-icon text-[22px] transition-transform duration-200">expand_more</span>
                    </button>
                    <div class="accordion-content hidden border-t border-outline-variant/20 p-5 bg-surface-container-lowest">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-3.5 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Hộ khẩu thường trú</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">
                                    {{ $nhanVien->hktt_dia_chi ?? ($nhanVien->hktt_phuong_xa ? ($nhanVien->hktt_phuong_xa . ', ' . $nhanVien->hktt_tinh_tp) : ($nhanVien->que_quan ?? 'Chưa cập nhật')) }}
                                </span>
                            </div>
                            <div class="p-3.5 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Nơi ở hiện nay (Tạm trú)</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">
                                    {{ $nhanVien->noi_o_dia_chi ?? ($nhanVien->noi_o_phuong_xa ? ($nhanVien->noi_o_phuong_xa . ', ' . $nhanVien->noi_o_tinh_tp) : 'Chưa cập nhật') }}
                                </span>
                            </div>
                            <div class="p-3.5 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Người liên hệ khẩn cấp</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">
                                    {{ $nhanVien->lien_he_khan_1_ten ?? 'Chưa có thông tin' }}
                                    @if($nhanVien->lien_he_khan_1_quan_he) ({{ $nhanVien->lien_he_khan_1_quan_he }}) @endif
                                    @if($nhanVien->lien_he_khan_1_dien_thoai) - {{ $nhanVien->lien_he_khan_1_dien_thoai }} @endif
                                </span>
                            </div>
                            <div class="p-3.5 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Email & SĐT chính</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">
                                    {{ $nhanVien->email }} | {{ $nhanVien->so_di_dong }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACCORDION 03: Giấy tờ tùy thân -->
                <div class="accordion-item bg-surface-container-lowest rounded-xl border border-outline-variant/30 overflow-hidden transition-all shadow-xs">
                    <button aria-expanded="false" class="accordion-toggle w-full p-4 px-5 flex items-center justify-between hover:bg-surface-container-low/40 transition-colors text-left cursor-pointer" type="button">
                        <div class="flex items-center gap-3.5">
                            <span class="w-8 h-8 rounded-lg bg-surface-container text-xs text-primary font-bold flex items-center justify-center shrink-0">
                                03
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-on-surface flex items-center gap-2">
                                    Giấy tờ tùy thân
                                    <span class="px-2 py-0.5 text-[11px] font-semibold text-outline bg-surface rounded-full border border-outline-variant/40">Định danh</span>
                                </h4>
                                <p class="text-xs text-outline mt-0.5">Số CCCD, ngày cấp, nơi cấp, mã số thuế, số sổ lao động...</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline chevron-icon text-[22px] transition-transform duration-200">expand_more</span>
                    </button>
                    <div class="accordion-content hidden border-t border-outline-variant/20 p-5 bg-surface-container-lowest">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Loại giấy tờ</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">Căn cước công dân gắn chip</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Số định danh / CCCD</span>
                                <span class="text-sm font-bold text-primary mt-1 block">{{ $nhanVien->so_cccd ?? '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Ngày cấp</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->ngay_cap_cccd ? \Carbon\Carbon::parse($nhanVien->ngay_cap_cccd)->format('d/m/Y') : '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Nơi cấp</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->noi_cap_cccd ?? 'Cục Cảnh sát QLHC về TTXH' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Mã số thuế cá nhân</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->ma_so_thue ?? '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Số sổ lao động</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->so_so_lao_dong ?? '---' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACCORDION 04: Quá trình làm việc -->
                <div class="accordion-item bg-surface-container-lowest rounded-xl border border-outline-variant/30 overflow-hidden transition-all shadow-xs">
                    <button aria-expanded="false" class="accordion-toggle w-full p-4 px-5 flex items-center justify-between hover:bg-surface-container-low/40 transition-colors text-left cursor-pointer" type="button">
                        <div class="flex items-center gap-3.5">
                            <span class="w-8 h-8 rounded-lg bg-surface-container text-xs text-primary font-bold flex items-center justify-center shrink-0">
                                04
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-on-surface flex items-center gap-2">
                                    Quá trình làm việc
                                    <span class="px-2 py-0.5 text-[11px] font-semibold text-outline bg-surface rounded-full border border-outline-variant/40">Công tác</span>
                                </h4>
                                <p class="text-xs text-outline mt-0.5">Ngày vào làm, phòng ban, chức vụ, chức danh đảm nhiệm...</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline chevron-icon text-[22px] transition-transform duration-200">expand_more</span>
                    </button>
                    <div class="accordion-content hidden border-t border-outline-variant/20 p-5 bg-surface-container-lowest">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Ngày vào làm việc</span>
                                <span class="text-sm font-semibold text-primary mt-1 block">{{ $nhanVien->ngay_vao_lam_viec ? \Carbon\Carbon::parse($nhanVien->ngay_vao_lam_viec)->format('d/m/Y') : '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Phòng ban</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ optional($nhanVien->phongBan)->ten_phong_ban ?? '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Chức vụ</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ optional($nhanVien->chucVu)->ten_chuc_vu ?? '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Vị trí công việc</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ optional($nhanVien->viTriCongViec)->ten_vi_tri_cong_viec ?? '---' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACCORDION 05: Trình độ học vấn & Kỹ năng -->
                <div class="accordion-item bg-surface-container-lowest rounded-xl border border-outline-variant/30 overflow-hidden transition-all shadow-xs">
                    <button aria-expanded="false" class="accordion-toggle w-full p-4 px-5 flex items-center justify-between hover:bg-surface-container-low/40 transition-colors text-left cursor-pointer" type="button">
                        <div class="flex items-center gap-3.5">
                            <span class="w-8 h-8 rounded-lg bg-surface-container text-xs text-primary font-bold flex items-center justify-center shrink-0">
                                05
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-on-surface flex items-center gap-2">
                                    Trình độ học vấn &amp; Kỹ năng
                                    <span class="px-2 py-0.5 text-[11px] font-semibold text-outline bg-surface rounded-full border border-outline-variant/40">Học vấn</span>
                                </h4>
                                <p class="text-xs text-outline mt-0.5">Bằng cấp, chuyên ngành, trường tốt nghiệp, hình thức đào tạo...</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline chevron-icon text-[22px] transition-transform duration-200">expand_more</span>
                    </button>
                    <div class="accordion-content hidden border-t border-outline-variant/20 p-5 bg-surface-container-lowest">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Trình độ cao nhất</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->bang_cap ?? $nhanVien->ma_trinh_do_van_hoa ?? 'Đại học' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Chuyên ngành</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->chuyen_nganh ?? '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Trường tốt nghiệp</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->truong_tot_nghiep ?? '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Hình thức đào tạo</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->hinh_thuc_dao_tao ?? 'Chính quy' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACCORDION 06: Thông tin hợp đồng -->
                <div class="accordion-item bg-surface-container-lowest rounded-xl border border-outline-variant/30 overflow-hidden transition-all shadow-xs">
                    <button aria-expanded="false" class="accordion-toggle w-full p-4 px-5 flex items-center justify-between hover:bg-surface-container-low/40 transition-colors text-left cursor-pointer" type="button">
                        <div class="flex items-center gap-3.5">
                            <span class="w-8 h-8 rounded-lg bg-surface-container text-xs text-primary font-bold flex items-center justify-center shrink-0">
                                06
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-on-surface flex items-center gap-2">
                                    Thông tin hợp đồng lao động
                                    <span class="px-2 py-0.5 text-[11px] font-semibold text-emerald-700 bg-emerald-50 rounded-full border border-emerald-200">Hợp đồng</span>
                                </h4>
                                <p class="text-xs text-outline mt-0.5">Số hợp đồng, loại hợp đồng, ngày ký, thời hạn, mức lương...</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline chevron-icon text-[22px] transition-transform duration-200">expand_more</span>
                    </button>
                    <div class="accordion-content hidden border-t border-outline-variant/20 p-5 bg-surface-container-lowest">
                        @php $hd = $nhanVien->hopDongs->first(); @endphp
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Số hợp đồng hiện hành</span>
                                <span class="text-sm font-bold text-primary mt-1 block">{{ $hd ? $hd->ma_hop_dong : ('HDLD-' . $nhanVien->ma_nhan_vien) }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Loại hợp đồng</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $hd ? $hd->loai_hop_dong : 'Hợp đồng lao động chính thức' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Ngày ký kết</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">
                                    {{ $hd && $hd->ngay_ky ? \Carbon\Carbon::parse($hd->ngay_ky)->format('d/m/Y') : ($nhanVien->ngay_vao_lam_viec ? \Carbon\Carbon::parse($nhanVien->ngay_vao_lam_viec)->format('d/m/Y') : '---') }}
                                </span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Mức lương thỏa thuận</span>
                                <span class="text-sm font-bold text-emerald-600 mt-1 block">
                                    {{ $hd && $hd->muc_luong > 0 ? number_format($hd->muc_luong, 0, ',', '.') . ' VNĐ' : 'Theo quy chế công ty' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACCORDION 07: Thông tin ngân hàng -->
                <div class="accordion-item bg-surface-container-lowest rounded-xl border border-outline-variant/30 overflow-hidden transition-all shadow-xs">
                    <button aria-expanded="false" class="accordion-toggle w-full p-4 px-5 flex items-center justify-between hover:bg-surface-container-low/40 transition-colors text-left cursor-pointer" type="button">
                        <div class="flex items-center gap-3.5">
                            <span class="w-8 h-8 rounded-lg bg-surface-container text-xs text-primary font-bold flex items-center justify-center shrink-0">
                                07
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-on-surface flex items-center gap-2">
                                    Thông tin tài khoản ngân hàng
                                    <span class="px-2 py-0.5 text-[11px] font-semibold text-outline bg-surface rounded-full border border-outline-variant/40">Thụ hưởng</span>
                                </h4>
                                <p class="text-xs text-outline mt-0.5">Số tài khoản thanh toán lương, tên chủ tài khoản, ngân hàng thụ hưởng...</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline chevron-icon text-[22px] transition-transform duration-200">expand_more</span>
                    </button>
                    <div class="accordion-content hidden border-t border-outline-variant/20 p-5 bg-surface-container-lowest">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Số tài khoản nhận lương</span>
                                <span class="text-sm font-bold text-primary mt-1 block">{{ $nhanVien->so_tai_khoan_ngan_hang ?? '---' }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Chủ tài khoản</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->chu_tai_khoan ?? $nhanVien->ho_va_ten }}</span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Ngân hàng</span>
                                <span class="text-sm font-semibold text-on-surface mt-1 block">{{ $nhanVien->ma_ngan_hang ?? 'Ngân hàng Quốc tế VIB' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACCORDION 08: Bảo hiểm và thông tin khác -->
                <div class="accordion-item bg-surface-container-lowest rounded-xl border border-outline-variant/30 overflow-hidden transition-all shadow-xs">
                    <button aria-expanded="false" class="accordion-toggle w-full p-4 px-5 flex items-center justify-between hover:bg-surface-container-low/40 transition-colors text-left cursor-pointer" type="button">
                        <div class="flex items-center gap-3.5">
                            <span class="w-8 h-8 rounded-lg bg-surface-container text-xs text-primary font-bold flex items-center justify-center shrink-0">
                                08
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-on-surface flex items-center gap-2">
                                    Bảo hiểm và thông tin khác
                                    <span class="px-2 py-0.5 text-[11px] font-semibold text-outline bg-surface rounded-full border border-outline-variant/40">BHXH / BHYT</span>
                                </h4>
                                <p class="text-xs text-outline mt-0.5">Bảo hiểm xã hội, Bảo hiểm y tế, Bảo hiểm thất nghiệp, ghi chú...</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline chevron-icon text-[22px] transition-transform duration-200">expand_more</span>
                    </button>
                    <div class="accordion-content hidden border-t border-outline-variant/20 p-5 bg-surface-container-lowest">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Bảo hiểm Xã hội (BHXH)</span>
                                <span class="text-sm font-semibold {{ $nhanVien->tham_gia_bhxh ? 'text-emerald-700' : 'text-slate-600' }} mt-1 block">
                                    {{ $nhanVien->tham_gia_bhxh ? 'Đã tham gia' : 'Chưa tham gia' }}
                                </span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Bảo hiểm Y tế (BHYT)</span>
                                <span class="text-sm font-semibold {{ $nhanVien->tham_gia_bhyt ? 'text-emerald-700' : 'text-slate-600' }} mt-1 block">
                                    {{ $nhanVien->tham_gia_bhyt ? 'Đã tham gia' : 'Chưa tham gia' }}
                                </span>
                            </div>
                            <div class="p-3 bg-surface rounded-lg border border-outline-variant/30">
                                <span class="text-xs text-outline block">Bảo hiểm Thất nghiệp (BHTN)</span>
                                <span class="text-sm font-semibold {{ $nhanVien->tham_gia_bhtn ? 'text-emerald-700' : 'text-slate-600' }} mt-1 block">
                                    {{ $nhanVien->tham_gia_bhtn ? 'Đã tham gia' : 'Chưa tham gia' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- SYSTEM LOG & METADATA FOOTNOTE WELL -->
        <div class="p-4 rounded-xl bg-surface-container-low/60 border border-outline-variant/30 flex flex-wrap items-center justify-between gap-4 text-xs text-outline">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">history</span>
                    Ngày tạo: <strong>{{ $nhanVien->ngay_tao ? \Carbon\Carbon::parse($nhanVien->ngay_tao)->format('d/m/Y H:i:s') : '---' }}</strong>
                </span>
                <span class="text-outline-variant">|</span>
                <span class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">update</span>
                    Lần cập nhật cuối: <strong>{{ $nhanVien->ngay_cap_nhat ? \Carbon\Carbon::parse($nhanVien->ngay_cap_nhat)->format('d/m/Y H:i:s') : '---' }}</strong>
                </span>
            </div>
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-[16px] text-emerald-600">verified_user</span>
                <span>Hồ sơ định danh bảo mật LiHKh HRM Core</span>
            </div>
        </div>

        <footer class="w-full py-4 border-t border-outline-variant/20 flex flex-wrap items-center justify-between text-xs text-outline">
            <p>© 2026 Hệ thống Quản trị Nguồn Nhân lực LiHKh HRM. Mọi quyền được bảo lưu.</p>
        </footer>
    </main>
</div>

<!-- INTERACTIVITY SCRIPT: ACCORDION TOGGLE & CONTROLS -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
      const items = document.querySelectorAll('.accordion-item');
      const expandAllBtn = document.getElementById('btn-expand-all');
      const collapseAllBtn = document.getElementById('btn-collapse-all');

      items.forEach(item => {
        const toggle = item.querySelector('.accordion-toggle');
        const content = item.querySelector('.accordion-content');
        const chevron = item.querySelector('.chevron-icon');

        toggle.addEventListener('click', () => {
          const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
          if (isExpanded) {
            content.classList.add('hidden');
            toggle.setAttribute('aria-expanded', 'false');
            chevron.classList.remove('rotate-180');
          } else {
            content.classList.remove('hidden');
            toggle.setAttribute('aria-expanded', 'true');
            chevron.classList.add('rotate-180');
          }
        });
      });

      expandAllBtn?.addEventListener('click', () => {
        items.forEach(item => {
          const toggle = item.querySelector('.accordion-toggle');
          const content = item.querySelector('.accordion-content');
          const chevron = item.querySelector('.chevron-icon');
          content.classList.remove('hidden');
          toggle.setAttribute('aria-expanded', 'true');
          chevron.classList.add('rotate-180');
        });
      });

      collapseAllBtn?.addEventListener('click', () => {
        items.forEach(item => {
          const toggle = item.querySelector('.accordion-toggle');
          const content = item.querySelector('.accordion-content');
          const chevron = item.querySelector('.chevron-icon');
          content.classList.add('hidden');
          toggle.setAttribute('aria-expanded', 'false');
          chevron.classList.remove('rotate-180');
        });
      });
    });
</script>
</body>
</html>
