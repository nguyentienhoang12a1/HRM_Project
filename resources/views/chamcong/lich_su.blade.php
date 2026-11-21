<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử chấm công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Lịch sử chấm công</h4>
        <a href="{{ route('chamcong.index') }}" class="btn btn-secondary btn-sm">Quay lại máy chấm công</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Mã NV</th>
                        <th>Họ và tên</th>
                        <th>Thời gian vào</th>
                        <th>Thời gian ra</th>
                        <th>Thời gian làm</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lichSu as $index => $item)
                        <tr>
                            <td>{{ $lichSu->firstItem() + $index }}</td>
                            <td>{{ $item->ma_nhan_vien }}</td>
                            <td>{{ $item->ho_ten }}</td>
                            <td>{{ $item->thoi_gian_vao ?? '-' }}</td>
                            <td>{{ $item->thoi_gian_ra ?? '-' }}</td>
                            <td>{{ $item->thoi_luong ?? '-' }}</td>
                            <td>{{ $item->trang_thai ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Chưa có dữ liệu chấm công.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $lichSu->links() }}
    </div>
</div>
</body>
</html>