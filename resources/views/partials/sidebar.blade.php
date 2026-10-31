    <aside class="fixed left-0 top-0 h-screen w-72 bg-surface-container-lowest shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-50 flex flex-col justify-between select-none">
        <div class="flex flex-col">
            <div class="h-20 px-space-lg flex items-center justify-between">
                <div class="flex items-center gap-space-sm">
                    <div class="w-10 h-10 rounded-xl bg-primary-container flex items-center justify-center shadow-[0_2px_6px_rgba(0,35,111,0.25)]"><span class="material-symbols-outlined text-on-primary text-[24px]">corporate_fare</span></div>
                    <div class="flex flex-col"><span class="font-headline-md text-headline-md tracking-tight text-primary leading-tight">LiHKn HRM</span><span class="font-label-sm text-label-sm uppercase text-secondary tracking-widest">Enterprise</span></div>
                </div><span class="w-2 h-2 rounded-full bg-secondary-container" title="Hệ thống trực tuyến"></span>
            </div>
            <div class="px-space-md py-space-xs">
                <p class="px-space-sm py-space-xs font-label-sm text-label-sm uppercase tracking-wider text-outline">Phân hệ điều hành</p>
                <nav class="flex flex-col gap-space-xs" data-active-classes="bg-primary-container text-on-primary font-body-md-bold shadow-[0_1px_4px_rgba(30,58,138,0.25)]"><a class="flex items-center gap-space-sm px-space-md py-3 rounded-xl font-body-md text-body-md text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-all" data-path="dashboard-tong-quan" href="#"><span class="material-symbols-outlined text-[20px]">grid_view</span><span>Tổng quan Dashboard</span></a><a class="flex items-center gap-space-sm px-space-md py-3 rounded-xl font-body-md text-body-md text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-all" data-path="nhan-su-va-ho-so" href="#"><span class="material-symbols-outlined text-[20px]">badge</span><span>Nhân sự &amp; Hồ sơ</span></a><a class="flex items-center gap-space-sm px-space-md py-3 rounded-xl font-body-md text-body-md text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-all" data-path="cham-cong-va-ca-kip" href="#"><span class="material-symbols-outlined text-[20px]">schedule</span><span>Chấm công &amp; Ca kíp</span></a><a class="flex items-center gap-space-sm px-space-md py-3 rounded-xl font-body-md text-body-md text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-all" data-path="tien-luong-va-phuc-loi" href="#"><span class="material-symbols-outlined text-[20px]">payments</span><span>Tiền lương &amp; Phúc lợi</span></a><a class="flex items-center justify-between px-space-md py-3 rounded-xl font-body-md text-body-md text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-all" data-path="phe-duyet-va-don-tu" href="#">
                        <div class="flex items-center gap-space-sm"><span class="material-symbols-outlined text-[20px]">fact_check</span><span>Phê duyệt &amp; Đơn từ</span></div><span class="px-space-xs py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm">5</span>
                    </a><a class="flex items-center gap-space-sm px-space-md py-3 rounded-xl font-body-md text-body-md text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-all" data-path="bao-cao-va-phan-tich" href="#"><span class="material-symbols-outlined text-[20px]">query_stats</span><span>Báo cáo &amp; Phân tích</span></a><a class="flex items-center gap-space-sm px-space-md py-3 rounded-xl font-body-md text-body-md text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-all" data-path="cai-dat-he-thong" href="#"><span class="material-symbols-outlined text-[20px]">settings</span><span>Cài đặt hệ thống</span></a></nav>
            </div>
        </div>
        <div class="p-space-md m-space-md bg-surface-container-low rounded-xl flex items-center justify-between">
            <div class="flex items-center gap-space-sm"><span class="material-symbols-outlined text-secondary text-[22px]">domain</span>
                <div class="flex flex-col"><span class="font-label-md text-label-md text-on-surface font-semibold">LiHKn Corp</span><span class="font-body-sm text-body-sm text-outline">Headquarters VN</span></div>
            </div><span class="material-symbols-outlined text-outline text-[18px]">verified</span>
        </div>
        <!-- Nút đăng xuất trong Sidebar -->
        <div class="mt-auto px-4 py-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3
                        bg-red-600 hover:bg-red-700
                        text-white rounded-lg transition duration-200"
                >
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Đăng xuất</span>
                </button>
            </form>
        </div>
    </aside>