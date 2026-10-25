
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
        }

        header {
            background: #2563eb;
            color: white;
            padding: 20px 40px;
        }

        main {
            max-width: 1000px;
            margin: 60px auto;
            padding: 40px 20px;
            text-align: center;
        }

        .welcome {
            background: white;
            padding: 50px 24px;
            border-radius: 16px;
            box-shadow: 0 4px 16px #00000010;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 16px;
        }

        p {
            line-height: 1.7;
            color: #6b7280;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        footer {
            text-align: center;
            padding: 24px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <header>
        <strong>Website của tôi</strong>
    </header>

    <main>
        <section class="welcome">
            <h1>Chào mừng bạn!</h1>
            <p>
                Đây là trang đầu tiên của tôi được xây dựng
                bằng Laravel.
            </p>

            <a href="#gioi-thieu" class="btn">
                Khám phá ngay
            </a>
        </section>

        <section id="gioi-thieu">
            <h2>Giới thiệu</h2>
            <p>
                Tôi đang xây dựng website bằng Laravel
                và sẽ phát triển thêm các tính năng tại đây.
            </p>
        </section>
    </main>

    <footer>
        © 2026 Website của tôi
    </footer>
</body>
</html>
