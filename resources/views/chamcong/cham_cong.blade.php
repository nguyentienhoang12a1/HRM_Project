<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Máy Chấm Công FaceID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/face-api.min.js') }}"></script>
</head>

<body class="bg-slate-900 min-h-screen text-white flex flex-col items-center justify-center p-4">

    <div class="w-full max-w-2xl bg-slate-800 rounded-2xl p-6 shadow-2xl border border-slate-700 text-center space-y-6">
        <div>
            <h1 class="text-3xl font-black tracking-wide text-blue-400">CHẤM CÔNG FACEID</h1>
            <p id="status-text" class="text-slate-400 mt-2 font-medium">Đang khởi tạo hệ thống AI...</p>
        </div>

        <div
            class="relative w-full aspect-[4/3] bg-black rounded-xl overflow-hidden border-4 border-slate-700 shadow-2xl flex items-center justify-center">
            <video id="video" autoplay muted class="w-full h-full object-cover"></video>

            <div id="loading-overlay"
                class="absolute inset-0 bg-slate-900/80 flex flex-col items-center justify-center space-y-3">
                <div class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                <p class="text-slate-300 font-medium">Đang nạp CSDL khuôn mặt...</p>
            </div>

            <div class="absolute w-64 h-64 border-2 border-dashed border-blue-400/50 rounded-full pointer-events-none">
            </div>
        </div>

        <div id="result-box" class="hidden p-4 rounded-xl font-bold text-lg transition-all duration-300"></div>
    </div>

    <script>
        const video = document.getElementById('video');
        const statusText = document.getElementById('status-text');
        const loadingOverlay = document.getElementById('loading-overlay');
        const resultBox = document.getElementById('result-box');

        let faceMatcher = null;
        let isProcessing = false;

        // BẮT BUỘC: Hàm này phải có từ khóa async để dùng await bên trong
        async function initSystem() {
            try {
                if (typeof faceapi === 'undefined') {
                    statusText.innerText = "❌ Lỗi: Chưa nạp được thư viện face-api.js!";
                    return;
                }

                // 1. Nạp AI Models từ CDN
                const MODEL_URL = 'https://cdn.jsdelivr.net/npm/@vladmandic/face-api@1.7.12/model';
                await faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL);
                await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
                await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);

                // 2. Lấy danh sách Vector từ Laravel DB
                const res = await fetch('/face-database');
                const employees = await res.json();

                if (employees.length === 0) {
                    statusText.innerText = "⚠️ Chưa có dữ liệu nhân viên nào đăng ký FaceID!";
                    loadingOverlay.classList.add('hidden');
                    return;
                }

                // 3. Chuẩn bị bộ đối sánh
                const labeledDescriptors = employees.map(emp => {
                    return new faceapi.LabeledFaceDescriptors(
                        `${emp.ma_nhan_vien}|${emp.ho_ten}`,
                        [new Float32Array(emp.face_vector)]
                    );
                });

                faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.45);

                // 4. Mở Camera
                startCamera();
            } catch (err) {
                statusText.innerText = "❌ Lỗi hệ thống: Không thể khởi tạo AI hoặc CSDL!";
                console.error(err);
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
                    statusText.innerText = "🟢 Sẵn sàng! Vui lòng đưa khuôn mặt vào khung hình.";
                })
                .catch(() => {
                    statusText.innerText = "❌ Không thể mở Camera trên trình duyệt!";
                });
        }

        // Quét liên tục mỗi 5000ms 
        video.addEventListener('play', () => {
            setInterval(async () => {
                if (isProcessing || !faceMatcher) return;

                const detection = await faceapi.detectSingleFace(video)
                    .withFaceLandmarks()
                    .withFaceDescriptor();

                if (detection) {
                    const match = faceMatcher.findBestMatch(detection.descriptor);

                    if (match.label !== 'unknown') {
                        isProcessing = true;
                        const [maNhanVien, hoTen] = match.label.split('|');

                        showResult(`Đã nhận diện: ${hoTen}`,
                            'bg-blue-600/30 text-blue-300 border border-blue-500');
                        sendCheckin(maNhanVien);
                    } else {
                        showResult("⚠️ Khuôn mặt không khớp CSDL!",
                            'bg-amber-600/30 text-amber-300 border border-amber-500');
                    }
                }
            }, 5000);
        });

        function sendCheckin(maNhanVien) {
            fetch('/luu-cham-cong', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        ma_nhan_vien: maNhanVien
                    })
                })
                .then(res => res.json())
                .then(data => {
                    showResult(`✅ ${data.loai} thành công: ${data.ho_ten} (${data.thoi_gian})`,
                        'bg-emerald-600/30 text-emerald-300 border border-emerald-500');

                    setTimeout(() => {
                        isProcessing = false;
                        resultBox.classList.add('hidden');
                    }, 3000);
                })
                .catch(() => {
                    showResult("❌ Lỗi kết nối khi lưu chấm công!", 'bg-red-600/30 text-red-300 border border-red-500');
                    setTimeout(() => {
                        isProcessing = false;
                    }, 3000);
                });
        }

        function showResult(message, classes) {
            resultBox.className = `p-4 rounded-xl font-bold text-lg transition-all duration-300 ${classes}`;
            resultBox.innerText = message;
            resultBox.classList.remove('hidden');
        }

        // Lắng nghe sự kiện DOMContentLoaded để gọi hàm async initSystem()
        document.addEventListener("DOMContentLoaded", initSystem);
    </script>
</body>

</html>
