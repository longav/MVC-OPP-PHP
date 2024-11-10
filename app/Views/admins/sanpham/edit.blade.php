@extends('layouts.admin')

@section('title')
Thêm mới người dùng
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection

@section('content')
<h1>Cập nhập người dùng</h1>
    <form action="?url=Update-SanPham" class="form" enctype="multipart/form-data" method="post">

                    
                <label for="" hidden>Id</label>
                <input type="text" class="form-control" name="id" id="" value="<?=$value['id']?>" hidden >
                <label for="">Ảnh sản phẩm</label>
                
                <img src="<?=BASE_URL."public/img/".$value['hinh_anh']?>" alt="" class="w-25">
                <input type="file" class="form-control" name="anh_san_pham" id=""  placeholder="Nhập tên người dùng"  value="">
                <label for="">Tên sản phẩm</label>
                <input type="text" class="form-control" name="ten_san_pham" id=""  placeholder="Nhập tên người dùng"  value="<?=$value['ten_san_pham']?>">
                <label for="">Giá sản phẩm</label>
                <input type="number" class="form-control" name="gia_san_pham" id=""  placeholder="Nhập password"  value="<?=$value['gia_san_pham']?>">
                <label for="">Giá khuyến mãi</label>
                <input type="number"  class="form-control" name="gia_khuyen_mai" id=""  placeholder="Nhập Email" value="<?=$value['gia_khuyen_mai']?>">
        
                <label for="">Số lượng</label>
                <input type="number" class="form-control" name="so_luong" id="" placeholder="Nhập Số điện thoại" value="<?=$value['so_luong']?>">
                <label for="">Ngày nhập</label>
                <input type="date" class="form-control" name="ngay_nhap" id="" placeholder="Nhập Ngày Sinh" value="<?=$value['ngay_nhap']?>">
                
               
              
        
                <label for="">Tên danh mục</label>
       
         <select name="danh_muc" id="" class="form-select">
            @foreach ($danhMuc as $item)

            <option value="{{$item['id']}}"  <?=  $value['danh_muc_id'] == $item['id'] ? "selected" : "" ?> >{{$item['ten_danh_muc']}}</option>
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
        
                <button class="btn btn-primary " type="submit">Sửa</button>
               </div>
             
    </form>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection