@extends('layouts.admin')

@section('title')
Thêm mới người dùng
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection

@section('content')
<h1>Thêm mới sản phẩm</h1>
    <form action="{{route('newAdd-sanPham')}}"class="form" enctype="multipart/form-data" method="post">

                    
                <label for="">Ảnh sản phẩm</label>
                <input type="file" class="form-control" name="anh_san_pham" id=""  >
        
                <label for="">Tên sản phẩm</label>
                <input type="text" class="form-control" name="ten_san_pham" id=""  placeholder="Nhập tên sản phẩm" >
                <label for="">Giá sản phẩm</label>
                <input type="number" class="form-control" name="gia_san_pham" id=""  placeholder="Nhập giá sản phẩm" >
                <label for="">Giá khuyến mãi</label>
                <input type="number"  class="form-control" name="gia_khuyen_mai" id=""  placeholder="Nhập giá khuyến mãi">
        
                <label for="">Số lượng</label>
                <input type="number" class="form-control" name="so_luong" id="" value="" placeholder="Nhập Số lượng">
                <label for="">Ngày nhập</label>
                <input type="date" class="form-control" name="ngay_nhap" id="" placeholder="Nhập Ngày nhập">
                
                
              
        
                <label for="">Tên danh mục</label>
               
         <select name="danh_muc" id="" class="form-select">
            @foreach ($value as $user => $value)
            <option value="{{$value['id']}}">{{$value['ten_danh_muc']}}</option>
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