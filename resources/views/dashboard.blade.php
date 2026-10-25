
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HRM Portal - Quản trị nhân sự</title>

    <!-- Bootstrap 5 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #f4f6fa;
            font-family: Arial, sans-serif;
            color: #263248;
        }

        .sidebar {
            min-height: 100vh;
            background: #172554;
            color: white;
        }

        .sidebar .nav-link {
            color: #cbd5e1;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: #3156c9;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .stat-card {
            border: none;
            border-radius: 14px;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 23px;
        }

        .content-card {
            border: none;
            border-radius: 14px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #dbeafe;
            color: #1d4ed8;
            font-weight: bold;
        }

        @media (max-width: 767.98px) {
            .sidebar {
                min-height: auto;
            }
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <aside class="col-md-3 col-lg-2 sidebar p-3">
            <h4 class="mb-4 mt-2">
                <i class="bi bi-people-fill me-2"></i>HRM Portal
            </h4>

            <p class="text-uppercase small text-secondary">
                Quản lý chung
            </p>

            <nav class="nav flex-column">
                <a href="/" class="nav-link active">
                    <i class="bi bi-grid"></i> Dashboard
                </a>

                <a href="#" class="nav-link">
                    <i class="bi bi-people"></i> Nhân viên
                </a>

                <a href="#" class="nav-link">
                    <i class="bi bi-building"></i> Phòng ban
                </a>

                <a href="#" class="nav-link">
                    <i class="bi bi-calendar-check"></i> Chấm công
                </a>

                <a href="#" class="nav-link">
                    <i class="bi bi-calendar-minus"></i> Nghỉ phép
                </a>

                <a href="#" class="nav-link">
                    <i class="bi bi-cash-stack"></i> Bảng lương
                </a>

                <a href="#" class="nav-link">
                    <i class="bi bi-gear"></i> Cài đặt
                </a>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="col-md-9 col-lg-10 px-3 px-md-4 py-4">

            <!-- Header -->
            <div class="d-flex justify-content-between
                        align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">
                        Tổng quan nhân sự
                    </h2>
                    <p class="text-secondary mb-0">
                        Chào mừng bạn đến với hệ thống HRM.
                    </p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-light border"
                            aria-label="Thông báo">
                        <i class="bi bi-bell"></i>
                    </button>

                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar">AD</div>
                        <div class="d-none d-sm-block">
                            <div class="fw-semibold">Admin</div>
                            <small class="text-secondary">
                                Quản trị viên
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="row g-3 mb-4">

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card shadow-sm h-100">
                        <div class="card-body d-flex
                                    justify-content-between">
                            <div>
                                <p class="text-secondary mb-2">
                                    Tổng nhân viên
                                </p>
                                <h3 class="fw-bold">128</h3>
                                <small class="text-success">
                                    <i class="bi bi-arrow-up"></i>
                                    8 nhân viên mới
                                </small>
                            </div>
                            <div class="stat-icon bg-primary-subtle
                                        text-primary">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card shadow-sm h-100">
                        <div class="card-body d-flex
                                    justify-content-between">
                            <div>
                                <p class="text-secondary mb-2">
                                    Đang làm việc
                                </p>
                                <h3 class="fw-bold">120</h3>
                                <small class="text-success">
                                    Đang hoạt động
                                </small>
                            </div>
                            <div class="stat-icon bg-success-subtle
                                        text-success">
                                <i class="bi bi-person-check"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card shadow-sm h-100">
                        <div class="card-body d-flex
                                    justify-content-between">
                            <div>
                                <p class="text-secondary mb-2">
                                    Đơn nghỉ phép
                                </p>
                                <h3 class="fw-bold">06</h3>
                                <small class="text-warning">
                                    Chờ phê duyệt
                                </small>
                            </div>
                            <div class="stat-icon bg-warning-subtle
                                        text-warning">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card shadow-sm h-100">
                        <div class="card-body d-flex
                                    justify-content-between">
                            <div>
                                <p class="text-secondary mb-2">
                                    Phòng ban
                                </p>
                                <h3 class="fw-bold">08</h3>
                                <small class="text-primary">
                                    Toàn doanh nghiệp
                                </small>
                            </div>
                            <div class="stat-icon bg-info-subtle
                                        text-info">
                                <i class="bi bi-building"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Employee table -->
            <div class="card content-card shadow-sm">
                <div class="card-header bg-white border-0
                            p-3 p-md-4">
                    <div class="d-flex flex-wrap
                                justify-content-between
                                align-items-center gap-2">
                        <div>
                            <h5 class="fw-bold mb-1">
                                Danh sách nhân viên
                            </h5>
                            <p class="text-secondary mb-0 small">
                                Thông tin nhân viên gần đây
                            </p>
                        </div>

                        <button class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i>
                            Thêm nhân viên
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Nhân viên</th>
                                <th>Mã nhân viên</th>
                                <th>Phòng ban</th>
                                <th>Chức vụ</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex
                                                align-items-center gap-2">
                                        <div class="avatar">NA</div>
                                        <div>
                                            <div class="fw-semibold">
                                                Nguyễn Minh Anh
                                            </div>
                                            <small class="text-secondary">
                                                anh@example.com
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>NV001</td>
                                <td>Công nghệ thông tin</td>
                                <td>Developer</td>
                                <td>
                                    <span class="badge text-bg-success">
                                        Đang làm
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex
                                                align-items-center gap-2">
                                        <div class="avatar">TL</div>
                                        <div>
                                            <div class="fw-semibold">
                                                Trần Thu Linh
                                            </div>
                                            <small class="text-secondary">
                                                linh@example.com
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>NV002</td>
                                <td>Nhân sự</td>
                                <td>HR Specialist</td>
                                <td>
                                    <span class="badge text-bg-success">
                                        Đang làm
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex
                                                align-items-center gap-2">
                                        <div class="avatar">PQ</div>
                                        <div>
                                            <div class="fw-semibold">
                                                Phạm Quốc Bảo
                                            </div>
                                            <small class="text-secondary">
                                                bao@example.com
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>NV003</td>
                                <td>Kế toán</td>
                                <td>Accountant</td>
                                <td>
                                    <span class="badge text-bg-warning">
                                        Thử việc
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <footer class="text-center text-secondary
                           small mt-4">
                HRM Portal &copy; 2026 - Hệ thống quản trị nhân sự
            </footer>

        </main>
    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
</body>
</html>
