<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý nhân viên</title>

    <link rel="stylesheet" href="{{ asset('css/nhanvien.css') }}">
</head>
<body>

    <h1>Danh sách nhân viên</h1>

    {{-- Thông báo thành công --}}
    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    {{-- Hiển thị lỗi --}}
    @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {{-- Nút thêm nhân viên --}}
    <p>
        <a href="{{ route('nhanvien.create') }}">
            + Thêm nhân viên
        </a>
    </p>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Mã nhân viên</th>
                    <th>Họ và tên</th>
                    <th>Ngày sinh</th>
                    <th>Quê quán</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Trạng thái</th>
                    <th>Số ngày đã nghỉ</th>
                    <th>Số ngày còn lại</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($nhanViens as $nv)
                    <tr>
                        <td>{{ $nv->ma_nhan_vien }}</td>

                        <td>{{ $nv->ho_ten }}</td>

                        <td>
                            {{ $nv->ngay_sinh
                                ? \Carbon\Carbon::parse($nv->ngay_sinh)->format('d/m/Y')
                                : '' }}
                        </td>

                        <td>{{ $nv->que_quan }}</td>

                        <td>{{ $nv->email }}</td>

                        <td>{{ $nv->so_dien_thoai }}</td>

                        <td>{{ $nv->trang_thai }}</td>

                        <td>{{ $nv->so_ngay_da_nghi }}</td>

                        <td>{{ $nv->so_ngay_con_lai }}</td>

                        <td>
                            <a href="{{ route('nhanvien.edit', $nv->ma_nhan_vien) }}">
                                Sửa
                            </a>

                            <form
                                class="delete-form"
                                action="{{ route('nhanvien.destroy', $nv->ma_nhan_vien) }}"
                                method="POST"
                                style="display: inline"
                                onsubmit="return confirm('Bạn có chắc muốn xóa nhân viên này?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">
                            Chưa có nhân viên nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Phân trang --}}
    {{ $nhanViens->links() }}

</body>
</html>
