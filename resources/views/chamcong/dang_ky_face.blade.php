<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng ký FaceID - {{ $nhanVien->ho_ten }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Dùng bản JS đã fix lỗi tensor shape -->
    <script src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api@1.7.12/dist/face-api.js"></script>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 text-center space-y-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Đăng Ký FaceID</h1>
            <p class="text-slate-500 mt-1">Nhân viên: <span
                    class="font-semibold text-blue-600">{{ $nhanVien->ho_ten }}</span> ({{ $nhanVien->ma_nhan_vien }})
            </p>
        </div>

        <div
            class="relative w-full aspect-[4/3] bg-black rounded-xl overflow-hidden flex items-center justify-center border-2 border-slate-200 shadow-inner">
            <video id="video" autoplay muted class="w-full h-full object-cover"></video>
            <div id="overlay-status"
                class="absolute inset-0 bg-black/60 flex items-center justify-center text-white font-medium p-4 text-center">
                Đang kiểm tra thư viện AI...
            </div>
        </div>

        <p id="status-text" class="text-sm font-medium text-slate-600 h-6">Vui lòng chờ...</p>

        <button id="btn-capture" disabled onclick="captureAndSave()"
            class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-300 text-white font-semibold rounded-xl transition duration-200 shadow-lg shadow-emerald-600/30">
            Chụp & Lưu Khuôn Mặt
        </button>
    </div>

    <script>
        const maNhanVien = "{{ $nhanVien->ma_nhan_vien }}";
        const video = document.getElementById('video');
        const overlayStatus = document.getElementById('overlay-status');
        const statusText = document.getElementById('status-text');
        const btnCapture = document.getElementById('btn-capture');

        async function initSystem() {
            try {
                if (typeof faceapi === 'undefined') {
                    overlayStatus.innerText = "❌ Lỗi: Chưa nạp được thư viện face-api!";
                    return;
                }

                overlayStatus.innerText = "Đang nạp AI Models...";
                statusText.innerText = "Đang nạp mô hình nhận diện...";

                // Nạp trực tiếp bộ weights chuẩn từ CDN JsDelivr
                const MODEL_URL = 'https://cdn.jsdelivr.net/npm/@vladmandic/face-api@1.7.12/model';

                await faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL);
                await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
                await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);

                startCamera();
            } catch (error) {
                overlayStatus.innerText = "❌ Lỗi nạp Model!";
                statusText.innerText = error.message || error;
                console.error(error);
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
                    overlayStatus.classList.add('hidden');
                    statusText.innerText = "Hãy nhìn thẳng vào camera và bấm nút đăng ký";
                    btnCapture.disabled = false;
                })
                .catch(() => {
                    overlayStatus.innerText = "Không thể mở Camera!";
                    statusText.innerText = "Hãy cấp quyền truy cập Camera trên trình duyệt.";
                });
        }

        async function captureAndSave() {
            btnCapture.disabled = true;
            statusText.innerText = "Đang phân tích khuôn mặt...";

            const detection = await faceapi.detectSingleFace(video)
                .withFaceLandmarks()
                .withFaceDescriptor();

            if (!detection) {
                statusText.innerText = "❌ Không tìm thấy khuôn mặt! Vui lòng thử lại.";
                btnCapture.disabled = false;
                return;
            }

            const faceVector = Array.from(detection.descriptor);

            fetch(`/nhan-vien/${maNhanVien}/update-face-vector`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        face_vector: faceVector
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        statusText.className = "text-sm font-bold text-emerald-600";
                        statusText.innerText = "🎉 Đăng ký FaceID thành công!";
                        alert("Đã lưu dữ liệu khuôn mặt thành công!");
                    } else {
                        statusText.innerText = "❌ Có lỗi xảy ra khi lưu dữ liệu.";
                        btnCapture.disabled = false;
                    }
                })
                .catch(() => {
                    statusText.innerText = "❌ Lỗi kết nối Server!";
                    btnCapture.disabled = false;
                });
        }

        document.addEventListener("DOMContentLoaded", initSystem);
    </script>
</body>

</html>
