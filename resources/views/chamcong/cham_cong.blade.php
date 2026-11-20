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
        <div>
            <h1 class="text-3xl font-black tracking-wide text-blue-400">CHẤM CÔNG FACEID</h1>
            <p id="status-text" class="text-slate-400 mt-2 font-medium">Đang khởi tạo hệ thống AI...</p>
        </div>

        <!-- Khung hiển thị Camera -->
        <div class="relative w-full aspect-[4/3] bg-black rounded-xl overflow-hidden border-4 border-slate-700 shadow-2xl flex items-center justify-center">
            <video id="video" autoplay muted playsinline class="w-full h-full object-cover"></video>

            <div id="loading-overlay" class="absolute inset-0 bg-slate-900/80 flex flex-col items-center justify-center space-y-3">
                <div class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                <p class="text-slate-300 font-medium">Đang nạp CSDL khuôn mặt...</p>
            </div>

            <div class="absolute w-64 h-64 border-2 border-dashed border-blue-400/50 rounded-full pointer-events-none"></div>
        </div>

        <!-- Thông báo kết quả -->
        <div id="result-box" class="hidden p-3 rounded-xl font-bold text-base transition-all duration-300"></div>

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

        let faceMatcher = null;
        let detectedEmployee = null; // Lưu nhân viên vừa nhận diện được
        let isProcessing = false;

        async function initSystem() {
            try {
                if (typeof faceapi === 'undefined') {
                    statusText.innerText = "❌ Lỗi: Chưa nạp được thư viện face-api.js!";
                    return;
                }

                const MODEL_URL = 'https://cdn.jsdelivr.net/npm/@vladmandic/face-api@1.7.12/model';
                await faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL);
                await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
                await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);

                const res = await fetch("{{ route('chamcong.facedata') }}");
                const employees = await res.json();

                if (employees.length === 0) {
                    statusText.innerText = "⚠️ Chưa có dữ liệu nhân viên nào đăng ký FaceID!";
                    loadingOverlay.classList.add('hidden');
                    return;
                }

                const labeledDescriptors = employees.map(emp => {
                    const vectorArray = typeof emp.face_vector === 'string' 
                        ? JSON.parse(emp.face_vector) 
                        : emp.face_vector;

                    return new faceapi.LabeledFaceDescriptors(
                        `${emp.ma_nhan_vien}|${emp.ho_ten}`,
                        [new Float32Array(vectorArray)]
                    );
                });

                faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.45);
                startCamera();
            } catch (err) {
                statusText.innerText = "❌ Lỗi hệ thống: Không thể khởi tạo AI!";
                console.error(err);
            }
        }

        function startCamera() {
            navigator.mediaDevices.getUserMedia({ video: { width: 640, height: 480 } })
                .then(stream => {
                    video.srcObject = stream;
                    loadingOverlay.classList.add('hidden');
                    statusText.innerText = "👀 Hãy đứng trước màn hình để hệ thống nhận diện...";
                })
                .catch(() => {
                    statusText.innerText = "❌ Không thể mở Camera trên trình duyệt!";
                });
        }

        // Quét liên tục mỗi 1 giây để phát hiện người đứng trước camera
        video.addEventListener('play', () => {
            setInterval(async () => {
                if (isProcessing || !faceMatcher) return;

                const detection = await faceapi.detectSingleFace(video)
                    .withFaceLandmarks()
                    .withFaceDescriptor();

                if (detection) {
                    const match = faceMatcher.findBestMatch(detection.descriptor);

                    if (match.label !== 'unknown') {
                        const [maNhanVien, hoTen] = match.label.split('|');
                        detectedEmployee = { ma_nhan_vien: maNhanVien, ho_ten: hoTen };
                        
                        statusText.innerHTML = `🟢 Xin chào: <b class="text-blue-400 font-bold">${hoTen}</b> (${maNhanVien}) - Chọn nút bấm bên dưới:`;
                        toggleButtons(true);
                    } else {
                        resetState("⚠️ Khuôn mặt chưa được đăng ký trong CSDL!");
                    }
                } else {
                    resetState("👀 Hãy đứng trước màn hình để hệ thống nhận diện...");
                }
            }, 1000);
        });

        function resetState(msg) {
            detectedEmployee = null;
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
            
            showResult(`⏳ Đang ghi nhận lượt ${type === 'in' ? 'Check-in' : 'Check-out'}...`, 'bg-blue-600/30 text-blue-300 border border-blue-500');

            fetch("{{ route('chamcong.luu') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ 
                    ma_nhan_vien: detectedEmployee.ma_nhan_vien,
                    loai_cham_cong: type // Truyền loại nút bấm (in/out)
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showResult(`✅ ${data.loai} thành công: ${data.ho_ten} (${data.thoi_gian})`,
                        'bg-emerald-600/30 text-emerald-300 border border-emerald-500');
                } else {
                    showResult(`❌ ${data.message || 'Lỗi chấm công!'}`, 'bg-red-600/30 text-red-300 border border-red-500');
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