@extends('layout.app')

@section('content')
                <div class="max-w-[1440px] mx-auto p-space-lg">
                <div class="flex flex-col w-full gap-space-lg">
                    <!-- Executive Top Cockpit Briefing -->
                    <section
                        class="relative overflow-hidden rounded-xl bg-gradient-to-r from-primary to-primary-container p-space-lg text-on-primary shadow-xl">
                        <div
                            class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-secondary-container/10 blur-3xl pointer-events-none">
                        </div>
                        <div
                            class="absolute right-40 -bottom-20 w-64 h-64 rounded-full bg-tertiary-fixed/10 blur-2xl pointer-events-none">
                        </div>
                        <div
                            class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-space-md">
                            <div class="flex items-center gap-space-md">
                                <div
                                    class="relative w-16 h-16 rounded-xl bg-surface-container-lowest/10 p-1 flex-shrink-0 shadow-inner">
                                    <img class="w-full h-full object-cover rounded-lg"
                                        data-alt="Portrait of an esteemed Vietnamese CEO Dang Quoc Hung wearing a tailored navy suit and glasses, executive office skyline backdrop, warm natural daylight, authoritative yet approachable look."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAwXWrMCtDUUXph0ABDjP7GT_hhhF8oGavo_wjmaYK6IY5VG7bKCd1VsFo6xkQbyYfZmgNyY8zJrlOle0594EBApGzkCgRStj6YkhWZB2GViaK_QGqT7iz6bs-BSzoGWZF2_9RMRw8m9z5_nLPACMtX6pK5Z-5ZuqEw1q3DNB8h_kEg9VqVZTRiWEm4cKuMeQGVW2e7ByVoSHL66BYkQ-OGhS1gOCWqxOYpTg-5u2k" />
                                    <span
                                        class="absolute -bottom-1 -right-1 w-4 h-4 bg-tertiary-fixed rounded-full shadow-[0_0_0_2px_#00236f] flex items-center justify-center">
                                        <span class="w-1.5 h-1.5 rounded-full bg-tertiary-container"></span>
                                    </span>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="px-2 py-0.5 rounded font-label-sm text-label-sm uppercase bg-secondary-container/20 text-secondary-fixed tracking-wider font-semibold">C-Suite
                                            Portal</span>
                                        <span class="font-body-sm text-body-sm text-primary-fixed-dim">Q3 · Năm tài
                                            chính 2024</span>
                                    </div>
                                    <h1
                                        class="font-headline-lg text-headline-lg text-on-primary tracking-tight mt-0.5">
                                        Bảng Điều Khiển Chiến Lược Tổng Giám Đốc</h1>
                                    <p class="font-body-sm text-body-sm text-primary-fixed">Kính chào Tổng Giám đốc
                                        <strong class="text-surface-bright font-semibold">Đặng Quốc Hưng</strong>. Dữ
                                        liệu thời gian thực đồng bộ lúc 09:30 AM.</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-space-sm">
                                <div
                                    class="px-space-md py-2.5 rounded-xl bg-surface-container-lowest/10 backdrop-blur-md flex items-center gap-space-sm shadow-sm">
                                    <span
                                        class="material-symbols-outlined text-secondary-fixed text-[22px]">verified_user</span>
                                    <div class="flex flex-col">
                                        <span
                                            class="font-label-sm text-label-sm uppercase text-primary-fixed-dim">Chứng
                                            thư bảo mật</span>
                                        <span
                                            class="font-label-md text-label-md text-surface-bright font-semibold">LiHKn
                                            C-Token HSM: Kích hoạt</span>
                                    </div>
                                </div>
                                <button
                                    class="flex items-center gap-space-xs px-space-md py-2.5 rounded-xl bg-secondary-container hover:bg-secondary-fixed text-on-secondary-container font-label-lg text-label-lg transition-all shadow-md active:scale-95"
                                    id="refreshCockpitBtn">
                                    <span class="material-symbols-outlined text-[18px]">sync</span>
                                    <span>Đồng bộ Dữ liệu</span>
                                </button>
                            </div>
                        </div>
                    </section>
                    <!-- Section 1: Thước đo Tài chính & Năng suất nhân sự -->
                    <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-space-md">
                        <!-- Card 1: Quỹ lương & Hạn mức -->
                        <div
                            class="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span
                                        class="font-label-sm text-label-sm uppercase text-outline tracking-wider font-semibold">Quỹ
                                        Lương &amp; Chi Phí HR</span>
                                    <div class="flex items-baseline gap-1.5 mt-1">
                                        <span
                                            class="font-headline-xl text-headline-xl text-primary font-extrabold tracking-tight">3.45</span>
                                        <span
                                            class="font-label-lg text-label-lg text-on-surface-variant font-semibold">tỷ
                                            VNĐ/tháng</span>
                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[22px]">account_balance_wallet</span>
                                </div>
                            </div>
                            <div class="mt-space-md">
                                <div class="flex items-center justify-between text-body-sm font-body-sm mb-1.5">
                                    <span class="text-on-surface-variant">Ngân sách Q3 (Trần 3.67 tỷ)</span>
                                    <span class="font-semibold text-secondary">94.0%</span>
                                </div>
                                <div class="w-full h-2 rounded-full bg-surface-container overflow-hidden">
                                    <div class="h-full bg-secondary rounded-full" style="width: 94%"></div>
                                </div>
                                <div
                                    class="flex items-center justify-between mt-2 pt-2 text-label-sm font-label-sm text-outline border-none">
                                    <span class="text-tertiary-container font-semibold">Dư địa an toàn: 220
                                        triệu</span>
                                    <span class="flex items-center gap-0.5 text-secondary font-medium">
                                        <span class="material-symbols-outlined text-[14px]">trending_up</span> -1.8% vs
                                        Q2
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2: Năng suất nhân sự (Revenue / FTE) -->
                        <div
                            class="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span
                                        class="font-label-sm text-label-sm uppercase text-outline tracking-wider font-semibold">Năng
                                        Suất Nhân Sự (Doanh Thu/FTE)</span>
                                    <div class="flex items-baseline gap-1 mt-1">
                                        <span
                                            class="font-headline-xl text-headline-xl text-primary font-extrabold tracking-tight">142</span>
                                        <span
                                            class="font-label-lg text-label-lg text-on-surface-variant font-semibold">triệu/NV/tháng</span>
                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-xl bg-surface-container-highest flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined text-[22px]">speed</span>
                                </div>
                            </div>
                            <div class="mt-space-md flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span
                                        class="inline-flex items-center gap-1 font-label-md text-label-md text-tertiary-container font-bold bg-surface-container-low px-2 py-0.5 rounded-full">
                                        <span class="material-symbols-outlined text-[16px]">arrow_upward</span> +6.8%
                                        YoY
                                    </span>
                                    <span class="font-body-sm text-body-sm text-outline mt-1">Mục tiêu: 135
                                        triệu/tháng</span>
                                </div>
                                <!-- Sparkline inline svg -->
                                <svg class="w-20 h-10 text-secondary" fill="none" viewbox="0 0 100 40">
                                    <path d="M5 32 Q 25 28, 45 22 T 80 12 L 95 6" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-width="3"></path>
                                    <circle class="fill-secondary-container" cx="95" cy="6" r="3.5">
                                    </circle>
                                </svg>
                            </div>
                        </div>
                        <!-- Card 3: eNPS Score -->
                        <div
                            class="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span
                                        class="font-label-sm text-label-sm uppercase text-outline tracking-wider font-semibold">Chỉ
                                        Số Gắn Kết Nhân Viên (eNPS)</span>
                                    <div class="flex items-baseline gap-1 mt-1">
                                        <span
                                            class="font-headline-xl text-headline-xl text-tertiary-container font-extrabold tracking-tight">84</span>
                                        <span
                                            class="font-label-lg text-label-lg text-on-surface-variant font-semibold">/100</span>
                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-tertiary-container">
                                    <span class="material-symbols-outlined text-[22px]">sentiment_very_satisfied</span>
                                </div>
                            </div>
                            <div class="mt-space-md flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span
                                        class="px-2 py-0.5 rounded bg-surface-container font-label-sm text-label-sm uppercase text-tertiary font-bold tracking-wider inline-block w-fit">Mức
                                        Xuất Sắc</span>
                                    <span class="font-body-sm text-body-sm text-outline mt-1">Khảo sát toàn bộ 486 nhân
                                        sự</span>
                                </div>
                                <!-- Circular mini progress indicator -->
                                <div class="relative w-12 h-12 flex items-center justify-center">
                                    <svg class="w-full h-full transform -rotate-90" viewbox="0 0 36 36">
                                        <path class="text-surface-container"
                                            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none" stroke="currentColor" stroke-width="3.5"></path>
                                        <path class="text-tertiary-container"
                                            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none" stroke="currentColor" stroke-dasharray="84, 100"
                                            stroke-linecap="round" stroke-width="3.5"></path>
                                    </svg>
                                    <span
                                        class="absolute font-label-sm text-label-sm text-on-surface font-bold">84%</span>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4: Ổn định cấp trung -->
                        <div
                            class="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span
                                        class="font-label-sm text-label-sm uppercase text-outline tracking-wider font-semibold">Ổn
                                        Định Nhân Sự Quản Lý Cấp Trung</span>
                                    <div class="flex items-baseline gap-1 mt-1">
                                        <span
                                            class="font-headline-xl text-headline-xl text-primary font-extrabold tracking-tight">100%</span>
                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-xl bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed">
                                    <span class="material-symbols-outlined text-[22px]">diversity_3</span>
                                </div>
                            </div>
                            <div class="mt-space-md">
                                <div class="flex items-center justify-between text-body-sm font-body-sm mb-1">
                                    <span class="font-body-md-bold text-body-md-bold text-on-surface">18 / 18 Cán
                                        bộ</span>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-surface-container-low font-label-sm text-label-sm text-secondary font-semibold">Tỷ
                                        lệ rời bỏ: 0%</span>
                                </div>
                                <p class="font-body-sm text-body-sm text-outline">Lead &amp; Trưởng phòng duy trì gắn
                                    kết chiến lược vững vàng.</p>
                            </div>
                        </div>
                    </section>
                    <!-- Section 2: Phân bổ Tổ chức (Bento Grid) & Mục tiêu OKR -->
                    <section class="grid grid-cols-1 lg:grid-cols-12 gap-space-md">
                        <!-- Khối Cơ cấu Quy mô Tổ chức (8 cột) -->
                        <div
                            class="lg:col-span-8 rounded-xl bg-surface-container-lowest p-space-lg shadow-sm flex flex-col justify-between">
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm pb-space-md">
                                <div>
                                    <span
                                        class="font-label-sm text-label-sm uppercase text-outline tracking-widest font-semibold">Cơ
                                        Cấu &amp; Quy Mô Tổ Chức</span>
                                    <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight">486 Nhân
                                        sự Tập đoàn LiHKn</h2>
                                </div>
                                <div
                                    class="flex items-center gap-space-xs bg-surface-container-low p-1 rounded-xl self-start">
                                    <button
                                        class="px-3 py-1 rounded-lg bg-surface-container-lowest text-primary font-label-md text-label-md font-semibold shadow-sm">Theo
                                        Khối</button>
                                    <button
                                        class="px-3 py-1 rounded-lg text-outline font-label-md text-label-md hover:text-on-surface">Theo
                                        Level</button>
                                    <button
                                        class="px-3 py-1 rounded-lg text-outline font-label-md text-label-md hover:text-on-surface">Vùng
                                        miền</button>
                                </div>
                            </div>
                            <!-- Segmented Bar Visualization -->
                            <div class="w-full flex flex-col gap-2 mt-2">
                                <div
                                    class="h-5 w-full rounded-full overflow-hidden flex shadow-inner bg-surface-container">
                                    <div class="h-full bg-primary hover:opacity-90 transition-opacity"
                                        style="width: 45%" title="R&amp;D: 45%"></div>
                                    <div class="h-full bg-secondary-container hover:opacity-90 transition-opacity"
                                        style="width: 30%" title="Kinh doanh: 30%"></div>
                                    <div class="h-full bg-surface-tint hover:opacity-90 transition-opacity"
                                        style="width: 15%" title="Vận hành: 15%"></div>
                                    <div class="h-full bg-outline-variant hover:opacity-90 transition-opacity"
                                        style="width: 10%" title="Tài chính kế toán: 10%"></div>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-space-md mt-space-md">
                                    <!-- Item 1: R&D -->
                                    <div class="p-space-md rounded-xl bg-surface-container-low flex flex-col gap-1">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-3 h-3 rounded-full bg-primary"></span>
                                            <span
                                                class="font-label-md text-label-md text-on-surface font-semibold">Khối
                                                R&amp;D</span>
                                        </div>
                                        <div class="flex items-baseline gap-1 mt-1">
                                            <span
                                                class="font-headline-lg text-headline-lg text-primary font-bold">218</span>
                                            <span class="font-body-sm text-body-sm text-outline">kỹ sư</span>
                                        </div>
                                        <div
                                            class="flex items-center justify-between font-label-sm text-label-sm text-outline mt-1">
                                            <span>Tỷ trọng</span>
                                            <span class="font-bold text-primary">45%</span>
                                        </div>
                                    </div>
                                    <!-- Item 2: Kinh doanh -->
                                    <div class="p-space-md rounded-xl bg-surface-container-low flex flex-col gap-1">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-3 h-3 rounded-full bg-secondary-container"></span>
                                            <span
                                                class="font-label-md text-label-md text-on-surface font-semibold">Kinh
                                                Doanh</span>
                                        </div>
                                        <div class="flex items-baseline gap-1 mt-1">
                                            <span
                                                class="font-headline-lg text-headline-lg text-secondary font-bold">146</span>
                                            <span class="font-body-sm text-body-sm text-outline">nhân sự</span>
                                        </div>
                                        <div
                                            class="flex items-center justify-between font-label-sm text-label-sm text-outline mt-1">
                                            <span>Tỷ trọng</span>
                                            <span class="font-bold text-secondary">30%</span>
                                        </div>
                                    </div>
                                    <!-- Item 3: Vận hành -->
                                    <div class="p-space-md rounded-xl bg-surface-container-low flex flex-col gap-1">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-3 h-3 rounded-full bg-surface-tint"></span>
                                            <span class="font-label-md text-label-md text-on-surface font-semibold">Vận
                                                Hành</span>
                                        </div>
                                        <div class="flex items-baseline gap-1 mt-1">
                                            <span
                                                class="font-headline-lg text-headline-lg text-surface-tint font-bold">73</span>
                                            <span class="font-body-sm text-body-sm text-outline">nhân sự</span>
                                        </div>
                                        <div
                                            class="flex items-center justify-between font-label-sm text-label-sm text-outline mt-1">
                                            <span>Tỷ trọng</span>
                                            <span class="font-bold text-surface-tint">15%</span>
                                        </div>
                                    </div>
                                    <!-- Item 4: Tài chính kế toán -->
                                    <div class="p-space-md rounded-xl bg-surface-container-low flex flex-col gap-1">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-3 h-3 rounded-full bg-outline"></span>
                                            <span class="font-label-md text-label-md text-on-surface font-semibold">TC
                                                - Kế Toán</span>
                                        </div>
                                        <div class="flex items-baseline gap-1 mt-1">
                                            <span
                                                class="font-headline-lg text-headline-lg text-on-surface font-bold">49</span>
                                            <span class="font-body-sm text-body-sm text-outline">nhân sự</span>
                                        </div>
                                        <div
                                            class="flex items-center justify-between font-label-sm text-label-sm text-outline mt-1">
                                            <span>Tỷ trọng</span>
                                            <span class="font-bold text-on-surface">10%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Footer Micro-Insights -->
                            <div
                                class="mt-space-md pt-space-sm flex flex-col sm:flex-row items-center justify-between gap-space-sm text-body-sm font-body-sm text-outline">
                                <div class="flex items-center gap-space-sm">
                                    <span class="material-symbols-outlined text-secondary text-[20px]">lightbulb</span>
                                    <span>Khối R&amp;D gia tăng +12% quy mô so với đầu năm nhằm phục vụ dự án AI
                                        SaaS.</span>
                                </div>
                                <a class="font-label-md text-label-md text-secondary font-semibold hover:underline flex items-center gap-1"
                                    href="#">
                                    Báo cáo chi tiết vị trí <span
                                        class="material-symbols-outlined text-[16px]">chevron_right</span>
                                </a>
                            </div>
                        </div>
                        <!-- Khối Tiến độ OKR Chiến lược Tập đoàn (4 cột) -->
                        <div
                            class="lg:col-span-4 rounded-xl bg-surface-container-lowest p-space-lg shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between">
                                    <span
                                        class="font-label-sm text-label-sm uppercase text-outline tracking-wider font-semibold">Mục
                                        Tiêu Chiến Lược 2024</span>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-secondary-fixed font-label-sm text-label-sm text-on-secondary-fixed font-bold">Năm
                                        FY24</span>
                                </div>
                                <h3 class="font-headline-md text-headline-md text-primary mt-1">Tiến Độ OKR Tập Đoàn
                                </h3>
                            </div>
                            <!-- Donut Circle with OKR Percent -->
                            <div class="my-space-md flex flex-col items-center justify-center">
                                <div class="relative w-44 h-44 flex items-center justify-center">
                                    <svg class="w-full h-full transform -rotate-90" viewbox="0 0 100 100">
                                        <circle class="text-surface-container" cx="50" cy="50"
                                            fill="none" r="40" stroke="currentColor" stroke-width="10"></circle>
                                        <circle class="text-primary-container" cx="50" cy="50"
                                            fill="none" r="40" stroke="currentColor" stroke-dasharray="251.2"
                                            stroke-dashoffset="29.1" stroke-linecap="round" stroke-width="10">
                                        </circle>
                                    </svg>
                                    <div class="absolute flex flex-col items-center justify-center">
                                        <span
                                            class="font-headline-xl text-headline-xl text-primary font-black">88.4%</span>
                                        <span
                                            class="font-label-sm text-label-sm uppercase text-outline font-semibold">Hoàn
                                            thành</span>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-space-xs">
                                <div class="flex items-center justify-between text-body-sm font-body-sm">
                                    <span class="text-on-surface-variant flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-primary-container"></span>OKR1: Mở rộng
                                        tệp KH Enterprise
                                    </span>
                                    <span class="font-bold text-on-surface">94.2%</span>
                                </div>
                                <div class="flex items-center justify-between text-body-sm font-body-sm">
                                    <span class="text-on-surface-variant flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-secondary"></span>OKR2: Số hoá quy trình
                                        100%
                                    </span>
                                    <span class="font-bold text-on-surface">91.0%</span>
                                </div>
                                <div class="flex items-center justify-between text-body-sm font-body-sm">
                                    <span class="text-on-surface-variant flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-outline-variant"></span>OKR3: Doanh thu
                                        ARR Q3
                                    </span>
                                    <span class="font-bold text-on-surface">80.0%</span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Section 3: Trung tâm Ký duyệt Điện tử Cấp cao (Executive Approvals) -->
                    <section class="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm mb-space-lg">
                            <div class="flex items-center gap-space-sm">
                                <div
                                    class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary">
                                    <span class="material-symbols-outlined text-[24px]">draw</span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight">Trung
                                            Tâm Ký Duyệt Điện Tử Cấp Cao</h2>
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-bold">3
                                            Tờ Trình Cần Ký</span>
                                    </div>
                                    <p class="font-body-sm text-body-sm text-outline">Các văn bản chiến lược đệ trình
                                        cần Tổng Giám đốc ký duyệt chính thức bằng Token Chữ Ký Số.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-space-xs self-start">
                                <span class="font-label-sm text-label-sm text-outline uppercase font-semibold">Xác
                                    thực:</span>
                                <span
                                    class="px-2.5 py-1 rounded-lg bg-surface-container font-label-md text-label-md text-tertiary-container font-bold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">token</span> HSM Hardware OK
                                </span>
                            </div>
                        </div>
                        <!-- Table of Approvals -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr
                                        class="bg-surface-container-low text-outline font-label-sm text-label-sm uppercase tracking-wider">
                                        <th class="py-3 px-space-md rounded-l-xl">Mã &amp; Tờ trình</th>
                                        <th class="py-3 px-space-md">Đơn vị đệ trình</th>
                                        <th class="py-3 px-space-md">Nội dung tóm tắt</th>
                                        <th class="py-3 px-space-md">Hạn xử lý</th>
                                        <th class="py-3 px-space-md rounded-r-xl text-right">Tác vụ phê duyệt</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y-0 space-y-2">
                                    <!-- Row 1 -->
                                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                                        <td class="py-space-md px-space-md">
                                            <div class="flex items-center gap-space-sm">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center text-primary font-bold font-label-sm text-label-sm">
                                                    01
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-body-md-bold text-body-md-bold text-on-surface">Bổ
                                                        nhiệm Phó Trưởng phòng Kinh doanh</span>
                                                    <span
                                                        class="font-body-sm text-body-sm text-outline">DOC-2024-HRD-089</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-md text-label-md text-on-surface font-semibold">Phạm
                                                    Hoàng Minh</span>
                                                <span class="font-body-sm text-body-sm text-outline">Giám đốc Nhân sự
                                                    (HRD)</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md max-w-xs">
                                            <p class="font-body-sm text-body-sm text-on-surface-variant truncate">
                                                Đề xuất bổ nhiệm ứng viên <strong class="text-primary font-semibold">Lê
                                                    Hải Anh</strong> (Hiệu suất 140% KPI 2 quý liên tiếp).
                                            </p>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <span
                                                class="inline-flex items-center gap-1 font-label-sm text-label-sm text-error font-semibold bg-error-container/40 px-2 py-0.5 rounded">
                                                <span class="material-symbols-outlined text-[14px]">alarm</span> Hôm
                                                nay (17:00)
                                            </span>
                                        </td>
                                        <td class="py-space-md px-space-md text-right">
                                            <div class="flex items-center justify-end gap-space-xs">
                                                <button
                                                    class="px-3 py-1.5 rounded-lg bg-surface-container-high text-on-surface font-label-md text-label-md hover:bg-surface-container transition-colors">
                                                    Chi tiết
                                                </button>
                                                <button
                                                    class="px-4 py-1.5 rounded-lg bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md transition-all shadow-sm flex items-center gap-1.5 active:scale-95"
                                                    onclick="approveDocument('DOC-2024-HRD-089')">
                                                    <span
                                                        class="material-symbols-outlined text-[16px]">fingerprint</span>
                                                    <span>Xem &amp; Ký số Token</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Row 2 -->
                                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                                        <td class="py-space-md px-space-md">
                                            <div class="flex items-center gap-space-sm">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center text-primary font-bold font-label-sm text-label-sm">
                                                    02
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-body-md-bold text-body-md-bold text-on-surface">Điều
                                                        chỉnh khung lương định kỳ năm 2025</span>
                                                    <span
                                                        class="font-body-sm text-body-sm text-outline">DOC-2024-C&amp;B-014</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-md text-label-md text-on-surface font-semibold">Khối
                                                    Tài chính &amp; HR</span>
                                                <span class="font-body-sm text-body-sm text-outline">Hội đồng Tiền
                                                    lương</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md max-w-xs">
                                            <p class="font-body-sm text-body-sm text-on-surface-variant truncate">
                                                Tăng trung bình <strong
                                                    class="text-tertiary font-semibold">+7.2%</strong> cho dải nhân sự
                                                cấp Level 3 - Level 5.
                                            </p>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <span class="font-label-sm text-label-sm text-outline">28/09/2024</span>
                                        </td>
                                        <td class="py-space-md px-space-md text-right">
                                            <div class="flex items-center justify-end gap-space-xs">
                                                <button
                                                    class="px-3 py-1.5 rounded-lg bg-surface-container-high text-on-surface font-label-md text-label-md hover:bg-surface-container transition-colors">
                                                    Chi tiết
                                                </button>
                                                <button
                                                    class="px-4 py-1.5 rounded-lg bg-secondary hover:bg-on-secondary-container text-on-secondary font-label-md text-label-md transition-all shadow-sm flex items-center gap-1.5 active:scale-95"
                                                    onclick="approveDocument('DOC-2024-C&amp;B-014')">
                                                    <span
                                                        class="material-symbols-outlined text-[16px]">edit_document</span>
                                                    <span>Xem &amp; Phê duyệt</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Row 3 -->
                                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                                        <td class="py-space-md px-space-md">
                                            <div class="flex items-center gap-space-sm">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center text-primary font-bold font-label-sm text-label-sm">
                                                    03
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-body-md-bold text-body-md-bold text-on-surface">Ngân
                                                        sách Team building &amp; Hội nghị tại Phú Quốc</span>
                                                    <span
                                                        class="font-body-sm text-body-sm text-outline">DOC-2024-ADM-042</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-md text-label-md text-on-surface font-semibold">Ban
                                                    Văn hóa Doanh nghiệp</span>
                                                <span class="font-body-sm text-body-sm text-outline">Khối Vận hành Hành
                                                    chính</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md max-w-xs">
                                            <p class="font-body-sm text-body-sm text-on-surface-variant truncate">
                                                Tổng kinh phí dự kiến <strong class="text-primary font-semibold">680
                                                    triệu VNĐ</strong> (3 ngày 2 đêm cho 486 cán bộ CNV).
                                            </p>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <span class="font-label-sm text-label-sm text-outline">30/09/2024</span>
                                        </td>
                                        <td class="py-space-md px-space-md text-right">
                                            <div class="flex items-center justify-end gap-space-xs">
                                                <button
                                                    class="px-3 py-1.5 rounded-lg bg-surface-container-high text-on-surface font-label-md text-label-md hover:bg-surface-container transition-colors">
                                                    Chi tiết
                                                </button>
                                                <button
                                                    class="px-4 py-1.5 rounded-lg bg-tertiary-container hover:bg-tertiary text-on-primary font-label-md text-label-md transition-all shadow-sm flex items-center gap-1.5 active:scale-95"
                                                    onclick="approveDocument('DOC-2024-ADM-042')">
                                                    <span
                                                        class="material-symbols-outlined text-[16px]">price_check</span>
                                                    <span>Phê duyệt ngân sách</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <!-- Section 4: Trạng thái Tuân thủ Pháp chế & Pháp lý lao động -->
                    <section class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
                        <!-- Card Pháp chế 1: HĐLĐ Ký số -->
                        <div
                            class="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm flex items-start gap-space-md">
                            <div
                                class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center text-tertiary-container flex-shrink-0">
                                <span class="material-symbols-outlined text-[28px]">verified</span>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="font-headline-md text-headline-md text-tertiary-container font-extrabold">100%</span>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-surface-container font-label-sm text-label-sm text-tertiary font-bold">Hợp
                                        lệ</span>
                                </div>
                                <h4 class="font-body-md-bold text-body-md-bold text-on-surface mt-0.5">Hợp Đồng Lao
                                    Động Ký Số</h4>
                                <p class="font-body-sm text-body-sm text-outline mt-1">
                                    486/486 HĐLĐ đã ký số qua VNPT/Viettel CA, lưu kho mã hoá đám mây đạt chuẩn Nghị
                                    định 13/2023/NĐ-CP.
                                </p>
                            </div>
                        </div>
                        <!-- Card Pháp chế 2: BHXH & Thuế TNCN -->
                        <div
                            class="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm flex items-start gap-space-md">
                            <div
                                class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center text-secondary flex-shrink-0">
                                <span class="material-symbols-outlined text-[28px]">account_balance</span>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex items-center gap-2">
                                    <span class="font-headline-md text-headline-md text-secondary font-extrabold">Đạt
                                        Chuẩn</span>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-surface-container font-label-sm text-label-sm text-secondary font-bold">Hoàn
                                        tất T8</span>
                                </div>
                                <h4 class="font-body-md-bold text-body-md-bold text-on-surface mt-0.5">Bảo Hiểm Xã Hội
                                    &amp; Thuế TNCN</h4>
                                <p class="font-body-sm text-body-sm text-outline mt-1">
                                    Đóng đủ 100% nghĩa vụ bảo hiểm và quyết toán khấu trừ thuế TNCN định kỳ, không tồn
                                    đọng nợ đọng.
                                </p>
                            </div>
                        </div>
                        <!-- Card Pháp chế 3: Tranh chấp lao động -->
                        <div
                            class="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm flex items-start gap-space-md">
                            <div
                                class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center text-primary flex-shrink-0">
                                <span class="material-symbols-outlined text-[28px]">gavel</span>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex items-center gap-2">
                                    <span class="font-headline-md text-headline-md text-primary font-extrabold">0 Vụ
                                        Việc</span>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-surface-container-low font-label-sm text-label-sm text-primary font-bold">Tuyệt
                                        đối an toàn</span>
                                </div>
                                <h4 class="font-body-md-bold text-body-md-bold text-on-surface mt-0.5">Tranh Chấp Lao
                                    Động &amp; Khiếu Nại</h4>
                                <p class="font-body-sm text-body-sm text-outline mt-1">
                                    Hội đồng hòa giải cơ sở không ghi nhận bất kỳ tranh chấp hay đơn thư khiếu nại trong
                                    suốt 36 tháng qua.
                                </p>
                            </div>
                        </div>
                    </section>
                    <!-- Notification Toast Container (Dynamic UX) -->
                    <div class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none"
                        id="toastNotification">
                        <div
                            class="bg-primary text-on-primary px-space-lg py-space-md rounded-xl shadow-2xl flex items-center gap-space-sm">
                            <span class="material-symbols-outlined text-tertiary-fixed text-[24px]">verified</span>
                            <div class="flex flex-col">
                                <span class="font-label-md text-label-md font-bold" id="toastTitle">Thao tác thành
                                    công</span>
                                <span class="font-body-sm text-body-sm text-primary-fixed" id="toastMsg">Văn bản đã
                                    được ký số xác thực HSM</span>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function approveDocument(docId) {
                        const toast = document.getElementById('toastNotification');
                        const toastMsg = document.getElementById('toastMsg');
                        if (!toast) return;

                        toastMsg.innerText = 'Văn bản ' + docId + ' đã được Tổng Giám Đốc ký số HSM thành công.';
                        toast.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
                        toast.classList.add('translate-y-0', 'opacity-100');

                        setTimeout(() => {
                            toast.classList.remove('translate-y-0', 'opacity-100');
                            toast.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
                        }, 3500);
                    }

                    const refreshBtn = document.getElementById('refreshCockpitBtn');
                    if (refreshBtn) {
                        refreshBtn.addEventListener('click', () => {
                            const icon = refreshBtn.querySelector('.material-symbols-outlined');
                            if (icon) icon.classList.add('animate-spin');
                            setTimeout(() => {
                                if (icon) icon.classList.remove('animate-spin');
                                const toast = document.getElementById('toastNotification');
                                const toastTitle = document.getElementById('toastTitle');
                                const toastMsg = document.getElementById('toastMsg');
                                if (toast && toastTitle && toastMsg) {
                                    toastTitle.innerText = 'Đồng bộ Dữ liệu';
                                    toastMsg.innerText =
                                        'Toàn bộ chỉ số tài chính và quy mô nhân sự đã cập nhật theo thời gian thực.';
                                    toast.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
                                    toast.classList.add('translate-y-0', 'opacity-100');
                                    setTimeout(() => {
                                        toast.classList.remove('translate-y-0', 'opacity-100');
                                        toast.classList.add('translate-y-20', 'opacity-0',
                                            'pointer-events-none');
                                    }, 3000);
                                }
                            }, 700);
                        });
                    }
                </script>
            </div>

@endsection



