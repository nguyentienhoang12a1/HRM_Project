<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa nhân viên</title>

    <link rel="stylesheet" href="{{ asset('css/nhanvien.css') }}">
</head>
<body>
    <h1>Sửa thông tin nhân viên</h1>

    @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('nhanvien.update', $nhanVien->ma_nhan_vien) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Mã nhân viên:</label>
            <input value="{{ $nhanVien->ma_nhan_vien }}" disabled>
        </p>

        <p>
            <label>Họ và tên:</label>
            <input name="ho_ten" value="{{ old('ho_ten', $nhanVien->ho_ten) }}" required>
        </p>

        <p>
            <label>Ngày sinh:</label>
            <input type="date" name="ngay_sinh" value="{{ old('ngay_sinh', $nhanVien->ngay_sinh?->format('Y-m-d')) }}">
        </p>

        <p>
            <label>Quê quán:</label>
            <input name="que_quan" value="{{ old('que_quan', $nhanVien->que_quan) }}">
        </p>

        <p>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $nhanVien->email) }}" required>
        </p>

        <p>
            <label>Số điện thoại:</label>
            <input name="so_dien_thoai"  value="{{ old('so_dien_thoai', $nhanVien->so_dien_thoai) }}">
        </p>

        <p>
            <label>Trạng thái:</label>
            <select name="trang_thai" required>
                <option value="Đang làm" @selected(old('trang_thai', $nhanVien->trang_thai) == 'Đang làm')>Đang làm</option>
                <option value="Nghỉ" @selected(old('trang_thai', $nhanVien->trang_thai) == 'Nghỉ')>Nghỉ</option>
                <option value="Thử việc" @selected(old('trang_thai', $nhanVien->trang_thai) == 'Thử việc')>Thử việc</option>
            </select>
        </p>

        <p>
            <label>Số ngày đã nghỉ:</label>
            <input type="number" name="so_ngay_da_nghi"
                value="{{ old('so_ngay_da_nghi', $nhanVien->so_ngay_da_nghi) }}"
                min="0" required>
        </p>

        <p>
            <label>Số ngày còn lại:</label>
            <input type="number" name="so_ngay_con_lai"
                value="{{ old('so_ngay_con_lai', $nhanVien->so_ngay_con_lai) }}"
                min="0" required>
        </p>

        <button type="submit">Cập nhật</button>
        <a href="{{ route('nhanvien.index') }}">Quay lại</a>
    </form>
</body>
</html>
