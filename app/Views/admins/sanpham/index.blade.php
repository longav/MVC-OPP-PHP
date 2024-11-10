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
            <h1>Danh sách sản phẩm</h1>
        </div>
        <div class="card-body">
            @if (!empty($_SESSION['success']))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $_SESSION['success'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    
     
            <a class="btn btn-primary" href="?url=page-add-sanPham">+ ADD</a>
            <div class="table-responsive">
                <table class="table">
                    <thead>


                        <tr>

                            <th>Số thứ tự</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá sản phẩm</th>
                            <th>Giá khuyến mãi</th>
                            <th>Số lượng</th>
                            <th>Ngày Nhập</th>
                            <th>Danh mục</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $user => $value)
                            <tr>
                                <td scope="row">{{ $user }}</td>
                                <td><img src="public/img/{{ $value['hinh_anh'] }}" class="w-50" alt=""></td>
                                <td>{{ $value['ten_san_pham'] }}</td>
                                <td>{{ $value['gia_san_pham'] }}</td>
                                <td>{{ $value['gia_khuyen_mai'] }}</td>
                                <td>{{ $value['ngay_nhap'] }}</td>
                                <td>{{ $value['so_luong'] }}</td>
                               
                                <td>{{ $value['ten_danh_muc'] }}</td>
                                <td><a class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa không')" href="?url=delete-sanPham/{{ $value['id'] }}">Xóa</a></td>
                                <td><a class="btn btn-warning" href="?url=edit-sanPham/{{ $value['id'] }}">Sửa</a></td>
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
