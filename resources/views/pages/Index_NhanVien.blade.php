@extends('layout.app')
@section('content')
                <div class="max-w-[1440px] mx-auto p-space-lg">
                <div class="flex flex-col w-full gap-space-lg">
                    <div
                        class="relative overflow-hidden rounded-xl bg-surface-container-lowest p-space-lg shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-space-md">
                        <div
                            class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-secondary-container/10 blur-3xl pointer-events-none">
                        </div>
                        <div class="flex flex-col gap-space-xs z-10">
                            <div class="flex items-center gap-space-sm flex-wrap">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm">
                                    <span class="w-2 h-2 rounded-full bg-secondary animate-ping"></span>
                                    Đang làm việc tại văn phòng
                                </span>
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-surface-container font-label-sm text-label-sm text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[14px]">wifi</span>
                                    Wi-Fi: LiHKn_Corp_T4 (5GHz)
                                </span>
                            </div>
                            <h1 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">
                                Xin chào, Nguyễn Văn An
                            </h1>
                            <p class="font-body-md text-body-md text-on-surface-variant flex items-center gap-2">
                                <span>Kỹ sư Phần mềm Senior</span>
                                <span>•</span>
                                <span class="font-body-md-bold text-body-md-bold text-secondary">Khối Công nghệ &amp;
                                    Sản phẩm (Tech &amp; Product Division)</span>
                            </p>
                        </div>
                        <div
                            class="flex items-center gap-space-md z-10 w-full md:w-auto justify-between md:justify-end">
                            <div class="flex flex-col text-right">
                                <div
                                    class="font-label-sm text-label-sm uppercase tracking-wider text-outline font-semibold">
                                    Thời gian hệ thống</div>
                                <div class="font-headline-md text-headline-md text-primary font-bold tabular-nums"
                                    id="liveClock">08:42:15</div>
                                <div class="font-body-sm text-body-sm text-on-surface-variant">Thứ Năm, 24/10/2024
                                </div>
                            </div>
                            <div class="h-10 w-px bg-surface-container-high hidden sm:block"></div>
                            <div class="flex items-center gap-space-sm">
                                <button
                                    class="flex items-center gap-2 px-space-md py-3 rounded-xl bg-primary-container text-on-primary font-body-md-bold text-body-md-bold shadow-md hover:bg-primary transition-all active:scale-95"
                                    id="checkInBtn" onclick="toggleAttendance()">
                                    <span class="material-symbols-outlined text-[20px]">fingerprint</span>
                                    <span id="checkInText">Điểm danh Check-out</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md">
                        <div
                            class="rounded-xl bg-surface-container-lowest p-space-md shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span class="font-label-md text-label-md text-on-surface-variant block">Công chuẩn
                                        tháng</span>
                                    <div class="flex items-baseline gap-1 mt-1">
                                        <span
                                            class="font-headline-xl text-headline-xl text-primary font-bold">21</span>
                                        <span class="font-body-lg text-body-lg text-outline">/ 22 ngày</span>
                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[22px]">calendar_today</span>
                                </div>
                            </div>
                            <div class="mt-space-md">
                                <div class="w-full bg-surface-container-low rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-secondary-container h-1.5 rounded-full" style="width: 95.4%"></div>
                                </div>
                                <span class="font-label-sm text-label-sm text-secondary font-semibold mt-1.5 block">Đạt
                                    95.4% kế hoạch tháng 10</span>
                            </div>
                        </div>
                        <div
                            class="rounded-xl bg-surface-container-lowest p-space-md shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span class="font-label-md text-label-md text-on-surface-variant block">Phép năm
                                        khả dụng</span>
                                    <div class="flex items-baseline gap-1 mt-1">
                                        <span
                                            class="font-headline-xl text-headline-xl text-primary font-bold">9.5</span>
                                        <span class="font-body-lg text-body-lg text-outline">ngày</span>
                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined text-[22px]">flight_takeoff</span>
                                </div>
                            </div>
                            <div class="mt-space-md flex items-center justify-between font-label-sm text-label-sm">
                                <span class="text-on-surface-variant">Đã dùng: 2.5 ngày</span>
                                <span class="text-primary font-semibold">Hạn: 31/12/2024</span>
                            </div>
                        </div>
                        <div
                            class="rounded-xl bg-surface-container-lowest p-space-md shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span class="font-label-md text-label-md text-on-surface-variant block">Tích lũy OT
                                        tháng</span>
                                    <div class="flex items-baseline gap-1 mt-1">
                                        <span
                                            class="font-headline-xl text-headline-xl text-primary font-bold">6.0</span>
                                        <span class="font-body-lg text-body-lg text-outline">giờ</span>
                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-tertiary-container">
                                    <span class="material-symbols-outlined text-[22px]">schedule</span>
                                </div>
                            </div>
                            <div class="mt-space-md flex items-center gap-1.5">
                                <span class="inline-block w-2 h-2 rounded-full bg-secondary"></span>
                                <span class="font-label-sm text-label-sm text-secondary font-medium">Đã được Quản lý
                                    duyệt 100%</span>
                            </div>
                        </div>
                        <div
                            class="rounded-xl bg-surface-container-lowest p-space-md shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span class="font-label-md text-label-md text-on-surface-variant block">Hiệu suất
                                        Sprint #42</span>
                                    <div class="flex items-baseline gap-1 mt-1">
                                        <span
                                            class="font-headline-xl text-headline-xl text-primary font-bold">94%</span>
                                        <span class="font-label-sm text-label-sm text-secondary font-bold">Xuất
                                            sắc</span>
                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[22px]">trending_up</span>
                                </div>
                            </div>
                            <div class="mt-space-md flex items-center gap-2">
                                <svg class="w-12 h-4 text-secondary-container" fill="none" stroke="currentColor"
                                    viewbox="0 0 48 16">
                                    <path d="M1 12l8-6 8 3 12-8 10 5 8-4" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                                <span class="font-label-sm text-label-sm text-on-surface-variant">Vượt +4% so với
                                    Sprint trước</span>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-xl bg-surface-container-lowest p-space-md shadow-sm">
                        <div class="flex items-center justify-between mb-space-sm">
                            <span
                                class="font-label-md text-label-md text-outline uppercase tracking-wider font-semibold">Tác
                                vụ truy cập nhanh</span>
                            <span class="font-label-sm text-label-sm text-secondary">Phím tắt thao tác 1-chạm</span>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-space-sm">
                            <button
                                class="flex flex-col items-center justify-center p-3 rounded-xl bg-surface-container-low hover:bg-surface-container transition-all group text-center gap-2">
                                <div
                                    class="w-10 h-10 rounded-lg bg-surface-container-lowest text-primary shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[22px]">event_busy</span>
                                </div>
                                <span
                                    class="font-body-md-bold text-body-md-bold text-on-surface group-hover:text-primary transition-colors">Tạo
                                    đơn nghỉ phép</span>
                                <span class="font-body-sm text-body-sm text-outline">Nghỉ phép, việc riêng</span>
                            </button>
                            <button
                                class="flex flex-col items-center justify-center p-3 rounded-xl bg-surface-container-low hover:bg-surface-container transition-all group text-center gap-2">
                                <div
                                    class="w-10 h-10 rounded-lg bg-surface-container-lowest text-secondary shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[22px]">home_work</span>
                                </div>
                                <span
                                    class="font-body-md-bold text-body-md-bold text-on-surface group-hover:text-primary transition-colors">Đăng
                                    ký WFH</span>
                                <span class="font-body-sm text-body-sm text-outline">Làm việc từ xa</span>
                            </button>
                            <button
                                class="flex flex-col items-center justify-center p-3 rounded-xl bg-surface-container-low hover:bg-surface-container transition-all group text-center gap-2">
                                <div
                                    class="w-10 h-10 rounded-lg bg-surface-container-lowest text-primary shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[22px]">more_time</span>
                                </div>
                                <span
                                    class="font-body-md-bold text-body-md-bold text-on-surface group-hover:text-primary transition-colors">Phiếu
                                    OT ngoài giờ</span>
                                <span class="font-body-sm text-body-sm text-outline">Đăng ký trước 18h</span>
                            </button>
                            <button
                                class="flex flex-col items-center justify-center p-3 rounded-xl bg-surface-container-low hover:bg-surface-container transition-all group text-center gap-2">
                                <div
                                    class="w-10 h-10 rounded-lg bg-surface-container-lowest text-secondary shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[22px]">lock_reset</span>
                                </div>
                                <span
                                    class="font-body-md-bold text-body-md-bold text-on-surface group-hover:text-primary transition-colors">Phiếu
                                    lương bảo mật</span>
                                <span class="font-body-sm text-body-sm text-outline">Xác thực OTP 2FA</span>
                            </button>
                            <button
                                class="flex flex-col items-center justify-center p-3 rounded-xl bg-surface-container-low hover:bg-surface-container transition-all group text-center gap-2 col-span-2 sm:col-span-1">
                                <div
                                    class="w-10 h-10 rounded-lg bg-surface-container-lowest text-primary shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[22px]">devices</span>
                                </div>
                                <span
                                    class="font-body-md-bold text-body-md-bold text-on-surface group-hover:text-primary transition-colors">Cấp
                                    phát thiết bị</span>
                                <span class="font-body-sm text-body-sm text-outline">Màn hình, linh kiện</span>
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
                        <div class="lg:col-span-7 flex flex-col gap-space-lg">
                            <div
                                class="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm flex flex-col gap-space-md">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-space-sm">
                                        <span
                                            class="material-symbols-outlined text-primary text-[24px]">task_alt</span>
                                        <h2 class="font-headline-md text-headline-md text-primary font-bold">Nhiệm vụ
                                            &amp; Lịch làm việc hôm nay</h2>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-secondary-fixed font-label-sm text-label-sm text-on-secondary-fixed font-bold">3
                                        Nhiệm vụ trọng tâm</span>
                                </div>
                                <div class="flex flex-col gap-space-sm">
                                    <div
                                        class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all flex items-start justify-between gap-space-md">
                                        <div class="flex items-start gap-space-sm">
                                            <div
                                                class="w-9 h-9 rounded-lg bg-secondary-container/20 text-secondary flex items-center justify-center shrink-0 mt-0.5">
                                                <span class="material-symbols-outlined text-[20px]">groups</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <div class="flex items-center gap-2">
                                                    <span
                                                        class="font-body-md-bold text-body-md-bold text-on-surface">Cuộc
                                                        họp Daily Sprint #42</span>
                                                    <span
                                                        class="px-1.5 py-0.2 rounded bg-surface-container text-on-surface-variant font-label-sm text-label-sm">Bắt
                                                        buộc</span>
                                                </div>
                                                <span class="font-body-sm text-body-sm text-outline mt-0.5">Phòng họp
                                                    Sydney (Tầng 4) &amp; Google Meet</span>
                                                <span
                                                    class="font-label-sm text-label-sm text-secondary font-semibold mt-1">09:30
                                                    - 10:00 (Trong 45 phút nữa)</span>
                                            </div>
                                        </div>
                                        <button
                                            class="px-3 py-1.5 rounded-lg bg-surface-container-lowest text-on-surface font-label-md text-label-md shadow-sm hover:text-primary transition-colors shrink-0">
                                            Tham gia Meet
                                        </button>
                                    </div>
                                    <div
                                        class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all flex items-start justify-between gap-space-md">
                                        <div class="flex items-start gap-space-sm">
                                            <div
                                                class="w-9 h-9 rounded-lg bg-primary-container/10 text-primary flex items-center justify-center shrink-0 mt-0.5">
                                                <span class="material-symbols-outlined text-[20px]">code</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-body-md-bold text-body-md-bold text-on-surface">Review
                                                    Pull Request Gitlab #1284</span>
                                                <span class="font-body-sm text-body-sm text-outline mt-0.5">Module:
                                                    Tích hợp Cổng thanh toán LiHKn Pay v2</span>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span
                                                        class="font-label-sm text-label-sm text-on-surface-variant">Reviewer
                                                        được chỉ định bởi: Trần Tuấn Anh</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button
                                            class="px-3 py-1.5 rounded-lg bg-surface-container-lowest text-on-surface font-label-md text-label-md shadow-sm hover:text-primary transition-colors shrink-0">
                                            Xem code PR
                                        </button>
                                    </div>
                                    <div
                                        class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all flex items-start justify-between gap-space-md">
                                        <div class="flex items-start gap-space-sm">
                                            <div
                                                class="w-9 h-9 rounded-lg bg-error-container/30 text-error flex items-center justify-center shrink-0 mt-0.5">
                                                <span class="material-symbols-outlined text-[20px]">flag</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-body-md-bold text-body-md-bold text-on-surface">Deadline:
                                                    Báo cáo kết quả Sprint Release</span>
                                                <span class="font-body-sm text-body-sm text-outline mt-0.5">Gửi tài
                                                    liệu nghiệm thu cho Product Owner và QA Team</span>
                                                <span
                                                    class="font-label-sm text-label-sm text-error font-semibold mt-1">Hạn
                                                    chót: 17:30 hôm nay</span>
                                            </div>
                                        </div>
                                        <button
                                            class="px-3 py-1.5 rounded-lg bg-surface-container-lowest text-on-surface font-label-md text-label-md shadow-sm hover:text-primary transition-colors shrink-0">
                                            Nộp báo cáo
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm flex flex-col gap-space-md">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-space-sm">
                                        <span
                                            class="material-symbols-outlined text-secondary text-[24px]">history_toggle_off</span>
                                        <h2 class="font-headline-md text-headline-md text-primary font-bold">Tiến độ
                                            chấm công 7 ngày gần nhất</h2>
                                    </div>
                                    <span class="font-body-sm text-body-sm text-outline">Chu kỳ: 18/10 - 24/10</span>
                                </div>
                                <div class="grid grid-cols-7 gap-2 text-center">
                                    <div class="flex flex-col items-center p-2 rounded-xl bg-surface-container-low">
                                        <span class="font-label-sm text-label-sm text-outline">T6</span>
                                        <span class="font-headline-sm text-headline-sm text-on-surface my-1">18</span>
                                        <span
                                            class="w-6 h-6 rounded-full bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center text-[14px]">
                                            <span class="material-symbols-outlined text-[16px]">check</span>
                                        </span>
                                        <span class="font-label-sm text-label-sm text-outline mt-1">8.5h</span>
                                    </div>
                                    <div
                                        class="flex flex-col items-center p-2 rounded-xl bg-surface-container-low opacity-60">
                                        <span class="font-label-sm text-label-sm text-outline">T7</span>
                                        <span class="font-headline-sm text-headline-sm text-on-surface my-1">19</span>
                                        <span
                                            class="w-6 h-6 rounded-full bg-surface-container flex items-center justify-center text-[14px] text-outline">
                                            -
                                        </span>
                                        <span class="font-label-sm text-label-sm text-outline mt-1">Nghỉ</span>
                                    </div>
                                    <div
                                        class="flex flex-col items-center p-2 rounded-xl bg-surface-container-low opacity-60">
                                        <span class="font-label-sm text-label-sm text-outline">CN</span>
                                        <span class="font-headline-sm text-headline-sm text-on-surface my-1">20</span>
                                        <span
                                            class="w-6 h-6 rounded-full bg-surface-container flex items-center justify-center text-[14px] text-outline">
                                            -
                                        </span>
                                        <span class="font-label-sm text-label-sm text-outline mt-1">Nghỉ</span>
                                    </div>
                                    <div class="flex flex-col items-center p-2 rounded-xl bg-surface-container-low">
                                        <span class="font-label-sm text-label-sm text-outline">T2</span>
                                        <span class="font-headline-sm text-headline-sm text-on-surface my-1">21</span>
                                        <span
                                            class="w-6 h-6 rounded-full bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center text-[14px]">
                                            <span class="material-symbols-outlined text-[16px]">check</span>
                                        </span>
                                        <span class="font-label-sm text-label-sm text-outline mt-1">8.0h</span>
                                    </div>
                                    <div class="flex flex-col items-center p-2 rounded-xl bg-surface-container-low">
                                        <span class="font-label-sm text-label-sm text-outline">T3</span>
                                        <span class="font-headline-sm text-headline-sm text-on-surface my-1">22</span>
                                        <span
                                            class="w-6 h-6 rounded-full bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center text-[14px]">
                                            <span class="material-symbols-outlined text-[16px]">check</span>
                                        </span>
                                        <span class="font-label-sm text-label-sm text-outline mt-1">9.2h</span>
                                    </div>
                                    <div class="flex flex-col items-center p-2 rounded-xl bg-surface-container-low">
                                        <span class="font-label-sm text-label-sm text-outline">T4</span>
                                        <span class="font-headline-sm text-headline-sm text-on-surface my-1">23</span>
                                        <span
                                            class="w-6 h-6 rounded-full bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center text-[14px]">
                                            <span class="material-symbols-outlined text-[16px]">check</span>
                                        </span>
                                        <span class="font-label-sm text-label-sm text-outline mt-1">8.1h</span>
                                    </div>
                                    <div
                                        class="flex flex-col items-center p-2 rounded-xl bg-primary-container text-on-primary shadow-sm">
                                        <span class="font-label-sm text-label-sm text-secondary-fixed">Hôm nay</span>
                                        <span class="font-headline-sm text-headline-sm font-bold my-1">24</span>
                                        <span
                                            class="w-6 h-6 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center text-[14px]">
                                            <span class="material-symbols-outlined text-[16px]">schedule</span>
                                        </span>
                                        <span class="font-label-sm text-label-sm text-primary-fixed mt-1">Vào
                                            08:15</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-2">
                                    <div
                                        class="flex items-center gap-4 text-on-surface-variant font-body-sm text-body-sm">
                                        <span class="flex items-center gap-1.5">
                                            <span class="w-2.5 h-2.5 rounded-full bg-secondary"></span> Đúng giờ
                                        </span>
                                        <span class="flex items-center gap-1.5">
                                            <span class="w-2.5 h-2.5 rounded-full bg-error"></span> Đi muộn / Về sớm
                                        </span>
                                        <span class="flex items-center gap-1.5">
                                            <span class="w-2.5 h-2.5 rounded-full bg-outline-variant"></span> Cuối tuần
                                        </span>
                                    </div>
                                    <button
                                        class="font-label-md text-label-md text-secondary hover:text-primary transition-colors flex items-center gap-1">
                                        Bảng chấm công chi tiết
                                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-span-5 flex flex-col gap-space-lg">
                            <div
                                class="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm flex flex-col gap-space-md">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-space-sm">
                                        <span
                                            class="material-symbols-outlined text-secondary text-[24px]">campaign</span>
                                        <h2 class="font-headline-md text-headline-md text-primary font-bold">Bản tin
                                            nội bộ LiHKn</h2>
                                    </div>
                                    <span class="font-label-sm text-label-sm text-outline">Cập nhật 15 phút
                                        trước</span>
                                </div>
                                <div class="relative rounded-xl overflow-hidden shadow-sm group">
                                    <div class="h-44 w-full bg-cover bg-center transition-transform duration-300 group-hover:scale-105"
                                        data-alt="A modern tech hackathon banner with vivid deep navy blue lighting, dynamic holographic code lines, Vietnamese young software engineers collaborating over laptops in a high-tech corporate innovation center, highly detailed SaaS corporate enterprise aesthetic."
                                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuABV2Pss_jjGRu9pmZ3MiVl5PGWkx1zQfoC8GNgYcpVZ6vVhcMjGLCPN56VUltcXJ9pxZAQQwZri4MzCuvixzbV80ua8tM0AXn-mEt4IWcVz3nn-GcAa1fc00r_FRHwAiLM7RyiO75TriwQv6Uw045nIphVrWHhutGnMa_hrc8mjI601yOoPhwUScqJbyxzhSsV8V2Pi56BXMyPVYK4HeXEkfCNHsMLZM3CNWPb6jA')">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-primary via-primary/60 to-transparent p-space-md flex flex-col justify-end text-on-primary">
                                            <span
                                                class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-label-sm text-label-sm w-fit font-bold mb-1">
                                                SỰ KIỆN LỚN
                                            </span>
                                            <h3 class="font-headline-sm text-headline-sm font-bold leading-tight">
                                                Cuộc thi Hackathon LiHKn Q2: Đổi mới Sáng tạo AI
                                            </h3>
                                            <p class="font-body-sm text-body-sm text-primary-fixed mt-1">
                                                Tổng giá trị giải thưởng lên tới 100.000.000 VNĐ. Hạn chót đăng ký đội
                                                thi: 30/10/2024.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-space-sm mt-1">
                                    <div
                                        class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all flex items-start gap-space-sm cursor-pointer">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-surface-container-lowest flex items-center justify-center text-primary shrink-0 shadow-sm">
                                            <span class="material-symbols-outlined text-[22px]">medical_services</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-body-md-bold text-body-md-bold text-on-surface">Thông báo
                                                Tiêm Vắc-xin Cúm mùa Miễn phí</span>
                                            <span
                                                class="font-body-sm text-body-sm text-on-surface-variant mt-0.5 line-clamp-2">Phòng
                                                Y tế Doanh nghiệp tổ chức khám và tiêm ngừa cho toàn thể CBNV tại Trụ sở
                                                HN &amp; Chi nhánh HCM.</span>
                                            <span class="font-label-sm text-label-sm text-outline mt-1">23/10/2024 •
                                                Ban Phúc lợi Nhân sự</span>
                                        </div>
                                    </div>
                                    <div
                                        class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all flex items-start gap-space-sm cursor-pointer">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-surface-container-lowest flex items-center justify-center text-secondary shrink-0 shadow-sm">
                                            <span
                                                class="material-symbols-outlined text-[22px]">workspace_premium</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-body-md-bold text-body-md-bold text-on-surface">Vinh danh
                                                Ngôi sao Tháng 9: Tech Pioneers</span>
                                            <span
                                                class="font-body-sm text-body-sm text-on-surface-variant mt-0.5 line-clamp-2">Chúc
                                                mừng 5 cá nhân và 2 đội ngũ dự án hoàn thành xuất sắc KPI và cam kết
                                                chất lượng sản phẩm.</span>
                                            <span class="font-label-sm text-label-sm text-outline mt-1">21/10/2024 •
                                                Truyền thông Nội bộ</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="p-space-md rounded-xl bg-surface-container flex items-center justify-between">
                                    <div class="flex items-center gap-space-sm">
                                        <span class="material-symbols-outlined text-primary text-[20px]">forum</span>
                                        <div class="flex flex-col">
                                            <span class="font-body-md-bold text-body-md-bold text-on-surface">Kênh trao
                                                đổi nội bộ Slack</span>
                                            <span
                                                class="font-body-sm text-body-sm text-outline">#all-lihkn-announcements</span>
                                        </div>
                                    </div>
                                    <button
                                        class="px-3 py-1.5 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-colors">
                                        Tham gia
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function updateClock() {
                        const clockEl = document.getElementById('liveClock');
                        if (!clockEl) return;
                        const now = new Date();
                        const hours = String(now.getHours()).padStart(2, '0');
                        const minutes = String(now.getMinutes()).padStart(2, '0');
                        const seconds = String(now.getSeconds()).padStart(2, '0');
                        clockEl.textContent = `${hours}:${minutes}:${seconds}`;
                    }
                    setInterval(updateClock, 1000);

                    let isCheckedIn = true;

                    function toggleAttendance() {
                        const textEl = document.getElementById('checkInText');
                        const btnEl = document.getElementById('checkInBtn');
                        if (!textEl || !btnEl) return;

                        if (isCheckedIn) {
                            isCheckedIn = false;
                            textEl.textContent = 'Xác nhận Check-in';
                            btnEl.classList.remove('bg-primary-container', 'hover:bg-primary');
                            btnEl.classList.add('bg-secondary', 'hover:bg-secondary/90');
                        } else {
                            isCheckedIn = true;
                            textEl.textContent = 'Điểm danh Check-out';
                            btnEl.classList.remove('bg-secondary', 'hover:bg-secondary/90');
                            btnEl.classList.add('bg-primary-container', 'hover:bg-primary');
                        }
                    }
                </script>
            </div>

@endsection

