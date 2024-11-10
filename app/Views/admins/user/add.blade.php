@extends('layouts.admin')

@section('title')
Thêm mới người dùng
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection

@section('content')
<h1>Thêm mới người dùng</h1>
    <form action="?url=newAdd"class="form" enctype="multipart/form-data" method="post">

                    
                <label for="">Ảnh đại diện</label>
                <input type="file" class="form-control" name="anh_dai_dien" id=""  >
        
                <label for="">Tên người dùng</label>
                <input type="text" class="form-control" name="ten_nguoi_dung" id=""  placeholder="Nhập tên người dùng" >
                <label for="">Mật khẩu</label>
                <input type="password" class="form-control" name="mat_khau" id=""  placeholder="Nhập password" >
                <label for="">Email</label>
                <input type="text"  class="form-control" name="email" id=""  placeholder="Nhập Email">
        
                <label for="">Số điện thoại</label>
                <input type="text" class="form-control" name="so_dien_thoai" id="" value="" placeholder="Nhập Số điện thoại">
                <label for="">Ngày sinh</label>
                <input type="date" class="form-control" name="ngay_sinh" id="" placeholder="Nhập Ngày Sinh">
                <label for="">Địa chỉ</label>
                <input type="text" class="form-control" name="dia_chi" id="" placeholder="Nhập địa chỉ" >
        
                <label for="">Giới Tính :</label>
                <label for="">Nam</label>
                <input type="radio" class="form-radio" name="gioi_tinh" value="1" id="" checked  >
                <label for="">Nữ</label>
                <input type="radio" class="form-radio" name="gioi_tinh" value="2"  >
                <br>
              
        
                <label for="">Tên chức vụ</label>
               
         <select name="chuc_vu" id="" class="form-select">
            @foreach ($value as $user => $value)
            <option value="{{$value['id']}}">{{$value['ten_chuc_vu']}}</option>
            @endforeach
         </select>
         @if (!empty($_SESSION['success']))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $_SESSION['success'] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (!empty($_SESSION['errors']))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $_SESSION['errors'] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
               <div class="mt-5">
                <input type="reset" class="btn btn-info me-3"  id="" placeholder="Nhập lại" >
        
                <button class="btn btn-primary " type="submit">Thêm mới</button>
               </div>
             
    </form>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection