<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Mã xác thực OTP</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div style="max-width: 500px; margin: 0 auto; background: #ffffff; padding: 25px; border-radius: 8px; border: 1px solid #dee2e6;">
        <h3 style="color: #0d6efd; margin-top: 0;">Xin chào {{ $employeeName }},</h3>
        <p>Bạn vừa thực hiện đăng nhập vào Hệ thống Quản lý Nhân sự (HRM). Mã xác thực OTP của bạn là:</p>
        <div style="font-size: 30px; font-weight: bold; color: #198754; letter-spacing: 8px; text-align: center; padding: 15px; background: #e8f5e9; border-radius: 6px; margin: 20px 0;">
            {{ $otpCode }}
        </div>
        <p><strong>Thời gian hiệu lực:</strong> 5 phút kể từ thời điểm tạo.</p>
        <p style="color: #dc3545; font-weight: bold; font-size: 13px;">
            Cảnh báo bảo mật: Tuyệt đối không chia sẻ mã OTP này cho người khác.
        </p>
    </div>
</body>
</html>