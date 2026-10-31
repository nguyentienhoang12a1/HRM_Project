@extends('layout.app')

@section('content')
            <div class="max-w-[1440px] mx-auto p-space-lg">
                <div class="flex flex-col w-full gap-space-lg">
                    <!-- Top Operational Banner & Quick Actions -->
                    <div
                        class="flex flex-col lg:flex-row lg:items-center justify-between gap-space-md bg-surface-container-lowest p-space-lg rounded-xl shadow-sm">
                        <div class="flex items-center gap-space-md min-w-0">
                            <div class="relative flex-shrink-0">
                                <img class="w-14 h-14 rounded-xl object-cover shadow-sm"
                                    data-alt="Chân dung nữ trưởng phòng nhân sự chuyên nghiệp châu Á đeo thẻ nhân viên công ty công nghệ, nở nụ cười tự tin trong văn phòng hiện đại ánh sáng tự nhiên xanh navy tinh tế."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAtz20b8yyXeneXpqE81QgwK5m52UfBew-FNjW2U55MlL5fBGzChqtsTXCysIbMqujT_9YPps6fxbU-EPjQxjYL2FbBFxd95aClhwVk2Z6WMmid8g-64mfqmt8UfxQI6ycqm-JKwx7t-HLRslYUY5K1T9Gs1ItOEeZlmmofn3CpWVVdCTqK-oWI5VPenFvPmjQIy7R4xv9qrwylxiND5fpHKm8LkA0ImPwQbrPYC9s" />
                                <span
                                    class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-tertiary-container flex items-center justify-center">
                                    <span
                                        class="material-symbols-outlined text-[12px] text-on-tertiary font-bold">check</span>
                                </span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <div class="flex items-center gap-space-xs flex-wrap">
                                    <h1
                                        class="font-headline-md text-headline-md text-primary tracking-tight font-bold">
                                        Phạm Mai Lan</h1>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-secondary-container/20 text-on-secondary-container font-label-sm text-label-sm font-semibold">Trưởng
                                        nhóm Vận hành HR</span>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm font-medium">Mã
                                        NV: HR-0104</span>
                                </div>
                                <p class="font-body-sm text-body-sm text-outline mt-0.5 truncate">Trung tâm Điều hành
                                    Nghiệp vụ Nhân sự LiHKn Enterprise • Kỳ vận hành: Tháng 05/2025</p>
                            </div>
                        </div>
                        <!-- Quick Action Bar -->
                        <div class="flex items-center gap-space-sm flex-wrap">
                            <button
                                class="flex items-center gap-space-xs px-3.5 py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md transition-colors shadow-sm">
                                <span class="material-symbols-outlined text-[18px] text-secondary">cloud_upload</span>
                                <span>Nhập liệu hàng loạt (Excel/CSV)</span>
                            </button>
                            <button
                                class="flex items-center gap-space-xs px-3.5 py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md transition-colors shadow-sm">
                                <span class="material-symbols-outlined text-[18px] text-secondary">campaign</span>
                                <span>Gửi Thông báo Toàn Công ty</span>
                            </button>
                            <button
                                class="flex items-center gap-space-xs px-4 py-2.5 rounded-xl bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md shadow-sm transition-all">
                                <span class="material-symbols-outlined text-[18px]">download_for_offline</span>
                                <span>Xuất Báo cáo HR Tháng</span>
                            </button>
                        </div>
                    </div>
                    <!-- KPI Overview Strip (4 cards) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-md">
                        <!-- Card 1: Tổng nhân sự -->
                        <div
                            class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col justify-between group hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Quy mô
                                    lao động</span>
                                <div
                                    class="w-8 h-8 rounded-lg bg-surface-container-high flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[18px]">group</span>
                                </div>
                            </div>
                            <div class="my-space-sm">
                                <div class="flex items-baseline gap-space-sm">
                                    <span
                                        class="font-headline-xl text-headline-xl font-bold text-on-surface">245</span>
                                    <span class="font-label-md text-label-md text-secondary font-semibold">nhân
                                        viên</span>
                                </div>
                            </div>
                            <div
                                class="flex items-center gap-space-xs text-tertiary-container font-label-sm text-label-sm">
                                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                                <span class="font-bold">+8 nhân sự</span>
                                <span class="text-outline font-normal">(+3.4% so với tháng trước)</span>
                            </div>
                        </div>
                        <!-- Card 2: Tỷ lệ có mặt -->
                        <div
                            class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col justify-between group hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Hiện
                                    diện hôm nay</span>
                                <div
                                    class="w-8 h-8 rounded-lg bg-secondary-container/20 flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined text-[18px]">fingerprint</span>
                                </div>
                            </div>
                            <div class="my-space-sm">
                                <div class="flex items-baseline gap-space-sm">
                                    <span
                                        class="font-headline-xl text-headline-xl font-bold text-on-surface">97.5%</span>
                                    <span class="font-label-md text-label-md text-outline">239/245 NV</span>
                                </div>
                            </div>
                            <div class="w-full bg-surface-container rounded-full h-1.5 overflow-hidden">
                                <div class="bg-secondary-container h-1.5 rounded-full" style="width: 97.5%"></div>
                            </div>
                        </div>
                        <!-- Card 3: Tỷ lệ Turnover -->
                        <div
                            class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col justify-between group hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Biến
                                    động (Turnover)</span>
                                <div
                                    class="w-8 h-8 rounded-lg bg-tertiary-fixed-dim/30 flex items-center justify-center text-tertiary">
                                    <span class="material-symbols-outlined text-[18px]">sync_alt</span>
                                </div>
                            </div>
                            <div class="my-space-sm">
                                <div class="flex items-baseline gap-space-sm">
                                    <span
                                        class="font-headline-xl text-headline-xl font-bold text-on-surface">1.6%</span>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed-variant font-label-sm text-label-sm">An
                                        toàn</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-outline font-label-sm text-label-sm">
                                <span>Ngưỡng chuẩn LiHKn: &lt; 3.0%</span>
                                <span class="text-tertiary font-medium">Kiểm soát tốt</span>
                            </div>
                        </div>
                        <!-- Card 4: Cost per Hire -->
                        <div
                            class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col justify-between group hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Chi phí
                                    tuyển TB</span>
                                <div
                                    class="w-8 h-8 rounded-lg bg-primary-fixed flex items-center justify-center text-primary-container">
                                    <span class="material-symbols-outlined text-[18px]">paid</span>
                                </div>
                            </div>
                            <div class="my-space-sm">
                                <div class="flex items-baseline gap-space-sm">
                                    <span
                                        class="font-headline-xl text-headline-xl font-bold text-on-surface">8.2</span>
                                    <span class="font-label-md text-label-md text-outline">tr VNĐ / vị trí</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-space-xs text-outline font-label-sm text-label-sm">
                                <span
                                    class="material-symbols-outlined text-[16px] text-tertiary-container">arrow_downward</span>
                                <span>Tiết kiệm 14% nhờ kênh nội bộ</span>
                            </div>
                        </div>
                    </div>
                    <!-- Multi-column Dashboard Layout (3 Operational Columns) -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-lg items-start">
                        <!-- COLUMN 1: Chốt công & Tính lương -->
                        <div
                            class="flex flex-col gap-space-md bg-surface-container-lowest p-space-lg rounded-xl shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-space-xs">
                                    <div class="w-2.5 h-2.5 rounded-full bg-primary-container"></div>
                                    <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Kỳ Chốt
                                        công &amp; Lương T5</h2>
                                </div>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-secondary-container/20 text-on-secondary-container font-label-sm text-label-sm font-semibold">Ngày
                                    D-2</span>
                            </div>
                            <!-- Progress Meter -->
                            <div class="bg-surface-container-low p-space-md rounded-xl flex flex-col gap-space-sm">
                                <div class="flex justify-between items-center">
                                    <span class="font-label-md text-label-md text-on-surface font-semibold">Tiến độ xác
                                        nhận dữ liệu</span>
                                    <span class="font-headline-sm text-headline-sm text-primary font-bold">96%</span>
                                </div>
                                <div class="w-full bg-surface-variant rounded-full h-2 overflow-hidden">
                                    <div class="bg-primary-container h-2 rounded-full" style="width: 96%"></div>
                                </div>
                                <div class="flex justify-between items-center text-outline font-body-sm text-body-sm">
                                    <span>Đã xác nhận: <strong>235</strong> NV</span>
                                    <span>Chờ xử lý: <strong>10</strong> NV</span>
                                </div>
                            </div>
                            <!-- Exception Warnings -->
                            <div class="flex flex-col gap-space-xs">
                                <div
                                    class="flex items-center justify-between text-outline font-label-sm text-label-sm">
                                    <span class="uppercase tracking-wider">Cần can thiệp gấp (4 lỗi)</span>
                                    <span class="text-error font-medium">Hạn chót: 17:00</span>
                                </div>
                                <div class="bg-error-container/40 p-space-sm rounded-xl flex items-start gap-space-sm">
                                    <span
                                        class="material-symbols-outlined text-error text-[20px] flex-shrink-0 mt-0.5">warning</span>
                                    <div class="flex flex-col min-w-0">
                                        <span
                                            class="font-label-md text-label-md text-on-error-container font-semibold">4
                                            nhân viên quên check-in</span>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">Cần
                                            gửi nhắc nhở giải trình ca làm việc ngày 28/05 trước khi khóa bảng lương tự
                                            động.</p>
                                        <div class="flex items-center gap-space-xs mt-2">
                                            <button
                                                class="px-2.5 py-1 rounded-lg bg-surface-container-lowest text-on-surface font-label-sm text-label-sm hover:bg-surface shadow-xs">Xem
                                                4 NV</button>
                                            <button
                                                class="px-2.5 py-1 rounded-lg bg-error text-on-error font-label-sm text-label-sm hover:opacity-90">Gửi
                                                push cảnh báo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Timeline & Sync Action -->
                            <div class="pt-space-xs flex flex-col gap-space-sm">
                                <div
                                    class="flex items-center justify-between p-space-sm rounded-lg bg-surface-container-low font-body-sm text-body-sm">
                                    <div class="flex items-center gap-space-xs text-on-surface-variant">
                                        <span
                                            class="material-symbols-outlined text-[16px] text-tertiary-container">schedule</span>
                                        <span>Chốt đơn phép: 30/05</span>
                                    </div>
                                    <span class="text-tertiary-container font-semibold">Hoàn tất</span>
                                </div>
                                <div
                                    class="flex items-center justify-between p-space-sm rounded-lg bg-surface-container-low font-body-sm text-body-sm">
                                    <div class="flex items-center gap-space-xs text-on-surface-variant">
                                        <span
                                            class="material-symbols-outlined text-[16px] text-secondary">database</span>
                                        <span>ERP Sync: Chưa khóa</span>
                                    </div>
                                    <span class="text-secondary font-semibold">Sẵn sàng</span>
                                </div>
                                <button
                                    class="w-full mt-space-xs py-3 px-space-md rounded-xl bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md flex items-center justify-center gap-space-xs shadow-sm transition-all">
                                    <span class="material-symbols-outlined text-[18px]">sync</span>
                                    <span>Đồng bộ bảng lương tự động</span>
                                </button>
                            </div>
                        </div>
                        <!-- COLUMN 2: Tuyển dụng Q2 -->
                        <div
                            class="flex flex-col gap-space-md bg-surface-container-lowest p-space-lg rounded-xl shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-space-xs">
                                    <div class="w-2.5 h-2.5 rounded-full bg-secondary-container"></div>
                                    <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Phễu Tuyển
                                        dụng Q2</h2>
                                </div>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm font-semibold">6
                                    Vị trí mở</span>
                            </div>
                            <!-- Funnel Mini-Visual -->
                            <div
                                class="grid grid-cols-3 gap-2 bg-surface-container-low p-space-sm rounded-xl text-center">
                                <div class="flex flex-col">
                                    <span class="font-headline-sm text-headline-sm text-primary font-bold">38</span>
                                    <span class="font-label-sm text-label-sm text-outline">Ứng viên mới</span>
                                </div>
                                <div class="flex flex-col border-x border-surface-variant">
                                    <span class="font-headline-sm text-headline-sm text-secondary font-bold">14</span>
                                    <span class="font-label-sm text-label-sm text-outline">Phỏng vấn</span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="font-headline-sm text-headline-sm text-tertiary-container font-bold">3</span>
                                    <span class="font-label-sm text-label-sm text-outline">Offer gửi</span>
                                </div>
                            </div>
                            <!-- Urgent Candidate Queue -->
                            <div class="flex flex-col gap-space-xs">
                                <div
                                    class="flex items-center justify-between text-outline font-label-sm text-label-sm">
                                    <span class="uppercase tracking-wider">Lịch Phỏng vấn hôm nay</span>
                                    <span class="text-secondary font-medium">3 lịch chờ</span>
                                </div>
                                <!-- Candidate item 1 -->
                                <div
                                    class="p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between hover:bg-surface-container transition-colors">
                                    <div class="flex items-center gap-space-sm min-w-0">
                                        <div
                                            class="w-9 h-9 rounded-full bg-primary-fixed flex items-center justify-center text-primary font-bold text-label-sm flex-shrink-0">
                                            NA
                                        </div>
                                        <div class="flex flex-col min-w-0">
                                            <span
                                                class="font-label-md text-label-md text-on-surface font-bold truncate">Nguyễn
                                                Anh Tuấn</span>
                                            <span class="font-body-sm text-body-sm text-outline truncate">Senior
                                                Backend Go • Vòng 2</span>
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-1 rounded-lg bg-surface-container-lowest text-primary font-label-sm text-label-sm font-bold flex-shrink-0">14:30</span>
                                </div>
                                <!-- Candidate item 2 -->
                                <div
                                    class="p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between hover:bg-surface-container transition-colors">
                                    <div class="flex items-center gap-space-sm min-w-0">
                                        <div
                                            class="w-9 h-9 rounded-full bg-secondary-fixed flex items-center justify-center text-secondary font-bold text-label-sm flex-shrink-0">
                                            TL
                                        </div>
                                        <div class="flex flex-col min-w-0">
                                            <span
                                                class="font-label-md text-label-md text-on-surface font-bold truncate">Trần
                                                Thùy Linh</span>
                                            <span class="font-body-sm text-body-sm text-outline truncate">Product Owner
                                                • Phỏng vấn GD</span>
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-1 rounded-lg bg-surface-container-lowest text-secondary font-label-sm text-label-sm font-bold flex-shrink-0">16:00</span>
                                </div>
                                <!-- Candidate item 3 -->
                                <div
                                    class="p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between hover:bg-surface-container transition-colors">
                                    <div class="flex items-center gap-space-sm min-w-0">
                                        <div
                                            class="w-9 h-9 rounded-full bg-tertiary-fixed flex items-center justify-center text-tertiary font-bold text-label-sm flex-shrink-0">
                                            HM
                                        </div>
                                        <div class="flex flex-col min-w-0">
                                            <span
                                                class="font-label-md text-label-md text-on-surface font-bold truncate">Hoàng
                                                Minh Đức</span>
                                            <span class="font-body-sm text-body-sm text-outline truncate">Data Analyst
                                                • Đã gửi Offer</span>
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-tertiary-container/20 text-tertiary font-label-sm text-label-sm font-medium flex-shrink-0">Đợi
                                        ký</span>
                                </div>
                            </div>
                            <div class="pt-space-xs">
                                <button
                                    class="w-full py-2.5 px-space-md rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md flex items-center justify-center gap-space-xs transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                                    <span>Xem lịch hội đồng phỏng vấn</span>
                                </button>
                            </div>
                        </div>
                        <!-- COLUMN 3: Hợp đồng & BHXH -->
                        <div
                            class="flex flex-col gap-space-md bg-surface-container-lowest p-space-lg rounded-xl shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-space-xs">
                                    <div class="w-2.5 h-2.5 rounded-full bg-tertiary-container"></div>
                                    <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Hợp đồng
                                        &amp; BHXH</h2>
                                </div>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm font-semibold">Tháng
                                    05</span>
                            </div>
                            <!-- Contract Alert Badge -->
                            <div
                                class="bg-surface-container-low p-space-md rounded-xl flex items-center justify-between">
                                <div class="flex items-center gap-space-sm">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center text-primary flex-shrink-0">
                                        <span class="material-symbols-outlined text-[20px]">assignment_late</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-label-md text-label-md text-on-surface font-bold">5 Hợp đồng
                                            lao động</span>
                                        <span class="font-body-sm text-body-sm text-outline">Hết hạn trong 15 ngày
                                            tới</span>
                                    </div>
                                </div>
                                <button
                                    class="px-3 py-1.5 rounded-lg bg-surface-container-lowest hover:bg-surface-variant text-primary font-label-sm text-label-sm font-bold shadow-xs">
                                    Tái ký
                                </button>
                            </div>
                            <!-- Social Insurance Status (C12) -->
                            <div class="flex flex-col gap-space-xs">
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Hồ sơ
                                    Cơ quan BHXH Quận</span>
                                <div
                                    class="p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between">
                                    <div class="flex items-center gap-space-sm">
                                        <span
                                            class="material-symbols-outlined text-secondary text-[20px]">receipt_long</span>
                                        <div class="flex flex-col">
                                            <span class="font-label-md text-label-md text-on-surface font-semibold">Mẫu
                                                C12-TS Đối soát</span>
                                            <span class="font-body-sm text-body-sm text-outline">Khớp dữ liệu: 245/245
                                                sổ</span>
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed-variant font-label-sm text-label-sm font-semibold">Đã
                                        nộp</span>
                                </div>
                                <div
                                    class="p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between">
                                    <div class="flex items-center gap-space-sm">
                                        <span
                                            class="material-symbols-outlined text-outline text-[20px]">pregnant_woman</span>
                                        <div class="flex flex-col">
                                            <span class="font-label-md text-label-md text-on-surface font-semibold">Chế
                                                độ Thai sản</span>
                                            <span class="font-body-sm text-body-sm text-outline">2 hồ sơ mới chờ nộp
                                                cổng DVC</span>
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-secondary-container/20 text-on-secondary-container font-label-sm text-label-sm font-semibold">Chờ
                                        nộp</span>
                                </div>
                            </div>
                            <div class="pt-space-xs">
                                <button
                                    class="w-full py-2.5 px-space-md rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md flex items-center justify-center gap-space-xs transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">verified_user</span>
                                    <span>Đối soát tăng giảm lao động</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Approval & Expense Section (Dedicated Table) -->
                    <div
                        class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col gap-space-md">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm">
                            <div class="flex flex-col">
                                <div class="flex items-center gap-space-xs">
                                    <h2 class="font-headline-md text-headline-md text-on-surface font-bold">Duyệt Chi
                                        phí &amp; Trợ cấp Nhân sự</h2>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-bold">2
                                        Cần duyệt</span>
                                </div>
                                <p class="font-body-sm text-body-sm text-outline">Danh sách tờ trình công tác phí, ngân
                                    sách đào tạo và phúc lợi trực tiếp từ nhân sự</p>
                            </div>
                            <!-- Filter pills -->
                            <div class="flex items-center gap-space-xs bg-surface-container-low p-1 rounded-xl">
                                <button
                                    class="px-3 py-1.5 rounded-lg bg-surface-container-lowest text-primary font-label-sm text-label-sm font-bold shadow-xs">Tất
                                    cả (2)</button>
                                <button
                                    class="px-3 py-1.5 rounded-lg text-outline hover:text-on-surface font-label-sm text-label-sm">Công
                                    tác phí (1)</button>
                                <button
                                    class="px-3 py-1.5 rounded-lg text-outline hover:text-on-surface font-label-sm text-label-sm">Đào
                                    tạo (1)</button>
                            </div>
                        </div>
                        <!-- Data Table Container -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="bg-surface-container-low text-outline font-label-sm text-label-sm uppercase tracking-wider">
                                        <th class="py-3 px-space-md rounded-l-xl">Mã &amp; Nhân sự</th>
                                        <th class="py-3 px-space-md">Nội dung đề xuất</th>
                                        <th class="py-3 px-space-md">Số tiền (VNĐ)</th>
                                        <th class="py-3 px-space-md">Chứng từ kèm theo</th>
                                        <th class="py-3 px-space-md">Trạng thái</th>
                                        <th class="py-3 px-space-md text-right rounded-r-xl">Hành động duyệt</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y-0 text-on-surface">
                                    <!-- Row 1: Tran Dinh Huy -->
                                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                                        <td class="py-space-md px-space-md">
                                            <div class="flex items-center gap-space-sm">
                                                <div
                                                    class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-primary font-bold">
                                                    DH
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-label-md text-label-md text-on-surface font-bold">Trần
                                                        Đình Huy</span>
                                                    <span class="font-body-sm text-body-sm text-outline">Kỹ sư Triển
                                                        khai • NV-089</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-body-md text-body-md font-semibold text-on-surface">Đơn
                                                    công tác phí dự án Đà Nẵng</span>
                                                <span class="font-body-sm text-body-sm text-outline">Thời gian: 20/05 -
                                                    24/05/2025 (5 ngày)</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-lg text-label-lg font-bold text-primary">4.850.000
                                                    đ</span>
                                                <span class="font-label-sm text-label-sm text-outline">Đúng định
                                                    mức</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <div class="flex items-center gap-space-xs">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[18px]">receipt</span>
                                                <button
                                                    class="font-label-sm text-label-sm text-secondary hover:underline font-semibold flex items-center gap-1">
                                                    <span>6 hóa đơn VAT điện tử</span>
                                                    <span class="material-symbols-outlined text-[14px]">download</span>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <span
                                                class="px-2.5 py-1 rounded-full bg-secondary-container/20 text-on-secondary-container font-label-sm text-label-sm font-semibold">
                                                Chờ HR kiểm tra
                                            </span>
                                        </td>
                                        <td class="py-space-md px-space-md text-right">
                                            <div class="flex items-center justify-end gap-space-xs">
                                                <button
                                                    class="p-2 rounded-lg bg-surface-container text-outline hover:text-on-surface hover:bg-surface-variant transition-colors"
                                                    title="Yêu cầu bổ sung">
                                                    <span
                                                        class="material-symbols-outlined text-[18px]">edit_note</span>
                                                </button>
                                                <button
                                                    class="p-2 rounded-lg bg-surface-container text-error hover:bg-error-container transition-colors"
                                                    title="Từ chối">
                                                    <span class="material-symbols-outlined text-[18px]">close</span>
                                                </button>
                                                <button
                                                    class="px-3.5 py-2 rounded-lg bg-primary-container text-on-primary font-label-sm text-label-sm font-bold hover:bg-primary shadow-xs transition-colors flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-[16px]">check</span>
                                                    <span>Phê duyệt</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Row 2: Vu Thi Hai Yen -->
                                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                                        <td class="py-space-md px-space-md">
                                            <div class="flex items-center gap-space-sm">
                                                <div
                                                    class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-secondary font-bold">
                                                    HY
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-label-md text-label-md text-on-surface font-bold">Vũ
                                                        Thị Hải Yến</span>
                                                    <span class="font-body-sm text-body-sm text-outline">Scrum Master •
                                                        NV-034</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-body-md text-body-md font-semibold text-on-surface">Ngân
                                                    sách đào tạo Agile Coaching ICP-ACC</span>
                                                <span class="font-body-sm text-body-sm text-outline">Khóa học chuyên
                                                    môn Q2 • Viện Đào tạo Agile</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-lg text-label-lg font-bold text-primary">12.500.000
                                                    đ</span>
                                                <span class="font-label-sm text-label-sm text-outline">Trong hạn mức
                                                    năm</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <div class="flex items-center gap-space-xs">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[18px]">description</span>
                                                <button
                                                    class="font-label-sm text-label-sm text-secondary hover:underline font-semibold flex items-center gap-1">
                                                    <span>Hợp đồng &amp; Đề cương</span>
                                                    <span class="material-symbols-outlined text-[14px]">download</span>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <span
                                                class="px-2.5 py-1 rounded-full bg-secondary-container/20 text-on-secondary-container font-label-sm text-label-sm font-semibold">
                                                Quản lý đã duyệt
                                            </span>
                                        </td>
                                        <td class="py-space-md px-space-md text-right">
                                            <div class="flex items-center justify-end gap-space-xs">
                                                <button
                                                    class="p-2 rounded-lg bg-surface-container text-outline hover:text-on-surface hover:bg-surface-variant transition-colors"
                                                    title="Yêu cầu bổ sung">
                                                    <span
                                                        class="material-symbols-outlined text-[18px]">edit_note</span>
                                                </button>
                                                <button
                                                    class="p-2 rounded-lg bg-surface-container text-error hover:bg-error-container transition-colors"
                                                    title="Từ chối">
                                                    <span class="material-symbols-outlined text-[18px]">close</span>
                                                </button>
                                                <button
                                                    class="px-3.5 py-2 rounded-lg bg-primary-container text-on-primary font-label-sm text-label-sm font-bold hover:bg-primary shadow-xs transition-colors flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-[16px]">check</span>
                                                    <span>Phê duyệt</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Table Footer / Audit Note -->
                        <div
                            class="flex flex-col sm:flex-row items-center justify-between pt-space-xs text-outline font-body-sm text-body-sm">
                            <div class="flex items-center gap-space-xs">
                                <span
                                    class="material-symbols-outlined text-[16px] text-tertiary-container">verified</span>
                                <span>Mọi khoản chi sau phê duyệt sẽ được ghi nhận trực tiếp vào kỳ lương kế toán đợt
                                    1</span>
                            </div>
                            <span class="text-on-surface-variant font-medium">Hiển thị 2 trên tổng số 2 hồ sơ chờ phê
                                duyệt</span>
                        </div>
                    </div>
                </div>
            </div>

@endsection



