<!-- {Kế thừa bộ khung} -->
@extends('layouts.admin')

@section('title')
    Danh sách khách hàng
@endsection

@section('css')
@endsection

@section('content')
    <div class="card container">
       
        <div class="card-header">
            <h1>Danh sách khách hàng</h1>
        </div>
        <div class="card-body">
            @if (!empty($_SESSION['success']))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $_SESSION['success'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    
     
            <a class="btn btn-primary" href="?url=page-add">+ ADD</a>
            <div class="table-responsive">
                <table class="table">
                    <thead>


                        <tr>

                            <th>Số thứ tự</th>
                            <th>Ảnh đại diện</th>
                            <th>Tên người dùng</th>
                            <th>Email</th>
                            <th>Ngày sinh</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Giới Tính</th>
                            <th>Trạng thái</th>
                            <th>Tên chức vụ</th>
                            <th>Điều khiển</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $user => $value)
                            <tr>
                                <td scope="row">{{ $user }}</td>
                                <td><img src="public/img/{{ $value['anh_dai_dien'] }}" class="w-50" alt=""></td>
                                <td>{{ $value['ho_ten'] }}</td>
                                <td>{{ $value['email'] }}</td>
                                <td>{{ $value['ngay_sinh'] }}</td>

                                <td>{{ $value['so_dien_thoai'] }}</td>
                                <td colspan="2">{{ $value['dia_chi'] }}</td>
                                <td>{{ $value['gioi_tinh'] == 1 ? 'Nam' : 'Nữ' }}</td>
                                <td>{{ $value['trang_thai'] == 1 ? 'Hoạt động' : 'Ngưng Hoạt Động' }}</td>
                                <td>{{ $value['ten_chuc_vu'] }}</td>
                                <td><a class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa không')" href="?url=delete/{{ $value['id'] }}">Xóa</a></td>
                                <td><a class="btn btn-warning" href="?url=edit/{{ $value['id'] }}">Sửa</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
