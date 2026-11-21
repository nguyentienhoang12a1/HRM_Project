<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Máy Chấm Công FaceID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api@1.7.12/dist/face-api.js"></script>
</head>

<body class="bg-slate-900 min-h-screen text-white flex flex-col items-center justify-center p-4">

    <div class="w-full max-w-2xl bg-slate-800 rounded-2xl p-6 shadow-2xl border border-slate-700 text-center space-y-6">
        <div class="flex items-center justify-between gap-2">
            <div class="text-left">
                <h1 class="text-3xl font-black tracking-wide text-blue-400">CHẤM CÔNG FACEID</h1>
                <p id="status-text" class="text-slate-400 mt-1 font-medium">Đang khởi tạo hệ thống AI...</p>
            </div>
            <a href="{{ route('chamcong.lichsu') }}"
                class="px-3 py-2 bg-slate-700 hover:bg-slate-600 text-slate-200 text-sm font-semibold rounded-lg transition shrink-0">
                📋 Lịch sử chấm công
            </a>
        </div>

        <!-- Khung hiển thị Camera -->
        <div
            class="relative w-full aspect-[4/3] bg-black rounded-xl overflow-hidden border-4 border-slate-700 shadow-2xl flex items-center justify-center">
            <video id="video" autoplay muted playsinline class="w-full h-full object-cover"></video>

            <div id="loading-overlay"
                class="absolute inset-0 bg-slate-900/80 flex flex-col items-center justify-center space-y-3">
                <div class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                <p class="text-slate-300 font-medium">Đang nạp CSDL khuôn mặt...</p>
            </div>

            <div class="absolute w-64 h-64 border-2 border-dashed border-blue-400/50 rounded-full pointer-events-none">
            </div>
        </div>

        <!-- Thông báo kết quả -->
        <div id="result-box" class="hidden p-3 rounded-xl font-bold text-base transition-all duration-300"></div>

        <!-- Nút chuyển sang trang Đăng ký FaceID chỉ hiện khi nhận diện đúng Admin -->
        <div id="admin-register-box" class="hidden">
            <a id="btn-admin-register" href="#"
                class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-base rounded-xl transition shadow-lg shadow-indigo-900/40 flex items-center justify-center gap-2">
                <span>🔐</span> NHẬN DIỆN ADMIN — CHUYỂN SANG ĐĂNG KÝ FACEID
            </a>
        </div>

        <!-- 2 NÚT CHECK-IN VÀ CHECK-OUT -->
        <div class="grid grid-cols-2 gap-4">
            <button id="btn-checkin" disabled onclick="handleAction('in')"
                class="py-4 bg-emerald-600 hover:bg-emerald-500 disabled:bg-slate-700 disabled:text-slate-500 disabled:cursor-not-allowed text-white font-bold text-lg rounded-xl transition shadow-lg shadow-emerald-900/40 flex items-center justify-center gap-2">
                <span>📥</span> CHECK-IN (VÀO)
            </button>
            <button id="btn-checkout" disabled onclick="handleAction('out')"
                class="py-4 bg-amber-600 hover:bg-amber-500 disabled:bg-slate-700 disabled:text-slate-500 disabled:cursor-not-allowed text-white font-bold text-lg rounded-xl transition shadow-lg shadow-amber-900/40 flex items-center justify-center gap-2">
                <span>📤</span> CHECK-OUT (RA)
            </button>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const statusText = document.getElementById('status-text');
        const loadingOverlay = document.getElementById('loading-overlay');
        const resultBox = document.getElementById('result-box');
        const btnCheckin = document.getElementById('btn-checkin');
        const btnCheckout = document.getElementById('btn-checkout');
        const adminRegisterBox = document.getElementById('admin-register-box');
        const btnAdminRegister = document.getElementById('btn-admin-register');

        let faceMatcher = null;
        let detectedEmployee = null;
        let lastCheckedEmployeeCode = null;
        let isCheckingAdmin = false;
        let isProcessing = false;
        let scanTimer = null;

        async function loadModelsWithFallback() {
            const urls = [
                'https://cdn.jsdelivr.net/npm/@vladmandic/face-api@1.7.12/model',
                'https://unpkg.com/@vladmandic/face-api@1.7.12/model',
            ];

            let lastError = null;
            for (const modelUrl of urls) {
                try {
                    await Promise.all([
                        faceapi.nets.ssdMobilenetv1.loadFromUri(modelUrl),
                        faceapi.nets.faceLandmark68Net.loadFromUri(modelUrl),
                        faceapi.nets.faceRecognitionNet.loadFromUri(modelUrl),
                    ]);
                    return;
                } catch (err) {
                    lastError = err;
                }
            }
            throw lastError || new Error('Không thể tải model FaceAPI');
        }

        async function initSystem() {
            try {
                if (typeof faceapi === 'undefined') {
                    statusText.innerText = "❌ Lỗi: Chưa nạp được thư viện face-api.js!";
                    loadingOverlay.classList.add('hidden');
                    return;
                }

                await loadModelsWithFallback();

                const res = await fetch("{{ route('chamcong.facedata') }}", {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) {
                    throw new Error(`HTTP ${res.status} khi tải face-data`);
                }

                const employees = await res.json();
                const labeledDescriptors = [];

                for (const emp of employees) {
                    const rawVector = typeof emp.face_vector === 'string' ?
                        JSON.parse(emp.face_vector) :
                        emp.face_vector;

                    if (Array.isArray(rawVector) && rawVector.length > 0) {
                        labeledDescriptors.push(
                            new faceapi.LabeledFaceDescriptors(
                                `${emp.ma_nhan_vien}|${emp.ho_ten}`,
                                [new Float32Array(rawVector)]
                            )
                        );
                    }
                }

                if (labeledDescriptors.length === 0) {
                    statusText.innerText = "⚠️ Chưa có dữ liệu nhân viên nào đăng ký FaceID hợp lệ!";
                    loadingOverlay.classList.add('hidden');
                    return;
                }

                faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.5);
                startCamera();
            } catch (err) {
                console.error("Lỗi khởi tạo FaceID:", err);
                statusText.innerText = `❌ Lỗi khởi tạo AI: ${err.message || 'Không thể tải dữ liệu/model'}`;
                loadingOverlay.classList.add('hidden');
            }
        }

        function startCamera() {
            navigator.mediaDevices.getUserMedia({
                    video: {
                        width: 640,
                        height: 480
                    }
                })
                .then(stream => {
                    video.srcObject = stream;
                    loadingOverlay.classList.add('hidden');
                    statusText.innerText = "👀 Hãy đứng trước màn hình để hệ thống nhận diện...";
                })
                .catch(err => {
                    console.error("Lỗi mở camera:", err);
                    loadingOverlay.classList.add('hidden');
                    statusText.innerText = "❌ Không thể mở Camera trên trình duyệt!";
                });
        }

        video.addEventListener('play', () => {
            if (scanTimer) clearInterval(scanTimer);

            scanTimer = setInterval(async () => {
                if (isProcessing || !faceMatcher || video.readyState < 2) return;

                try {
                    const detection = await faceapi
                        .detectSingleFace(video)
                        .withFaceLandmarks()
                        .withFaceDescriptor();

                    if (detection) {
                        const match = faceMatcher.findBestMatch(detection.descriptor);

                        if (match.label !== 'unknown') {
                            const [maNhanVien, hoTen] = match.label.split('|');
                            detectedEmployee = {
                                ma_nhan_vien: maNhanVien,
                                ho_ten: hoTen
                            };

                            statusText.innerHTML =
                                `🟢 Xin chào: <b class="text-blue-400 font-bold">${hoTen}</b> (${maNhanVien}) - Chọn nút bấm bên dưới:`;
                            toggleButtons(true);

                            if (lastCheckedEmployeeCode !== maNhanVien && !isCheckingAdmin) {
                                checkAdminByFace(maNhanVien);
                            }
                        } else {
                            resetState("⚠️ Khuôn mặt chưa được đăng ký trong CSDL!");
                        }
                    } else {
                        resetState("👀 Hãy đứng trước màn hình để hệ thống nhận diện...");
                    }
                } catch (err) {
                    console.error("Lỗi khi quét khuôn mặt:", err);
                }
            }, 1000);
        });

        async function checkAdminByFace(maNhanVien) {
            isCheckingAdmin = true;
            lastCheckedEmployeeCode = maNhanVien;

            try {
                const res = await fetch("{{ route('chamcong.verify.admin.face') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        ma_nhan_vien: maNhanVien
                    })
                });

                const data = await res.json();

                if (data.is_admin && data.redirect_url) {
                    const roleText = (data.role_label || 'ADMIN / HR').toUpperCase();
                    btnAdminRegister.innerHTML = `<span>🔐</span> NHẬN DIỆN ${roleText} — CHUYỂN SANG ĐĂNG KÝ FACEID`;
                    btnAdminRegister.href = data.redirect_url;
                    adminRegisterBox.classList.remove('hidden');
                } else {
                    adminRegisterBox.classList.add('hidden');
                    btnAdminRegister.href = '#';
                }
            } catch (err) {
                console.error("Lỗi kiểm tra quyền Admin qua FaceID:", err);
                adminRegisterBox.classList.add('hidden');
            } finally {
                isCheckingAdmin = false;
            }
        }

        function resetState(msg) {
            detectedEmployee = null;
            lastCheckedEmployeeCode = null;
            adminRegisterBox.classList.add('hidden');
            btnAdminRegister.href = '#';
            statusText.innerText = msg;
            toggleButtons(false);
        }

        function toggleButtons(enable) {
            btnCheckin.disabled = !enable;
            btnCheckout.disabled = !enable;
        }

        function handleAction(type) {
            if (!detectedEmployee || isProcessing) return;

            isProcessing = true;
            toggleButtons(false);

            showResult(`⏳ Đang ghi nhận lượt ${type === 'in' ? 'Check-in' : 'Check-out'}...`,
                'bg-blue-600/30 text-blue-300 border border-blue-500');

            fetch("{{ route('chamcong.luu') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        ma_nhan_vien: detectedEmployee.ma_nhan_vien,
                        loai_cham_cong: type
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        showResult(`✅ ${data.loai} thành công: ${data.ho_ten} (${data.thoi_gian})`,
                            'bg-emerald-600/30 text-emerald-300 border border-emerald-500');
                    } else {
                        showResult(`❌ ${data.message || 'Lỗi chấm công!'}`,
                            'bg-red-600/30 text-red-300 border border-red-500');
                    }

                    setTimeout(() => {
                        isProcessing = false;
                        resultBox.classList.add('hidden');
                    }, 3000);
                })
                .catch(err => {
                    console.error("Lỗi gửi dữ liệu:", err);
                    showResult("❌ Lỗi kết nối khi lưu chấm công!", 'bg-red-600/30 text-red-300 border border-red-500');
                    setTimeout(() => {
                        isProcessing = false;
                    }, 3000);
                });
        }

        function showResult(message, classes) {
            resultBox.className = `p-3 rounded-xl font-bold text-base transition-all duration-300 ${classes}`;
            resultBox.innerText = message;
            resultBox.classList.remove('hidden');
        }

        document.addEventListener("DOMContentLoaded", initSystem);
    </script>
</body>

</html>
