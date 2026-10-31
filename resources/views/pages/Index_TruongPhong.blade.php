@extends('layout.app')

@section('content')

        <div class="max-w-[1440px] mx-auto p-space-lg">
            <div class="flex flex-col w-full gap-space-lg">
            <!-- Top Department Header & Context Bar -->
            <div
                class="flex flex-col lg:flex-row lg:items-center justify-between gap-space-md bg-surface-container-lowest p-space-lg rounded-xl shadow-sm"
            >
                <div class="flex items-center gap-space-md min-w-0">
                <div
                    class="relative w-14 h-14 rounded-xl overflow-hidden shrink-0 shadow-md"
                >
                    <img
                    class="w-full h-full object-cover"
                    data-alt="Chân dung nữ phó phòng công nghệ thông tin trẻ tuổi, phong thái quản lý tự tin mặc sơ mi công sở hiện đại trong văn phòng công nghệ ánh sáng tự nhiên với dải màu navy xanh dịu dàng"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuB-YblTMRFgF9wXV7OwGysQDfo5pBo2uDZBUVmsXHh9RygUWE_pz3XG89oGmT6nybxcVehbrL7O0GvCGagkJhVhG-5VhtGQgq5uAkUVcGi0PFAlxRpT7Zc1IxRwQhw7JCV8XgozRX6d2Zo3PLRtZX9pO3EqkHUfl97t7Y2Hln83NNobsK3w-sqENIMYa_KCv6akokNMBzXL_PHhD6Xj1lZZQEZ4WMaib8UWuXq720o"
                    />
                    <div
                    class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full bg-tertiary-container ring-2 ring-surface-container-lowest"
                    ></div>
                </div>
                <div class="flex flex-col min-w-0">
                    <div class="flex items-center gap-space-xs flex-wrap">
                    <span
                        class="px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm uppercase tracking-wider"
                        >Phân hệ Quản trị Phó phòng</span
                    >
                    <span class="text-outline font-body-sm text-body-sm"
                        >•</span
                    >
                    <span class="font-body-sm text-body-sm text-outline"
                        >Kỹ thuật &amp; Công nghệ (18 nhân sự)</span
                    >
                    </div>
                    <h1
                    class="font-headline-lg text-headline-lg text-primary truncate tracking-tight"
                    >
                    Quản trị Bộ phận Kỹ thuật &amp; Công nghệ
                    </h1>
                    <p
                    class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1.5"
                    >
                    <span
                        class="material-symbols-outlined text-[16px] text-secondary"
                        >verified_user</span
                    >
                    Trách nhiệm phê duyệt:
                    <span class="font-body-md-bold text-on-surface"
                        >Phó phòng Trần Thị Bích</span
                    >
                    (Mã NV: LHK-TECH-002)
                    </p>
                </div>
                </div>
                <!-- Quick Week & Status Filters -->
                <div
                class="flex items-center gap-space-sm flex-wrap self-start lg:self-center"
                >
                <div
                    class="flex items-center bg-surface-container-low px-3 py-2 rounded-xl text-on-surface"
                >
                    <span
                    class="material-symbols-outlined text-outline text-[18px] mr-2"
                    >calendar_view_week</span
                    >
                    <select
                    class="bg-transparent font-label-md text-label-md text-on-surface font-semibold focus:outline-none cursor-pointer"
                    >
                    <option selected="" value="w24">
                        Tuần 24/2025 (09/06 - 15/06)
                    </option>
                    <option value="w23">Tuần 23/2025 (02/06 - 08/06)</option>
                    <option value="w25">Tuần 25/2025 (16/06 - 22/06)</option>
                    </select>
                </div>
                <div
                    class="flex items-center bg-surface-container-low px-3 py-2 rounded-xl text-on-surface"
                >
                    <span
                    class="material-symbols-outlined text-outline text-[18px] mr-2"
                    >cloud_upload</span
                    >
                    <select
                    class="bg-transparent font-label-md text-label-md text-on-surface font-medium focus:outline-none cursor-pointer"
                    >
                    <option selected="" value="all">Tất cả dự án (Q2)</option>
                    <option value="customer_portal">
                        Cổng dịch vụ khách hàng
                    </option>
                    <option value="mobile_app">LiHKn Mobile App</option>
                    <option value="core_billing">
                        Billing &amp; Core FinTech
                    </option>
                    </select>
                </div>
                <button
                    class="flex items-center gap-1.5 px-3 py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-all shadow-sm"
                >
                    <span class="material-symbols-outlined text-[18px]"
                    >tune</span
                    >
                    <span>Thiết lập ca</span>
                </button>
                </div>
            </div>
            <!-- Realtime Team Presence Hero Banner -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-space-md">
                <!-- Total & Presence Metrics -->
                <div
                class="md:col-span-3 bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col justify-between"
                >
                <div class="flex items-center justify-between mb-space-md">
                    <div class="flex items-center gap-space-xs">
                    <span
                        class="w-2.5 h-2.5 rounded-full bg-secondary-container animate-ping"
                    ></span>
                    <span
                        class="font-headline-sm text-headline-sm text-on-surface"
                        >Trực quan Hiện diện Thời gian thực (Realtime
                        Presence)</span
                    >
                    </div>
                    <span
                    class="px-2.5 py-1 rounded-full bg-surface-container-high font-label-sm text-label-sm text-on-surface-variant font-semibold"
                    >Cập nhật 08:42:15 hôm nay</span
                    >
                </div>
                <!-- Segmented Bar Visualization -->
                <div class="w-full mb-space-md">
                    <div
                    class="h-4 w-full rounded-full bg-surface-container overflow-hidden flex shadow-inner"
                    >
                    <div
                        class="bg-primary hover:opacity-95 transition-all"
                        style="width: 88.88%"
                        title="Tại văn phòng: 16 người"
                    ></div>
                    <div
                        class="bg-secondary-container hover:opacity-95 transition-all"
                        style="width: 5.56%"
                        title="Làm từ xa (WFH): 1 người"
                    ></div>
                    <div
                        class="bg-error-container hover:opacity-95 transition-all"
                        style="width: 5.56%"
                        title="Nghỉ phép: 1 người"
                    ></div>
                    </div>
                </div>
                <!-- Detail Badges Row -->
                <div
                    class="grid grid-cols-2 sm:grid-cols-4 gap-space-md pt-space-xs"
                >
                    <div
                    class="flex items-center gap-space-sm p-space-sm rounded-xl bg-surface-container-low"
                    >
                    <div
                        class="w-9 h-9 rounded-lg bg-surface-container-lowest flex items-center justify-center text-primary shadow-xs"
                    >
                        <span class="material-symbols-outlined text-[20px]"
                        >group</span
                        >
                    </div>
                    <div>
                        <p class="font-body-sm text-body-sm text-outline">
                        Quy mô đội
                        </p>
                        <p class="font-headline-sm text-headline-sm text-primary">
                        18
                        <span
                            class="font-body-sm text-body-sm font-normal text-on-surface-variant"
                            >nhân viên</span
                        >
                        </p>
                    </div>
                    </div>
                    <div
                    class="flex items-center gap-space-sm p-space-sm rounded-xl bg-surface-container-low"
                    >
                    <div
                        class="w-9 h-9 rounded-lg bg-surface-container-lowest flex items-center justify-center text-primary shadow-xs"
                    >
                        <span class="material-symbols-outlined text-[20px]"
                        >apartment</span
                        >
                    </div>
                    <div>
                        <p class="font-body-sm text-body-sm text-outline">
                        Tại văn phòng
                        </p>
                        <p
                        class="font-headline-sm text-headline-sm text-on-surface"
                        >
                        16
                        <span
                            class="font-label-sm text-label-sm text-tertiary font-bold"
                            >(88.9%)</span
                        >
                        </p>
                    </div>
                    </div>
                    <div
                    class="flex items-center gap-space-sm p-space-sm rounded-xl bg-surface-container-low"
                    >
                    <div
                        class="w-9 h-9 rounded-lg bg-surface-container-lowest flex items-center justify-center text-secondary shadow-xs"
                    >
                        <span class="material-symbols-outlined text-[20px]"
                        >laptop_mac</span
                        >
                    </div>
                    <div>
                        <p class="font-body-sm text-body-sm text-outline">
                        Làm từ xa (WFH)
                        </p>
                        <p
                        class="font-headline-sm text-headline-sm text-secondary"
                        >
                        01
                        <span class="font-label-sm text-label-sm text-outline"
                            >nhân sự</span
                        >
                        </p>
                    </div>
                    </div>
                    <div
                    class="flex items-center gap-space-sm p-space-sm rounded-xl bg-surface-container-low"
                    >
                    <div
                        class="w-9 h-9 rounded-lg bg-surface-container-lowest flex items-center justify-center text-error shadow-xs"
                    >
                        <span class="material-symbols-outlined text-[20px]"
                        >event_busy</span
                        >
                    </div>
                    <div>
                        <p class="font-body-sm text-body-sm text-outline">
                        Nghỉ ốm / Phép
                        </p>
                        <p class="font-headline-sm text-headline-sm text-error">
                        01
                        <span class="font-label-sm text-label-sm text-outline"
                            >nhân sự</span
                        >
                        </p>
                    </div>
                    </div>
                </div>
                </div>
                <!-- System SLA & Readiness Card -->
                <div
                class="bg-primary text-on-primary p-space-lg rounded-xl shadow-md flex flex-col justify-between relative overflow-hidden"
                >
                <div
                    class="absolute -right-6 -bottom-6 w-32 h-32 rounded-full bg-secondary-container opacity-15 pointer-events-none"
                ></div>
                <div>
                    <div class="flex items-center justify-between mb-space-sm">
                    <span
                        class="font-label-sm text-label-sm tracking-wider uppercase text-secondary-fixed"
                        >Sẵn sàng vận hành</span
                    >
                    <span
                        class="material-symbols-outlined text-secondary-container text-[20px]"
                        >speed</span
                    >
                    </div>
                    <div class="flex items-baseline gap-2">
                    <span
                        class="font-headline-xl text-headline-xl text-on-primary tracking-tight"
                        >98.5%</span
                    >
                    <span
                        class="font-label-sm text-label-sm text-tertiary-fixed font-semibold flex items-center gap-0.5"
                    >
                        <span class="material-symbols-outlined text-[14px]"
                        >trending_up</span
                        >+1.2%
                    </span>
                    </div>
                    <p class="font-body-sm text-body-sm text-primary-fixed mt-1">
                    Đảm bảo chỉ số cam kết SLA hạ tầng Level 2 cho toàn hệ thống
                    LiHKn Hub.
                    </p>
                </div>
                <div class="mt-space-md pt-space-sm">
                    <div
                    class="flex items-center justify-between text-body-sm font-label-md mb-1.5 text-primary-fixed"
                    >
                    <span>Tải trọng nhân lực sprint</span>
                    <span class="text-on-primary font-bold">17/18 On-job</span>
                    </div>
                    <div
                    class="h-2 w-full bg-primary-container rounded-full overflow-hidden"
                    >
                    <div
                        class="h-full bg-secondary-container rounded-full"
                        style="width: 94.4%"
                    ></div>
                    </div>
                </div>
                </div>
            </div>
            <!-- Main Workstation Layout: 2 Columns Grid -->
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-space-lg">
                <!-- LEFT COLUMN: Pending Approvals & Batch Management (8 Cols) -->
                <div class="xl:col-span-8 flex flex-col gap-space-lg">
                <!-- Approvals Container Card -->
                <div
                    class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col"
                >
                    <div
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-md pb-space-md"
                    >
                    <div>
                        <div class="flex items-center gap-space-xs">
                        <h2
                            class="font-headline-md text-headline-md text-on-surface"
                        >
                            Phê duyệt khẩn cấp đa luồng
                        </h2>
                        <span
                            class="px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-bold"
                            >3 đơn chờ</span
                        >
                        </div>
                        <p
                        class="font-body-sm text-body-sm text-on-surface-variant"
                        >
                        Thẩm quyền Phó phòng kỹ thuật phê duyệt chế độ, ca kíp
                        và trực khẩn cấp
                        </p>
                    </div>
                    <!-- Batch Action Trigger Button -->
                    <div class="flex items-center gap-space-xs shrink-0">
                        <button
                        class="flex items-center gap-space-xs px-4 py-2.5 rounded-xl bg-primary text-on-primary font-body-md-bold text-body-md-bold hover:bg-primary-container transition-all shadow-sm"
                        id="batch-approve-btn"
                        onclick="handleBatchApprove()"
                        >
                        <span class="material-symbols-outlined text-[18px]"
                            >done_all</span
                        >
                        <span>Duyệt tất cả đơn hợp lệ (3)</span>
                        </button>
                    </div>
                    </div>
                    <!-- Approval Item Cards List -->
                    <div
                    class="flex flex-col gap-space-sm pt-space-xs"
                    id="approval-list"
                    >
                    <!-- Item 1: Nghỉ ốm Lê Văn Tuấn -->
                    <div
                        class="approval-card p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all flex flex-col md:flex-row md:items-center justify-between gap-space-md"
                        data-id="req-1"
                    >
                        <div class="flex items-start gap-space-md min-w-0">
                        <div
                            class="w-12 h-12 rounded-xl bg-error-container text-error flex items-center justify-center shrink-0"
                        >
                            <span class="material-symbols-outlined text-[24px]"
                            >sick</span
                            >
                        </div>
                        <div class="flex flex-col min-w-0">
                            <div class="flex items-center gap-space-xs flex-wrap">
                            <span
                                class="font-body-md-bold text-body-md-bold text-on-surface truncate"
                                >Lê Văn Tuấn</span
                            >
                            <span
                                class="px-2 py-0.5 rounded bg-surface text-outline font-label-sm text-label-sm"
                                >Frontend Dev</span
                            >
                            <span
                                class="px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold"
                                >Nghỉ ốm (1 ngày)</span
                            >
                            </div>
                            <p
                            class="font-body-sm text-body-sm text-on-surface-variant mt-1"
                            >
                            <strong class="font-medium text-on-surface"
                                >Lý do:</strong
                            >
                            Sốt cao kèm viêm họng cấp theo chỉ định y tế bệnh
                            viện.
                            </p>
                            <div
                            class="flex items-center gap-space-sm mt-1.5 text-body-sm text-outline"
                            >
                            <span
                                class="flex items-center gap-1 font-body-sm text-body-sm"
                            >
                                <span
                                class="material-symbols-outlined text-[16px] text-secondary"
                                >transfer_within_a_station</span
                                >
                                Bàn giao:
                                <span class="text-on-surface font-medium"
                                >Trần Đình Khang</span
                                >
                                (Sprint task #304)
                            </span>
                            <span>•</span>
                            <span>Gửi lúc: 07:15 hôm nay</span>
                            </div>
                        </div>
                        </div>
                        <!-- Actions -->
                        <div
                        class="flex items-center gap-space-xs shrink-0 self-end md:self-center"
                        >
                        <button
                            class="px-3.5 py-2 rounded-xl bg-primary text-on-primary font-label-md text-label-md hover:bg-primary-container transition-all shadow-xs flex items-center gap-1"
                            onclick="approveSingle('req-1')"
                        >
                            <span class="material-symbols-outlined text-[16px]"
                            >check</span
                            >
                            Duyệt nhanh
                        </button>
                        <button
                            class="px-3.5 py-2 rounded-xl bg-surface-container-lowest text-error font-label-md text-label-md hover:bg-error-container transition-all flex items-center gap-1"
                            onclick="rejectSingle('req-1')"
                        >
                            <span class="material-symbols-outlined text-[16px]"
                            >close</span
                            >
                            Từ chối
                        </button>
                        <button
                            class="p-2 rounded-xl bg-surface-container-lowest text-on-surface-variant hover:text-on-surface transition-all"
                        >
                            <span class="material-symbols-outlined text-[20px]"
                            >visibility</span
                            >
                        </button>
                        </div>
                    </div>
                    <!-- Item 2: Trực ca OT 3h Hoàng Minh -->
                    <div
                        class="approval-card p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all flex flex-col md:flex-row md:items-center justify-between gap-space-md"
                        data-id="req-2"
                    >
                        <div class="flex items-start gap-space-md min-w-0">
                        <div
                            class="w-12 h-12 rounded-xl bg-secondary-fixed text-secondary flex items-center justify-center shrink-0"
                        >
                            <span class="material-symbols-outlined text-[24px]"
                            >more_time</span
                            >
                        </div>
                        <div class="flex flex-col min-w-0">
                            <div class="flex items-center gap-space-xs flex-wrap">
                            <span
                                class="font-body-md-bold text-body-md-bold text-on-surface truncate"
                                >Hoàng Minh</span
                            >
                            <span
                                class="px-2 py-0.5 rounded bg-surface text-outline font-label-sm text-label-sm"
                                >DevOps Specialist</span
                            >
                            <span
                                class="px-2 py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-semibold"
                                >Tăng ca OT (3h Đêm)</span
                            >
                            </div>
                            <p
                            class="font-body-sm text-body-sm text-on-surface-variant mt-1"
                            >
                            <strong class="font-medium text-on-surface"
                                >Lý do:</strong
                            >
                            Hotfix nghẽn gateway cổng thanh toán Napas/VietQR
                            phiên bản Production 2.4.1.
                            </p>
                            <div
                            class="flex items-center gap-space-sm mt-1.5 text-body-sm text-outline"
                            >
                            <span
                                class="flex items-center gap-1 font-body-sm text-body-sm"
                            >
                                <span
                                class="material-symbols-outlined text-[16px] text-tertiary"
                                >alarm</span
                                >
                                Khung giờ:
                                <span class="text-on-surface font-medium"
                                >21:00 - 24:00 (Tối nay)</span
                                >
                            </span>
                            <span>•</span>
                            <span class="text-secondary font-medium"
                                >Phụ cấp OT x2.0</span
                            >
                            </div>
                        </div>
                        </div>
                        <!-- Actions -->
                        <div
                        class="flex items-center gap-space-xs shrink-0 self-end md:self-center"
                        >
                        <button
                            class="px-3.5 py-2 rounded-xl bg-primary text-on-primary font-label-md text-label-md hover:bg-primary-container transition-all shadow-xs flex items-center gap-1"
                            onclick="approveSingle('req-2')"
                        >
                            <span class="material-symbols-outlined text-[16px]"
                            >check</span
                            >
                            Duyệt nhanh
                        </button>
                        <button
                            class="px-3.5 py-2 rounded-xl bg-surface-container-lowest text-error font-label-md text-label-md hover:bg-error-container transition-all flex items-center gap-1"
                            onclick="rejectSingle('req-2')"
                        >
                            <span class="material-symbols-outlined text-[16px]"
                            >close</span
                            >
                            Từ chối
                        </button>
                        <button
                            class="p-2 rounded-xl bg-surface-container-lowest text-on-surface-variant hover:text-on-surface transition-all"
                        >
                            <span class="material-symbols-outlined text-[20px]"
                            >visibility</span
                            >
                        </button>
                        </div>
                    </div>
                    <!-- Item 3: Đơn WFH Đỗ Thùy Trang -->
                    <div
                        class="approval-card p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all flex flex-col md:flex-row md:items-center justify-between gap-space-md"
                        data-id="req-3"
                    >
                        <div class="flex items-start gap-space-md min-w-0">
                        <div
                            class="w-12 h-12 rounded-xl bg-surface-container-high text-primary flex items-center justify-center shrink-0"
                        >
                            <span class="material-symbols-outlined text-[24px]"
                            >home_work</span
                            >
                        </div>
                        <div class="flex flex-col min-w-0">
                            <div class="flex items-center gap-space-xs flex-wrap">
                            <span
                                class="font-body-md-bold text-body-md-bold text-on-surface truncate"
                                >Đỗ Thùy Trang</span
                            >
                            <span
                                class="px-2 py-0.5 rounded bg-surface text-outline font-label-sm text-label-sm"
                                >UI/UX Designer</span
                            >
                            <span
                                class="px-2 py-0.5 rounded-full bg-surface-container-highest text-on-surface font-label-sm text-label-sm font-semibold"
                                >Đăng ký WFH Thứ 6</span
                            >
                            </div>
                            <p
                            class="font-body-sm text-body-sm text-on-surface-variant mt-1"
                            >
                            <strong class="font-medium text-on-surface"
                                >Lý do:</strong
                            >
                            Xử lý thủ tục công chứng cá nhân buổi sáng, tập
                            trung hoàn thiện Design Tokens sprint.
                            </p>
                            <div
                            class="flex items-center gap-space-sm mt-1.5 text-body-sm text-outline"
                            >
                            <span
                                class="flex items-center gap-1 font-body-sm text-body-sm"
                            >
                                <span
                                class="material-symbols-outlined text-[16px] text-primary"
                                >schedule</span
                                >
                                Thời gian:
                                <span class="text-on-surface font-medium"
                                >Cả ngày Thứ Sáu (13/06/2025)</span
                                >
                            </span>
                            <span>•</span>
                            <span>Hạn ngạch WFH tháng: Còn 1/2 buổi</span>
                            </div>
                        </div>
                        </div>
                        <!-- Actions -->
                        <div
                        class="flex items-center gap-space-xs shrink-0 self-end md:self-center"
                        >
                        <button
                            class="px-3.5 py-2 rounded-xl bg-primary text-on-primary font-label-md text-label-md hover:bg-primary-container transition-all shadow-xs flex items-center gap-1"
                            onclick="approveSingle('req-3')"
                        >
                            <span class="material-symbols-outlined text-[16px]"
                            >check</span
                            >
                            Duyệt nhanh
                        </button>
                        <button
                            class="px-3.5 py-2 rounded-xl bg-surface-container-lowest text-error font-label-md text-label-md hover:bg-error-container transition-all flex items-center gap-1"
                            onclick="rejectSingle('req-3')"
                        >
                            <span class="material-symbols-outlined text-[16px]"
                            >close</span
                            >
                            Từ chối
                        </button>
                        <button
                            class="p-2 rounded-xl bg-surface-container-lowest text-on-surface-variant hover:text-on-surface transition-all"
                        >
                            <span class="material-symbols-outlined text-[20px]"
                            >visibility</span
                            >
                        </button>
                        </div>
                    </div>
                    </div>
                    <div
                    class="hidden py-10 flex-col items-center justify-center text-center"
                    id="empty-approvals"
                    >
                    <div
                        class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center text-tertiary mb-2"
                    >
                        <span class="material-symbols-outlined text-[24px]"
                        >task_alt</span
                        >
                    </div>
                    <p
                        class="font-headline-sm text-headline-sm text-on-surface"
                    >
                        Đã xử lý toàn bộ yêu cầu khẩn cấp!
                    </p>
                    <p class="font-body-sm text-body-sm text-outline">
                        Không còn đơn từ nào đang chờ Phó phòng phê duyệt trong ca
                        trực này.
                    </p>
                    </div>
                </div>
                <!-- Department OKR & Sprint Progress -->
                <div
                    class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col gap-space-md"
                >
                    <div class="flex items-center justify-between">
                    <div class="flex items-center gap-space-xs">
                        <span
                        class="material-symbols-outlined text-secondary text-[22px]"
                        >rocket_launch</span
                        >
                        <h2
                        class="font-headline-md text-headline-md text-on-surface"
                        >
                        Tiến độ OKR &amp; Sprint Trọng điểm Tuần 24
                        </h2>
                    </div>
                    <span
                        class="font-label-sm text-label-sm text-outline uppercase tracking-wider"
                        >Cập nhật Jira Sync</span
                    >
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <!-- Project 1 -->
                    <div
                        class="p-space-md rounded-xl bg-surface-container-low flex flex-col justify-between gap-space-md"
                    >
                        <div>
                        <div class="flex items-center justify-between mb-1">
                            <span
                            class="px-2 py-0.5 rounded bg-surface-container-high text-primary font-label-sm text-label-sm font-semibold"
                            >Sprint 14 • Milestone A</span
                            >
                            <span
                            class="font-headline-sm text-headline-sm text-primary font-bold"
                            >85%</span
                            >
                        </div>
                        <h3
                            class="font-body-md-bold text-body-md-bold text-on-surface"
                        >
                            Cổng dịch vụ khách hàng (Customer Portal)
                        </h3>
                        <p
                            class="font-body-sm text-body-sm text-outline mt-0.5"
                        >
                            Tích hợp Single Sign-On (SSO) &amp; Cổng thanh toán
                            hóa đơn
                        </p>
                        </div>
                        <div>
                        <div
                            class="h-2.5 w-full bg-surface-container-highest rounded-full overflow-hidden mb-2"
                        >
                            <div
                            class="h-full bg-primary rounded-full transition-all duration-700"
                            style="width: 85%"
                            ></div>
                        </div>
                        <div
                            class="flex items-center justify-between text-body-sm text-outline font-label-sm"
                        >
                            <span>17/20 Story Points đã đóng</span>
                            <span
                            class="text-tertiary font-semibold flex items-center gap-1"
                            >
                            <span
                                class="w-1.5 h-1.5 rounded-full bg-tertiary"
                            ></span
                            >Đúng tiến độ
                            </span>
                        </div>
                        </div>
                    </div>
                    <!-- Project 2 -->
                    <div
                        class="p-space-md rounded-xl bg-surface-container-low flex flex-col justify-between gap-space-md"
                    >
                        <div>
                        <div class="flex items-center justify-between mb-1">
                            <span
                            class="px-2 py-0.5 rounded bg-surface-container-high text-secondary font-label-sm text-label-sm font-semibold"
                            >Sprint 09 • Release RC3</span
                            >
                            <span
                            class="font-headline-sm text-headline-sm text-secondary font-bold"
                            >92%</span
                            >
                        </div>
                        <h3
                            class="font-body-md-bold text-body-md-bold text-on-surface"
                        >
                            LiHKn Internal Mobile (iOS &amp; Android)
                        </h3>
                        <p
                            class="font-body-sm text-body-sm text-outline mt-0.5"
                        >
                            Chấm công GPS ngoại vi, bảo mật vân tay và push
                            notification
                        </p>
                        </div>
                        <div>
                        <div
                            class="h-2.5 w-full bg-surface-container-highest rounded-full overflow-hidden mb-2"
                        >
                            <div
                            class="h-full bg-secondary-container rounded-full transition-all duration-700"
                            style="width: 92%"
                            ></div>
                        </div>
                        <div
                            class="flex items-center justify-between text-body-sm text-outline font-label-sm"
                        >
                            <span>24/26 Story Points hoàn thành</span>
                            <span
                            class="text-tertiary font-semibold flex items-center gap-1"
                            >
                            <span
                                class="w-1.5 h-1.5 rounded-full bg-tertiary"
                            ></span
                            >Chuẩn bị UAT
                            </span>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- RIGHT COLUMN: Probation Review & 24/7 On-Call Schedule (4 Cols) -->
                <div class="xl:col-span-4 flex flex-col gap-space-lg">
                <!-- Probation Review Card (Đánh giá thử việc) -->
                <div
                    class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col"
                >
                    <div class="flex items-center justify-between pb-space-sm">
                    <div class="flex items-center gap-space-xs">
                        <span
                        class="material-symbols-outlined text-primary text-[20px]"
                        >person_check</span
                        >
                        <h2
                        class="font-headline-md text-headline-md text-on-surface"
                        >
                        Đánh giá Thử việc
                        </h2>
                    </div>
                    <span
                        class="px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-bold animate-pulse"
                        >Còn 3 ngày</span
                    >
                    </div>
                    <p class="font-body-sm text-body-sm text-outline mb-space-md">
                    Quyết định bổ nhiệm ký hợp đồng chính thức 12 tháng
                    </p>
                    <!-- Candidate Mini Profile -->
                    <div
                    class="p-space-md rounded-xl bg-surface-container-low mb-space-md"
                    >
                    <div class="flex items-center gap-space-md">
                        <div
                        class="w-12 h-12 rounded-xl overflow-hidden shrink-0 shadow-xs"
                        >
                        <img
                            class="w-full h-full object-cover"
                            data-alt="Chân dung lập trình viên nam trẻ tuổi phong cách năng động, áo thun đen, đeo kính cận, đang mỉm cười nhẹ trong phòng máy chủ hiện đại"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYZS-SWTk7wo00ndQ6L0EPthUbJSagqIlF3Y-TIxSZ0xZZabVFQ5o-0woWXNNj55npjHx6kEVbJx_ztr77gQx3aOAGVSSLWHpCYiGWREhGHw2fWdUxiQ13o_uOW319Stz2KXYf7PqbYSxTrUg5wcVlJCu5aOGntiQyAGeMEcDEKW-l845tk73S_IfGpBi6z5ZVxo634IccrqfvwJh8GE3Kk2jW2eQrLPpaz3SEtRg"
                        />
                        </div>
                        <div class="min-w-0 flex flex-col">
                        <span
                            class="font-body-md-bold text-body-md-bold text-on-surface truncate"
                            >Nguyễn Quốc Huy</span
                        >
                        <span class="font-body-sm text-body-sm text-outline"
                            >Backend Golang Engineer</span
                        >
                        <span
                            class="font-label-sm text-label-sm text-secondary font-semibold mt-0.5"
                            >Kỳ thử việc: 2 Tháng (Kết thúc 15/06)</span
                        >
                        </div>
                    </div>
                    <!-- Evaluation Progress Criteria -->
                    <div class="mt-space-md pt-space-sm">
                        <div class="flex items-center justify-between mb-1.5">
                        <span
                            class="font-body-sm text-body-sm text-on-surface font-medium"
                            >Tiến độ tiêu chí đánh giá</span
                        >
                        <span
                            class="font-label-md text-label-md text-primary font-bold"
                            >4 / 5 Tiêu chí đạt</span
                        >
                        </div>
                        <div class="grid grid-cols-5 gap-1.5 mb-3">
                        <div
                            class="h-2 rounded-full bg-primary"
                            title="Chuyên môn code Golang: Đạt"
                        ></div>
                        <div
                            class="h-2 rounded-full bg-primary"
                            title="Tác phong kỷ luật &amp; Giờ giấc: Đạt"
                        ></div>
                        <div
                            class="h-2 rounded-full bg-primary"
                            title="Phối hợp đội nhóm Scrum: Đạt"
                        ></div>
                        <div
                            class="h-2 rounded-full bg-primary"
                            title="Khả năng xử lý sự cố độc lập: Đạt"
                        ></div>
                        <div
                            class="h-2 rounded-full bg-surface-container-highest"
                            title="Báo cáo nghiệm thu thử việc: Đang chờ hoàn tất"
                        ></div>
                        </div>
                        <div
                        class="bg-surface-container-lowest p-space-sm rounded-lg flex items-center justify-between text-body-sm"
                        >
                        <span class="text-on-surface-variant font-body-sm"
                            >Người hướng dẫn (Mentor):</span
                        >
                        <span class="font-body-md-bold text-on-surface"
                            >Võ Hoài Nam (Lead)</span
                        >
                        </div>
                    </div>
                    </div>
                    <div class="flex items-center gap-space-xs">
                    <button
                        class="w-full py-2.5 px-3 rounded-xl bg-primary text-on-primary font-label-md text-label-md hover:bg-primary-container transition-all text-center"
                    >
                        Nhập kết quả nghiệm thu
                    </button>
                    <button
                        class="p-2.5 rounded-xl bg-surface-container-low text-on-surface hover:bg-surface-container transition-all"
                        title="Xem hồ sơ ứng viên"
                    >
                        <span class="material-symbols-outlined text-[20px]"
                        >folder_shared</span
                        >
                    </button>
                    </div>
                </div>
                <!-- 24/7 On-Call & Weekly Roster (Lịch trực On-call) -->
                <div
                    class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col"
                >
                    <div class="flex items-center justify-between pb-space-sm">
                    <div class="flex items-center gap-space-xs">
                        <span
                        class="material-symbols-outlined text-secondary text-[20px]"
                        >support_agent</span
                        >
                        <h2
                        class="font-headline-md text-headline-md text-on-surface"
                        >
                        Lịch Trực On-call 24/7
                        </h2>
                    </div>
                    <span
                        class="px-2 py-0.5 rounded-full bg-surface-container-highest font-label-sm text-label-sm text-secondary font-bold"
                        >Hạ tầng Server</span
                    >
                    </div>
                    <p class="font-body-sm text-body-sm text-outline mb-space-md">
                    Ca trực giám sát Cloud Infrastructure &amp; DB Production
                    </p>
                    <!-- Current Duty Roster -->
                    <div class="flex flex-col gap-space-sm mb-space-md">
                    <!-- Primary Engineer -->
                    <div
                        class="p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between"
                    >
                        <div class="flex items-center gap-space-sm">
                        <div
                            class="relative w-10 h-10 rounded-lg overflow-hidden shrink-0"
                        >
                            <img
                            class="w-full h-full object-cover"
                            data-alt="Chân dung kỹ sư nam chuyên nghiệp phụ trách hệ thống máy chủ, chụp nửa người trong văn phòng công nghệ ánh sáng hiện đại"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDWrvsg5y8m3YvzmCJ4WpgSh1PrwQmBNr_1nA_oQ15I6IyCGMEdm0egc1-BBSeq3YiS7QOC3WhudpWz6EdoLatFvowSwWAjpBQDO74DlEyirBeHarat3dTFH2DbCE_xUmRI6DMKjuPTEcSfVjGyHwlARHGqLFGmou6cdNyyqBKy0_ON__1oTECTrjzcL16Z7IrRbfz7nVPg1jeX4Oze_57ebSKBlsatG5GyLUwz6K8"
                            />
                            <div
                            class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-tertiary-container ring-1 ring-surface-container-lowest"
                            ></div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-1">
                            <span
                                class="font-body-md-bold text-body-md-bold text-on-surface"
                                >Võ Hoài Nam</span
                            >
                            <span
                                class="px-1.5 py-0.2 rounded bg-primary-fixed text-primary font-label-sm text-[10px] font-bold uppercase"
                                >Chính</span
                            >
                            </div>
                            <span class="font-body-sm text-body-sm text-outline"
                            >Kỹ sư trực chính (Primary 24/7)</span
                            >
                        </div>
                        </div>
                        <div class="text-right">
                        <span
                            class="font-label-sm text-label-sm text-secondary font-semibold"
                            >Hotline Priority 1</span
                        >
                        <p
                            class="font-body-sm text-body-sm text-on-surface font-medium"
                        >
                            Ext: 8812
                        </p>
                        </div>
                    </div>
                    <!-- Secondary Engineer -->
                    <div
                        class="p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between"
                    >
                        <div class="flex items-center gap-space-sm">
                        <div
                            class="relative w-10 h-10 rounded-lg overflow-hidden shrink-0"
                        >
                            <img
                            class="w-full h-full object-cover"
                            data-alt="Chân dung kỹ sư nam dự phòng hệ thống CNTT đang tập trung làm việc với máy tính xách tay trong văn phòng công sở"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCraUs3QC6FEqxPj92OzWOVTmCVl8iiPZJQIxYb8cmDuv1HGa3sW3Pp66HQdZIiVPDn5hzunyKCMxW9ajLoH0nU_j5ACz9fcTMTjIc8u_NbMU3RyYVq30-r_rSXM-sPilDrJfdN8te_JpXDhBROPi_aOXX0nGrB4MIOiYC3T9DoHsaQuryIqpMxxVFnnSAL-mvfa-ghPJhZMVhQGHuPtPMfQjVhd4_ChyOqLapLJWg"
                            />
                            <div
                            class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-secondary-container ring-1 ring-surface-container-lowest"
                            ></div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-1">
                            <span
                                class="font-body-md-bold text-body-md-bold text-on-surface"
                                >Đặng Tiến Dũng</span
                            >
                            <span
                                class="px-1.5 py-0.2 rounded bg-surface-container-highest text-on-surface-variant font-label-sm text-[10px] font-bold uppercase"
                                >Dự phòng</span
                            >
                            </div>
                            <span class="font-body-sm text-body-sm text-outline"
                            >Kỹ sư dự phòng (Backup On-call)</span
                            >
                        </div>
                        </div>
                        <div class="text-right">
                        <span class="font-label-sm text-label-sm text-outline"
                            >Standby Mode</span
                        >
                        <p
                            class="font-body-sm text-body-sm text-on-surface font-medium"
                        >
                            Ext: 8819
                        </p>
                        </div>
                    </div>
                    </div>
                    <!-- Weekly On-call Mini Calendar -->
                    <div class="p-space-sm rounded-xl bg-surface-container-low">
                    <p
                        class="font-label-sm text-label-sm text-outline uppercase font-semibold mb-2"
                    >
                        Phân bổ ca trực các ngày trong tuần
                    </p>
                    <div class="grid grid-cols-7 gap-1 text-center">
                        <div class="p-1 rounded bg-surface-container-lowest">
                        <span
                            class="font-label-sm text-[10px] text-outline block"
                            >T2</span
                        >
                        <span
                            class="font-label-md text-label-md text-on-surface font-bold"
                            >09</span
                        >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-tertiary-container mx-auto mt-0.5 block"
                        ></span>
                        </div>
                        <div class="p-1 rounded bg-surface-container-lowest">
                        <span
                            class="font-label-sm text-[10px] text-outline block"
                            >T3</span
                        >
                        <span
                            class="font-label-md text-label-md text-on-surface font-bold"
                            >10</span
                        >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-tertiary-container mx-auto mt-0.5 block"
                        ></span>
                        </div>
                        <div
                        class="p-1 rounded bg-primary-container text-on-primary shadow-xs"
                        >
                        <span
                            class="font-label-sm text-[10px] text-primary-fixed block"
                            >H.Nay</span
                        >
                        <span class="font-label-md text-label-md font-bold"
                            >11</span
                        >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-secondary-container mx-auto mt-0.5 block"
                        ></span>
                        </div>
                        <div class="p-1 rounded bg-surface-container-lowest">
                        <span
                            class="font-label-sm text-[10px] text-outline block"
                            >T5</span
                        >
                        <span
                            class="font-label-md text-label-md text-on-surface font-bold"
                            >12</span
                        >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-secondary-container mx-auto mt-0.5 block"
                        ></span>
                        </div>
                        <div class="p-1 rounded bg-surface-container-lowest">
                        <span
                            class="font-label-sm text-[10px] text-outline block"
                            >T6</span
                        >
                        <span
                            class="font-label-md text-label-md text-on-surface font-bold"
                            >13</span
                        >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-secondary-container mx-auto mt-0.5 block"
                        ></span>
                        </div>
                        <div
                        class="p-1 rounded bg-surface-container-lowest opacity-60"
                        >
                        <span
                            class="font-label-sm text-[10px] text-outline block"
                            >T7</span
                        >
                        <span
                            class="font-label-md text-label-md text-on-surface font-bold"
                            >14</span
                        >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-outline mx-auto mt-0.5 block"
                        ></span>
                        </div>
                        <div
                        class="p-1 rounded bg-surface-container-lowest opacity-60"
                        >
                        <span
                            class="font-label-sm text-[10px] text-outline block"
                            >CN</span
                        >
                        <span
                            class="font-label-md text-label-md text-on-surface font-bold"
                            >15</span
                        >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-outline mx-auto mt-0.5 block"
                        ></span>
                        </div>
                    </div>
                    </div>
                    <button
                    class="mt-space-md w-full py-2 rounded-xl bg-surface-container-low text-secondary font-label-md text-label-md hover:bg-surface-container transition-all flex items-center justify-center gap-1.5"
                    >
                    <span class="material-symbols-outlined text-[18px]"
                        >swap_horiz</span
                    >
                    Đổi ca trực khẩn cấp
                    </button>
                </div>
                </div>
            </div>
            <!-- Notification Toast Container (Dynamic inline js) -->
            <div
                class="fixed bottom-6 right-6 transform translate-y-24 opacity-0 transition-all duration-300 pointer-events-none z-50 flex items-center gap-space-sm px-space-md py-3 rounded-xl bg-inverse-surface text-inverse-on-surface shadow-xl"
                id="toast-notify"
            >
                <span
                class="material-symbols-outlined text-tertiary-fixed text-[22px]"
                >check_circle</span
                >
                <span class="font-body-md text-body-md" id="toast-message"
                >Thao tác thành công!</span
                >
            </div>
            <script>
                function showNotification(msg) {
                const toast = document.getElementById("toast-notify");
                const toastMsg = document.getElementById("toast-message");
                if (!toast || !toastMsg) return;
                toastMsg.innerText = msg;
                toast.classList.remove(
                    "translate-y-24",
                    "opacity-0",
                    "pointer-events-none",
                );
                toast.classList.add("translate-y-0", "opacity-100");
                setTimeout(() => {
                    toast.classList.remove("translate-y-0", "opacity-100");
                    toast.classList.add(
                    "translate-y-24",
                    "opacity-0",
                    "pointer-events-none",
                    );
                }, 3500);
                }

                function checkEmptyState() {
                const list = document.getElementById("approval-list");
                const emptyBox = document.getElementById("empty-approvals");
                const batchBtn = document.getElementById("batch-approve-btn");
                if (!list) return;
                const remaining = list.querySelectorAll(".approval-card");
                if (remaining.length === 0) {
                    if (emptyBox) emptyBox.classList.remove("hidden");
                    if (batchBtn) {
                    batchBtn.disabled = true;
                    batchBtn.classList.add("opacity-50", "cursor-not-allowed");
                    batchBtn.innerHTML =
                        '<span class="material-symbols-outlined text-[18px]">done_all</span> Đã duyệt hết đơn';
                    }
                } else if (batchBtn) {
                    batchBtn.innerHTML =
                    '<span class="material-symbols-outlined text-[18px]">done_all</span> Duyệt tất cả đơn hợp lệ (' +
                    remaining.length +
                    ")";
                }
                }

                function approveSingle(cardId) {
                const card = document.querySelector(
                    '[data-id="' + cardId + '"]',
                );
                if (card) {
                    card.style.transition = "all 0.3s ease";
                    card.style.transform = "translateX(20px)";
                    card.style.opacity = "0";
                    setTimeout(() => {
                    card.remove();
                    checkEmptyState();
                    showNotification(
                        "Phó phòng Trần Thị Bích đã duyệt thành công đơn yêu cầu.",
                    );
                    }, 300);
                }
                }

                function rejectSingle(cardId) {
                const card = document.querySelector(
                    '[data-id="' + cardId + '"]',
                );
                if (card) {
                    card.style.transition = "all 0.3s ease";
                    card.style.opacity = "0";
                    setTimeout(() => {
                    card.remove();
                    checkEmptyState();
                    showNotification(
                        "Đã từ chối đơn yêu cầu và gửi phản hồi tới nhân viên.",
                    );
                    }, 300);
                }
                }

                function handleBatchApprove() {
                const list = document.getElementById("approval-list");
                if (!list) return;
                const cards = list.querySelectorAll(".approval-card");
                if (cards.length === 0) return;
                cards.forEach((card, index) => {
                    setTimeout(() => {
                    card.style.transition = "all 0.25s ease";
                    card.style.transform = "translateY(-10px)";
                    card.style.opacity = "0";
                    }, index * 100);
                });
                setTimeout(
                    () => {
                    list.innerHTML = "";
                    checkEmptyState();
                    showNotification(
                        "Đã phê duyệt hàng loạt toàn bộ 3 đơn hợp lệ của Tuần 24!",
                    );
                    },
                    cards.length * 100 + 200,
                );
                }
            </script>
            </div>
        </div>

@endsection




