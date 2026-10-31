@extends('layout.app')

@section('content')
     <div class="max-w-[1440px] mx-auto p-space-lg">
                <div class="flex flex-col w-full gap-space-lg">
                    <!-- System Status Top Banner & Operator Identity -->
                    <div
                        class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-space-md bg-surface-container-lowest p-space-lg rounded-xl shadow-sm">
                        <div class="flex items-center gap-space-md">
                            <div class="w-14 h-14 rounded-xl bg-primary flex items-center justify-center shadow-md">
                                <span
                                    class="material-symbols-outlined text-on-primary text-[32px]">admin_panel_settings</span>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex items-center gap-space-sm">
                                    <span class="font-headline-lg text-headline-lg text-primary tracking-tight">Trung
                                        tâm Quản trị DevOps &amp; Hệ thống</span>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-tertiary-container text-on-tertiary-container font-label-sm text-label-sm tracking-widest uppercase">PRODUCTION
                                        HIGH-AVAILABILITY</span>
                                </div>
                                <div
                                    class="flex items-center gap-space-md font-body-sm text-body-sm text-on-surface-variant">
                                    <span class="flex items-center gap-1">
                                        <span class="w-2 h-2 rounded-full bg-secondary-container"></span>
                                        Super Admin: <strong class="font-body-md-bold text-on-surface">Vũ Minh
                                            Đức</strong> (ID: ADM-001)
                                    </span>
                                    <span class="text-outline">•</span>
                                    <span>Cụm máy chủ: <code
                                            class="font-label-sm text-secondary bg-surface-container-low px-1.5 py-0.5 rounded">VNPT-HN-IDC-04</code></span>
                                    <span class="text-outline">•</span>
                                    <span class="font-label-md text-label-md text-primary font-mono"
                                        id="system-clock">14:42:19 ICT</span>
                                </div>
                            </div>
                        </div>
                        <!-- Quick Operations Toolbar -->
                        <div class="flex items-center gap-space-sm flex-wrap">
                            <button
                                class="flex items-center gap-1.5 px-3.5 py-2.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-primary font-label-md text-label-md transition-all shadow-sm"
                                id="btn-backup" onclick="triggerBackup()">
                                <span class="material-symbols-outlined text-[18px]">cloud_sync</span>
                                <span>Sao lưu Database</span>
                            </button>
                            <button
                                class="flex items-center gap-1.5 px-3.5 py-2.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-secondary font-label-md text-label-md transition-all shadow-sm"
                                id="btn-cache" onclick="clearRedisCache()">
                                <span class="material-symbols-outlined text-[18px]">cached</span>
                                <span>Xóa Cache Redis/CDN</span>
                            </button>
                            <button
                                class="flex items-center gap-1.5 px-3.5 py-2.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md transition-all shadow-sm"
                                id="btn-sync" onclick="syncAD()">
                                <span class="material-symbols-outlined text-[18px]">sync_alt</span>
                                <span>Đồng bộ Azure AD</span>
                            </button>
                            <button
                                class="flex items-center gap-1.5 px-3.5 py-2.5 rounded-lg bg-error-container hover:bg-error/20 text-on-error-container font-label-md text-label-md transition-all shadow-sm"
                                id="btn-maint" onclick="toggleMaintenance()">
                                <span class="material-symbols-outlined text-[18px]">construction</span>
                                <span>Chế độ bảo trì</span>
                            </button>
                        </div>
                    </div>
                    <!-- Operational Health & Live Telemetry Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-space-md">
                        <!-- Card 1: System Uptime -->
                        <div
                            class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col justify-between relative overflow-hidden">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Độ
                                        khả dụng (SLA: 99.90%)</span>
                                    <span class="font-headline-xl text-headline-xl text-primary mt-1">99.98%</span>
                                </div>
                                <div
                                    class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined text-[26px]">verified</span>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-col gap-1.5">
                                <div class="flex justify-between font-label-sm text-label-sm text-on-surface-variant">
                                    <span>Chu kỳ liên tục: 42 ngày 18h</span>
                                    <span class="text-tertiary font-bold">Hoạt động ổn định</span>
                                </div>
                                <div class="w-full bg-surface-container-high h-2 rounded-full overflow-hidden flex">
                                    <div class="bg-secondary-container h-full rounded-full" style="width: 99.98%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2: Active User Sessions -->
                        <div
                            class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col justify-between">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span
                                        class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Phiên
                                        người dùng đồng thời</span>
                                    <div class="flex items-baseline gap-2 mt-1">
                                        <span class="font-headline-xl text-headline-xl text-primary"
                                            id="active-session-count">194</span>
                                        <span class="font-label-sm text-label-sm text-secondary font-semibold">trực
                                            tuyến</span>
                                    </div>
                                </div>
                                <div
                                    class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[26px]">group</span>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between pt-2">
                                <span class="font-body-sm text-body-sm text-on-surface-variant">Đỉnh điểm hôm nay:
                                    <strong>328 lúc 08:35</strong></span>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-surface-container font-label-sm text-label-sm text-secondary">WebSocket
                                    OK</span>
                            </div>
                        </div>
                        <!-- Card 3: CPU Usage -->
                        <div
                            class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col justify-between">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Tải
                                        CPU Máy chủ chính</span>
                                    <span class="font-headline-xl text-headline-xl text-primary mt-1">26%</span>
                                </div>
                                <div
                                    class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined text-[26px]">memory</span>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-col gap-1.5">
                                <div class="flex justify-between font-label-sm text-label-sm text-on-surface-variant">
                                    <span>8 vCPU @ 3.4 GHz</span>
                                    <span class="text-secondary font-bold">Ngưỡng an toàn</span>
                                </div>
                                <div class="w-full bg-surface-container-high h-2 rounded-full overflow-hidden flex">
                                    <div class="bg-secondary-container h-full rounded-full transition-all duration-500"
                                        style="width: 26%"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4: RAM & DB Storage -->
                        <div
                            class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col justify-between">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Bộ
                                        nhớ RAM &amp; Database</span>
                                    <div class="flex items-baseline gap-1 mt-1">
                                        <span class="font-headline-xl text-headline-xl text-primary">48%</span>
                                        <span class="font-label-md text-label-md text-outline">/ 16 GB</span>
                                    </div>
                                </div>
                                <div
                                    class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[26px]">database</span>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-col gap-1.5">
                                <div class="flex justify-between font-label-sm text-label-sm text-on-surface-variant">
                                    <span>7.68 GB sử dụng</span>
                                    <span>PostgreSQL v16.2</span>
                                </div>
                                <div class="w-full bg-surface-container-high h-2 rounded-full overflow-hidden flex">
                                    <div class="bg-primary h-full rounded-full" style="width: 48%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FaceID Terminals Telemetry Grid -->
                    <div
                        class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col gap-space-md">
                        <div class="flex items-center justify-between flex-wrap gap-space-sm">
                            <div class="flex items-center gap-space-sm">
                                <div
                                    class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[20px]">linked_camera</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-headline-sm text-headline-sm text-on-surface">Mạng lưới Máy chấm
                                        công FaceID Văn phòng</span>
                                    <span class="font-body-sm text-body-sm text-outline">Hạ tầng IoT đồng bộ vân tay
                                        &amp; nhận diện khuôn mặt sinh trắc học</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-space-sm">
                                <span
                                    class="px-3 py-1 rounded-full bg-surface-container-high text-primary font-label-md text-label-md font-bold">
                                    Trạng thái kết nối: 6/6 Online
                                </span>
                                <button
                                    class="p-2 rounded-lg hover:bg-surface-container text-outline hover:text-on-surface transition-colors"
                                    onclick="pingFaceDevices()" title="Ping kiểm tra toàn bộ">
                                    <span class="material-symbols-outlined text-[20px]">refresh</span>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-space-sm">
                            <!-- Device 1 -->
                            <div
                                class="bg-surface-container-low p-3.5 rounded-xl flex flex-col justify-between gap-2 shadow-sm hover:shadow transition-shadow">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="font-label-sm text-label-sm font-mono text-primary font-bold">FaceID-T01</span>
                                    <span
                                        class="w-2.5 h-2.5 rounded-full bg-secondary-container shadow-[0_0_8px_#39b8fd]"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="font-label-md text-label-md text-on-surface font-semibold truncate">Sảnh
                                        chính Tòa nhà</span>
                                    <span class="font-body-sm text-body-sm text-outline">IP: 192.168.10.11</span>
                                </div>
                                <div
                                    class="flex justify-between items-center text-on-surface-variant font-label-sm text-label-sm pt-1">
                                    <span>Latency: 12ms</span>
                                    <span class="text-tertiary">Hoạt động</span>
                                </div>
                            </div>
                            <!-- Device 2 -->
                            <div
                                class="bg-surface-container-low p-3.5 rounded-xl flex flex-col justify-between gap-2 shadow-sm hover:shadow transition-shadow">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="font-label-sm text-label-sm font-mono text-primary font-bold">FaceID-T02</span>
                                    <span
                                        class="w-2.5 h-2.5 rounded-full bg-secondary-container shadow-[0_0_8px_#39b8fd]"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="font-label-md text-label-md text-on-surface font-semibold truncate">Sảnh
                                        B2 (Nhà xe)</span>
                                    <span class="font-body-sm text-body-sm text-outline">IP: 192.168.10.12</span>
                                </div>
                                <div
                                    class="flex justify-between items-center text-on-surface-variant font-label-sm text-label-sm pt-1">
                                    <span>Latency: 16ms</span>
                                    <span class="text-tertiary">Hoạt động</span>
                                </div>
                            </div>
                            <!-- Device 3 -->
                            <div
                                class="bg-surface-container-low p-3.5 rounded-xl flex flex-col justify-between gap-2 shadow-sm hover:shadow transition-shadow">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="font-label-sm text-label-sm font-mono text-primary font-bold">FaceID-T03</span>
                                    <span
                                        class="w-2.5 h-2.5 rounded-full bg-secondary-container shadow-[0_0_8px_#39b8fd]"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="font-label-md text-label-md text-on-surface font-semibold truncate">Tầng
                                        5 (Khối Tech)</span>
                                    <span class="font-body-sm text-body-sm text-outline">IP: 192.168.10.15</span>
                                </div>
                                <div
                                    class="flex justify-between items-center text-on-surface-variant font-label-sm text-label-sm pt-1">
                                    <span>Latency: 8ms</span>
                                    <span class="text-tertiary">Hoạt động</span>
                                </div>
                            </div>
                            <!-- Device 4 -->
                            <div
                                class="bg-surface-container-low p-3.5 rounded-xl flex flex-col justify-between gap-2 shadow-sm hover:shadow transition-shadow">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="font-label-sm text-label-sm font-mono text-primary font-bold">FaceID-T04</span>
                                    <span
                                        class="w-2.5 h-2.5 rounded-full bg-secondary-container shadow-[0_0_8px_#39b8fd]"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="font-label-md text-label-md text-on-surface font-semibold truncate">Tầng
                                        6 (Khối Vận hành)</span>
                                    <span class="font-body-sm text-body-sm text-outline">IP: 192.168.10.16</span>
                                </div>
                                <div
                                    class="flex justify-between items-center text-on-surface-variant font-label-sm text-label-sm pt-1">
                                    <span>Latency: 14ms</span>
                                    <span class="text-tertiary">Hoạt động</span>
                                </div>
                            </div>
                            <!-- Device 5 -->
                            <div
                                class="bg-surface-container-low p-3.5 rounded-xl flex flex-col justify-between gap-2 shadow-sm hover:shadow transition-shadow">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="font-label-sm text-label-sm font-mono text-primary font-bold">FaceID-T05</span>
                                    <span
                                        class="w-2.5 h-2.5 rounded-full bg-secondary-container shadow-[0_0_8px_#39b8fd]"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="font-label-md text-label-md text-on-surface font-semibold truncate">Tầng
                                        8 (Phòng Họp &amp; BLĐ)</span>
                                    <span class="font-body-sm text-body-sm text-outline">IP: 192.168.10.18</span>
                                </div>
                                <div
                                    class="flex justify-between items-center text-on-surface-variant font-label-sm text-label-sm pt-1">
                                    <span>Latency: 10ms</span>
                                    <span class="text-tertiary">Hoạt động</span>
                                </div>
                            </div>
                            <!-- Device 6 -->
                            <div
                                class="bg-surface-container-low p-3.5 rounded-xl flex flex-col justify-between gap-2 shadow-sm hover:shadow transition-shadow">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="font-label-sm text-label-sm font-mono text-primary font-bold">FaceID-T06</span>
                                    <span
                                        class="w-2.5 h-2.5 rounded-full bg-secondary-container shadow-[0_0_8px_#39b8fd]"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="font-label-md text-label-md text-on-surface font-semibold truncate">Căn
                                        tin Doanh nghiệp</span>
                                    <span class="font-body-sm text-body-sm text-outline">IP: 192.168.10.20</span>
                                </div>
                                <div
                                    class="flex justify-between items-center text-on-surface-variant font-label-sm text-label-sm pt-1">
                                    <span>Latency: 22ms</span>
                                    <span class="text-tertiary">Hoạt động</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- RBAC Matrix & Access Management Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
                        <!-- Left: RBAC Matrix Stats & Distribution -->
                        <div
                            class="lg:col-span-5 bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-space-md">
                                    <div class="flex items-center gap-space-sm">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined text-[20px]">manage_accounts</span>
                                        </div>
                                        <span class="font-headline-sm text-headline-sm text-on-surface">Ma trận Phân
                                            quyền (RBAC)</span>
                                    </div>
                                    <span
                                        class="px-2.5 py-1 rounded-full bg-surface-container font-label-sm text-label-sm text-on-surface-variant">Tổng:
                                        245 Tài khoản</span>
                                </div>
                                <div class="space-y-3">
                                    <!-- Role 1 -->
                                    <div
                                        class="flex items-center justify-between p-3 rounded-lg bg-surface-container-low">
                                        <div class="flex items-center gap-space-sm">
                                            <span class="w-2.5 h-2.5 rounded-full bg-secondary"></span>
                                            <div class="flex flex-col">
                                                <span class="font-label-md text-label-md text-on-surface font-bold">Cán
                                                    bộ Nhân viên</span>
                                                <span class="font-body-sm text-body-sm text-outline">Quyền: Chấm công,
                                                    đơn từ cá nhân</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="font-headline-sm text-headline-sm text-primary">182</span>
                                            <span class="block font-label-sm text-label-sm text-outline">74.3%</span>
                                        </div>
                                    </div>
                                    <!-- Role 2 -->
                                    <div
                                        class="flex items-center justify-between p-3 rounded-lg bg-surface-container-low">
                                        <div class="flex items-center gap-space-sm">
                                            <span class="w-2.5 h-2.5 rounded-full bg-secondary-container"></span>
                                            <div class="flex flex-col">
                                                <span class="font-label-md text-label-md text-on-surface font-bold">Phó
                                                    phòng / Quản lý ca</span>
                                                <span class="font-body-sm text-body-sm text-outline">Quyền: Duyệt phép,
                                                    kiểm soát ca bộ phận</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="font-headline-sm text-headline-sm text-primary">32</span>
                                            <span class="block font-label-sm text-label-sm text-outline">13.1%</span>
                                        </div>
                                    </div>
                                    <!-- Role 3 -->
                                    <div
                                        class="flex items-center justify-between p-3 rounded-lg bg-surface-container-low">
                                        <div class="flex items-center gap-space-sm">
                                            <span class="w-2.5 h-2.5 rounded-full bg-primary-container"></span>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-md text-label-md text-on-surface font-bold">Chuyên
                                                    viên HR &amp; C&amp;B</span>
                                                <span class="font-body-sm text-body-sm text-outline">Quyền: Tính lương,
                                                    hồ sơ nhân sự, bảo hiểm</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="font-headline-sm text-headline-sm text-primary">12</span>
                                            <span class="block font-label-sm text-label-sm text-outline">4.9%</span>
                                        </div>
                                    </div>
                                    <!-- Role 4 -->
                                    <div
                                        class="flex items-center justify-between p-3 rounded-lg bg-surface-container-low">
                                        <div class="flex items-center gap-space-sm">
                                            <span class="w-2.5 h-2.5 rounded-full bg-tertiary"></span>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-md text-label-md text-on-surface font-bold">Giám
                                                    đốc Khối / Ban điều hành</span>
                                                <span class="font-body-sm text-body-sm text-outline">Quyền: Phê duyệt
                                                    cấp cao, xem báo cáo KPI</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="font-headline-sm text-headline-sm text-primary">14</span>
                                            <span class="block font-label-sm text-label-sm text-outline">5.7%</span>
                                        </div>
                                    </div>
                                    <!-- Role 5 -->
                                    <div
                                        class="flex items-center justify-between p-3 rounded-lg bg-surface-container-low">
                                        <div class="flex items-center gap-space-sm">
                                            <span class="w-2.5 h-2.5 rounded-full bg-error"></span>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-md text-label-md text-on-surface font-bold">Quản
                                                    trị viên Hệ thống (Admin)</span>
                                                <span class="font-body-sm text-body-sm text-outline">Quyền: DevOps,
                                                    RBAC, Cấu hình lõi</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="font-headline-sm text-headline-sm text-primary">5</span>
                                            <span class="block font-label-sm text-label-sm text-outline">2.0%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mt-space-md pt-space-md bg-surface-container-low p-space-md rounded-xl flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="material-symbols-outlined text-secondary text-[20px]">security_update_good</span>
                                    <span class="font-body-sm text-body-sm text-on-surface">Chính sách mật khẩu &amp;
                                        MFA 2FA</span>
                                </div>
                                <span
                                    class="px-2 py-0.5 rounded bg-surface-container-highest text-primary font-label-sm text-label-sm font-semibold">Bắt
                                    buộc toàn tổ chức</span>
                            </div>
                        </div>
                        <!-- Right: Security Lockouts & Incidents Queue -->
                        <div
                            class="lg:col-span-7 bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-space-md">
                                    <div class="flex items-center gap-space-sm">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-error-container flex items-center justify-center text-on-error-container">
                                            <span class="material-symbols-outlined text-[20px]">lock_reset</span>
                                        </div>
                                        <div>
                                            <span class="font-headline-sm text-headline-sm text-on-surface">Tài khoản
                                                Cảnh báo Cần can thiệp khẩn</span>
                                            <span class="block font-body-sm text-body-sm text-outline">Phát hiện tự
                                                động bởi tường lửa WAF &amp; Identity Guard</span>
                                        </div>
                                    </div>
                                    <span
                                        class="px-3 py-1 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-bold">
                                        1 Tài khoản bị khóa
                                    </span>
                                </div>
                                <!-- Incident Detailed Alert Card -->
                                <div class="bg-surface-container-low p-space-md rounded-xl flex flex-col gap-space-md"
                                    id="incident-card">
                                    <div class="flex items-start justify-between gap-space-sm">
                                        <div class="flex items-center gap-space-sm">
                                            <div
                                                class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center text-primary font-headline-sm">
                                                NM
                                            </div>
                                            <div class="flex flex-col">
                                                <div class="flex items-center gap-2">
                                                    <span
                                                        class="font-body-md-bold text-body-md-bold text-on-surface">Nguyễn
                                                        Thị Mai</span>
                                                    <span
                                                        class="px-2 py-0.5 rounded bg-surface-container text-on-surface-variant font-label-sm text-label-sm">HR
                                                        Specialist</span>
                                                </div>
                                                <span class="font-body-sm text-body-sm text-outline">Email:
                                                    mai.nguyen@lihkn.vn • Mã NV: LK-089</span>
                                            </div>
                                        </div>
                                        <span
                                            class="px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                                            Khóa tạm thời
                                        </span>
                                    </div>
                                    <div
                                        class="p-3 rounded-lg bg-surface-container flex flex-col gap-1 font-body-sm text-body-sm text-on-surface">
                                        <div class="flex items-center gap-1.5 text-error font-medium">
                                            <span class="material-symbols-outlined text-[16px]">warning</span>
                                            <span>Lý do khóa: Nhập sai mã OTP xác thực quá 5 lần liên tiếp trong vòng 3
                                                phút</span>
                                        </div>
                                        <div class="flex items-center justify-between text-outline text-body-sm mt-1">
                                            <span>Nguồn yêu cầu: Cổng Web HRM (Chrome Windows)</span>
                                            <span>IP: 14.161.42.88 (FPT Telecom)</span>
                                            <span>Thời điểm: 14:38:04 hôm nay</span>
                                        </div>
                                    </div>
                                    <!-- Action Buttons for Super Admin -->
                                    <div class="flex items-center justify-end gap-space-sm pt-2 flex-wrap">
                                        <button
                                            class="px-3 py-2 rounded-lg bg-surface-container text-on-surface-variant hover:bg-surface-container-high font-label-md text-label-md transition-colors"
                                            onclick="revokePrivilege()">
                                            Thu hồi quyền
                                        </button>
                                        <button
                                            class="px-3.5 py-2 rounded-lg bg-surface-container-highest text-primary hover:bg-surface-container-high font-label-md text-label-md transition-colors"
                                            onclick="resetPasswordModal()">
                                            Đặt lại mật khẩu &amp; gửi SMS
                                        </button>
                                        <button
                                            class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md shadow-sm transition-all"
                                            id="btn-unlock" onclick="unlockAccountNow()">
                                            <span class="material-symbols-outlined text-[18px]">lock_open</span>
                                            <span>Mở khóa tài khoản ngay</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- Secondary Informative Card -->
                                <div
                                    class="mt-space-md p-space-md rounded-xl bg-surface-container-low flex items-center justify-between">
                                    <div class="flex items-center gap-space-sm">
                                        <span
                                            class="material-symbols-outlined text-secondary text-[24px]">vpn_key_alert</span>
                                        <div class="flex flex-col">
                                            <span class="font-label-md text-label-md text-on-surface font-semibold">Tự
                                                động quét đặc quyền định kỳ</span>
                                            <span class="font-body-sm text-body-sm text-outline">Không có tài khoản nào
                                                có dấu hiệu leo thang quyền bất thường (Privilege Escalation:
                                                Clean)</span>
                                        </div>
                                    </div>
                                    <span class="font-label-sm text-label-sm text-tertiary font-bold">0 PHÁT
                                        HIỆN</span>
                                </div>
                            </div>
                            <div
                                class="pt-space-md flex items-center justify-between font-body-sm text-body-sm text-outline">
                                <span>Phiên đăng nhập Admin được ký chữ ký số TLS 1.3</span>
                                <span>Mã phiên: SEC-AUTH-90422</span>
                            </div>
                        </div>
                    </div>
                    <!-- Live Security Audit Log Table -->
                    <div
                        class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col gap-space-md">
                        <div
                            class="flex flex-col md:flex-row items-start md:items-center justify-between gap-space-sm">
                            <div class="flex items-center gap-space-sm">
                                <div
                                    class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[20px]">security</span>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2">
                                        <span class="font-headline-sm text-headline-sm text-on-surface">Nhật ký Kiểm
                                            toán An ninh Thời gian thực</span>
                                        <span class="flex h-2 w-2 relative">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary-container opacity-75"></span>
                                            <span
                                                class="relative inline-flex rounded-full h-2 w-2 bg-secondary"></span>
                                        </span>
                                    </div>
                                    <span class="font-body-sm text-body-sm text-outline">Ghi nhận mọi thao tác truy cập
                                        dữ liệu nhạy cảm, chấm công và xác thực</span>
                                </div>
                            </div>
                            <!-- Filters & Export -->
                            <div class="flex items-center gap-space-sm flex-wrap">
                                <div class="relative">
                                    <input
                                        class="pl-9 pr-3 py-2 rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm focus:outline-none focus:bg-surface-container-lowest shadow-sm w-64 transition-all"
                                        id="log-search" oninput="filterLogs()"
                                        placeholder="Lọc theo IP, User hoặc Hành động..." type="text" />
                                    <span
                                        class="material-symbols-outlined absolute left-2.5 top-2.5 text-outline text-[18px]">search</span>
                                </div>
                                <select
                                    class="px-3 py-2 rounded-lg bg-surface-container-low text-on-surface font-label-md text-label-md focus:outline-none cursor-pointer"
                                    id="risk-filter" onchange="filterLogs()">
                                    <option value="ALL">Mọi mức rủi ro</option>
                                    <option value="HIGH">Cảnh báo cao (High)</option>
                                    <option value="MED">Trung bình (Medium)</option>
                                    <option value="LOW">Bình thường (Low / Info)</option>
                                </select>
                                <button
                                    class="flex items-center gap-1.5 px-3 py-2 rounded-lg bg-surface-container hover:bg-surface-container-high text-primary font-label-md text-label-md transition-colors"
                                    onclick="exportLogsCSV()">
                                    <span class="material-symbols-outlined text-[18px]">file_download</span>
                                    <span>Xuất CSV Log</span>
                                </button>
                            </div>
                        </div>
                        <!-- Audit Log Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left font-body-sm text-body-sm">
                                <thead>
                                    <tr
                                        class="bg-surface-container-low text-outline font-label-sm text-label-sm uppercase tracking-wider">
                                        <th class="py-3 px-4 rounded-l-lg">Thời điểm (Timestamp)</th>
                                        <th class="py-3 px-4">Địa chỉ IP &amp; Thiết bị</th>
                                        <th class="py-3 px-4">Tài khoản thao tác</th>
                                        <th class="py-3 px-4">Hành động chi tiết</th>
                                        <th class="py-3 px-4">Mức độ rủi ro</th>
                                        <th class="py-3 px-4 text-right rounded-r-lg">Kiểm tra</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-surface-container" id="audit-log-body">
                                    <!-- Row 1: High Alert Geo IP -->
                                    <tr class="hover:bg-surface-container-low/60 transition-colors log-row"
                                        data-risk="HIGH"
                                        data-text="14:41:02 113.190.23.44 pham.an Canh bao dang nhap IP la">
                                        <td class="py-3 px-4 font-mono text-outline whitespace-nowrap">14:41:02.108
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-mono text-on-surface font-semibold">113.190.23.44</span>
                                                <span class="text-outline text-body-sm">Hà Nội (Viettel WAN)</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-6 h-6 rounded-full bg-surface-container flex items-center justify-center font-label-sm text-label-sm text-on-surface">
                                                    PA</div>
                                                <div class="flex flex-col">
                                                    <span class="font-body-md-bold text-on-surface">pham.an</span>
                                                    <span class="text-outline text-body-sm">Tech Lead</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex flex-col">
                                                <span class="text-on-surface font-medium">Cảnh báo đăng nhập từ IP lạ
                                                    ngoài dải mạng văn phòng</span>
                                                <span class="text-outline text-body-sm">Device: MacOS 14.4 Sonoma
                                                    (Safari Mobile UA)</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span
                                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-bold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                                                RỦI RO CAO
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-right">
                                            <button
                                                class="p-1.5 rounded hover:bg-surface-container text-primary hover:text-primary-container"
                                                onclick="inspectLog('LOG-9821')">
                                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Row 2: Payroll Export with 2FA success -->
                                    <tr class="hover:bg-surface-container-low/60 transition-colors log-row"
                                        data-risk="MED"
                                        data-text="14:35:12 192.168.10.104 tran.lanh Xuat du lieu bang luong Q1 2FA">
                                        <td class="py-3 px-4 font-mono text-outline whitespace-nowrap">14:35:12.450
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-mono text-on-surface font-semibold">192.168.10.104</span>
                                                <span class="text-outline text-body-sm">Văn phòng Tầng 6 (LAN
                                                    C&amp;B)</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-6 h-6 rounded-full bg-surface-container flex items-center justify-center font-label-sm text-label-sm text-on-surface">
                                                    TL</div>
                                                <div class="flex flex-col">
                                                    <span class="font-body-md-bold text-on-surface">tran.lanh</span>
                                                    <span class="text-outline text-body-sm">HR Manager</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex flex-col">
                                                <span class="text-on-surface font-medium">Xuất dữ liệu bảng lương
                                                    Q1-2025 (File .xlsx mã hóa)</span>
                                                <span class="text-secondary font-body-sm flex items-center gap-1">
                                                    <span
                                                        class="material-symbols-outlined text-[14px]">verified_user</span>
                                                    Xác thực 2FA OTP thành công qua Authenticator
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span
                                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-semibold">
                                                TRUNG BÌNH
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-right">
                                            <button
                                                class="p-1.5 rounded hover:bg-surface-container text-primary hover:text-primary-container"
                                                onclick="inspectLog('LOG-9820')">
                                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Row 3: Biometric Batch Sync -->
                                    <tr class="hover:bg-surface-container-low/60 transition-colors log-row"
                                        data-risk="LOW"
                                        data-text="14:30:00 192.168.10.11 FaceID-T01 Dong bo du lieu cham cong sinh trac">
                                        <td class="py-3 px-4 font-mono text-outline whitespace-nowrap">14:30:00.002
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-mono text-on-surface font-semibold">192.168.10.11</span>
                                                <span class="text-outline text-body-sm">Thiết bị FaceID-T01 Sảnh
                                                    chính</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-6 h-6 rounded-full bg-surface-container flex items-center justify-center font-label-sm text-label-sm text-on-surface">
                                                    SYS</div>
                                                <div class="flex flex-col">
                                                    <span class="font-body-md-bold text-on-surface">system.cron</span>
                                                    <span class="text-outline text-body-sm">IoT Daemon</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex flex-col">
                                                <span class="text-on-surface">Đồng bộ chu kỳ 15 phút: 142 lượt check-in
                                                    ghi nhận hợp lệ</span>
                                                <span class="text-outline text-body-sm">Payload: 28KB • Latency:
                                                    12ms</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm">
                                                THÔNG TIN (LOW)
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-right">
                                            <button
                                                class="p-1.5 rounded hover:bg-surface-container text-primary hover:text-primary-container"
                                                onclick="inspectLog('LOG-9819')">
                                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Row 4: Azure AD SSO Sync Success -->
                                    <tr class="hover:bg-surface-container-low/60 transition-colors log-row"
                                        data-risk="LOW"
                                        data-text="14:15:00 20.198.112.4 Azure-SSO Dong bo danh ba AD">
                                        <td class="py-3 px-4 font-mono text-outline whitespace-nowrap">14:15:00.312
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-mono text-on-surface font-semibold">20.198.112.4</span>
                                                <span class="text-outline text-body-sm">Microsoft Azure AD Cloud</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-6 h-6 rounded-full bg-surface-container flex items-center justify-center font-label-sm text-label-sm text-on-surface">
                                                    AD</div>
                                                <div class="flex flex-col">
                                                    <span class="font-body-md-bold text-on-surface">azure.sync</span>
                                                    <span class="text-outline text-body-sm">Enterprise SAML 2.0</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex flex-col">
                                                <span class="text-on-surface">Đồng bộ danh bạ định kỳ: 245 tài khoản
                                                    active, 0 tài khoản mới</span>
                                                <span class="text-outline text-body-sm">Scope:
                                                    OU=LiHKn-Vietnam,DC=lihkn,DC=vn</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm">
                                                THÔNG TIN (LOW)
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-right">
                                            <button
                                                class="p-1.5 rounded hover:bg-surface-container text-primary hover:text-primary-container"
                                                onclick="inspectLog('LOG-9818')">
                                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Audit Footer / Pagination -->
                        <div
                            class="flex items-center justify-between pt-space-xs font-body-sm text-body-sm text-outline flex-wrap gap-2">
                            <span>Hiển thị 4 trong tổng số 8,421 bản ghi log hôm nay (Lưu trữ nén 365 ngày trên S3
                                Vault)</span>
                            <div class="flex items-center gap-1">
                                <button
                                    class="px-2.5 py-1 rounded bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm">Trước</button>
                                <span class="px-2 font-label-sm text-label-sm text-primary font-bold">Trang 1 /
                                    210</span>
                                <button
                                    class="px-2.5 py-1 rounded bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm">Tiếp
                                    theo</button>
                            </div>
                        </div>
                    </div>
                    <!-- Realtime Notification Toast Container (Dynamic) -->
                    <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-2 pointer-events-none"
                        id="toast-container"></div>
                </div>
                <script>
                    // Real-time clock display
                    function updateClock() {
                        const el = document.getElementById('system-clock');
                        if (!el) return;
                        const now = new Date();
                        const hrs = String(now.getHours()).padStart(2, '0');
                        const mins = String(now.getMinutes()).padStart(2, '0');
                        const secs = String(now.getSeconds()).padStart(2, '0');
                        el.textContent = `${hrs}:${mins}:${secs} ICT`;
                    }
                    setInterval(updateClock, 1000);

                    // Simple Notification Toast Generator
                    function showToast(message, type = 'success') {
                        const container = document.getElementById('toast-container');
                        if (!container) return;
                        const toast = document.createElement('div');
                        const isError = type === 'error';
                        toast.className = `pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg transition-all transform translate-y-2 opacity-0 ${
      isError ? 'bg-error text-on-error' : 'bg-primary text-on-primary'
    }`;
                        toast.innerHTML = `
      <span class="material-symbols-outlined text-[20px]">${isError ? 'error' : 'check_circle'}</span>
      <span class="font-body-md text-body-md">${message}</span>
    `;
                        container.appendChild(toast);

                        setTimeout(() => {
                            toast.classList.remove('translate-y-2', 'opacity-0');
                            toast.classList.add('translate-y-0', 'opacity-100');
                        }, 10);

                        setTimeout(() => {
                            toast.classList.remove('translate-y-0', 'opacity-100');
                            toast.classList.add('opacity-0');
                            setTimeout(() => toast.remove(), 300);
                        }, 4000);
                    }

                    // Quick Ops Handlers
                    function triggerBackup() {
                        const btn = document.getElementById('btn-backup');
                        btn.disabled = true;
                        btn.classList.add('opacity-50');
                        showToast('Đang khởi tạo bản chụp Snapshot Database PostgreSQL...');
                        setTimeout(() => {
                            showToast('Sao lưu thành công! File lưu trữ: pg_dump_20250422_1442.enc.tar');
                            btn.disabled = false;
                            btn.classList.remove('opacity-50');
                        }, 1800);
                    }

                    function clearRedisCache() {
                        const btn = document.getElementById('btn-cache');
                        btn.disabled = true;
                        showToast('Đang xóa bộ nhớ đệm Redis & làm mới CDN Cloudflare...');
                        setTimeout(() => {
                            showToast('Đã xóa 12,410 keys Redis. Thời gian phản hồi 4ms.');
                            btn.disabled = false;
                        }, 1200);
                    }

                    function syncAD() {
                        const btn = document.getElementById('btn-sync');
                        btn.disabled = true;
                        showToast('Đang kết nối Azure AD Graph API...');
                        setTimeout(() => {
                            showToast('Đồng bộ hoàn tất: 245 người dùng sẵn sàng, 0 sai lệch.');
                            btn.disabled = false;
                        }, 1500);
                    }

                    let maintenanceActive = false;

                    function toggleMaintenance() {
                        maintenanceActive = !maintenanceActive;
                        const btn = document.getElementById('btn-maint');
                        if (maintenanceActive) {
                            btn.classList.remove('bg-error-container', 'text-on-error-container');
                            btn.classList.add('bg-error', 'text-on-error');
                            btn.innerHTML =
                                `<span class="material-symbols-outlined text-[18px]">lock</span><span>TẮT BẢO TRÌ (ĐANG BẬT)</span>`;
                            showToast('CẢNH BÁO: Đã kích hoạt chế độ bảo trì hệ thống. Cổng nhân viên tạm dừng.', 'error');
                        } else {
                            btn.classList.remove('bg-error', 'text-on-error');
                            btn.classList.add('bg-error-container', 'text-on-error-container');
                            btn.innerHTML =
                                `<span class="material-symbols-outlined text-[18px]">construction</span><span>Chế độ bảo trì</span>`;
                            showToast('Đã tắt chế độ bảo trì. Hệ thống mở lại truy cập bình thường.');
                        }
                    }

                    // FaceID Refresh
                    function pingFaceDevices() {
                        showToast('Đang kiểm tra tín hiệu Ping 6 máy FaceID...');
                        setTimeout(() => {
                            showToast('Tất cả 6 máy chấm công FaceID phản hồi tốt (<25ms).');
                        }, 800);
                    }

                    // Account Unlock Logic
                    function unlockAccountNow() {
                        const card = document.getElementById('incident-card');
                        const btn = document.getElementById('btn-unlock');
                        btn.disabled = true;
                        btn.textContent = 'Đang xử lý...';
                        setTimeout(() => {
                            showToast('Đã mở khóa tài khoản Nguyễn Thị Mai (mai.nguyen@lihkn.vn) thành công!');
                            card.innerHTML = `
        <div class="p-4 rounded-xl bg-surface-container flex items-center justify-between text-secondary">
          <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[24px]">task_alt</span>
            <span class="font-body-md-bold">Đã xử lý mở khóa thành công cho Nguyễn Thị Mai. Lịch sử lưu vào Audit Log.</span>
          </div>
          <button onclick="location.reload()" class="px-3 py-1.5 rounded-lg bg-surface-container-high text-primary font-label-md text-label-md">Khôi phục xem</button>
        </div>
      `;
                        }, 900);
                    }

                    function resetPasswordModal() {
                        showToast('Đã sinh mật khẩu ngẫu nhiên bảo mật cao và gửi qua SMS Brandname LiHKn.');
                    }

                    function revokePrivilege() {
                        showToast('Đã thu hồi tạm thời vai trò HR Specialist của tài khoản này.', 'error');
                    }

                    // Audit Logs Filter & Search
                    function filterLogs() {
                        const query = (document.getElementById('log-search')?.value || '').toLowerCase();
                        const risk = document.getElementById('risk-filter')?.value || 'ALL';
                        const rows = document.querySelectorAll('.log-row');

                        rows.forEach(row => {
                            const rowRisk = row.getAttribute('data-risk');
                            const rowText = (row.getAttribute('data-text') || '').toLowerCase();

                            const matchesRisk = (risk === 'ALL') || (risk === rowRisk);
                            const matchesSearch = !query || rowText.includes(query);

                            if (matchesRisk && matchesSearch) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    }

                    function inspectLog(logId) {
                        showToast(`Đang tải chi tiết gói tin kiểm toán [${logId}]...`);
                    }

                    function exportLogsCSV() {
                        showToast('Đang khởi tạo file CSV xuất dữ liệu nhật ký kiểm toán...');
                    }
                </script>
            </div>
@endsection


