@extends('layouts.admin')

@section('title')
Thêm mới người dùng
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection

@section('content')
<h1>Cập nhập người dùng</h1>
    <form action="?url=Update-User"class="form" enctype="multipart/form-data" method="post">

                    
                <label for="" hidden>Id</label>
                <input type="text" class="form-control" name="id" id="" value="<?=$value['id']?>" hidden >
                <label for="">Ảnh đại diện</label>
                
                <img src="<?=BASE_URL."public/img/".$value['anh_dai_dien']?>" alt="" class="w-25">
                <input type="file" class="form-control" name="anh_dai_dien" id=""  placeholder="Nhập tên người dùng"  value="">
                <label for="">Tên người dùng</label>
                <input type="text" class="form-control" name="ten_nguoi_dung" id=""  placeholder="Nhập tên người dùng"  value="<?=$value['ho_ten']?>">
                <label for="">Mật khẩu</label>
                <input type="password" class="form-control" name="mat_khau" id=""  placeholder="Nhập password"  value="<?=$value['mat_khau']?>">
                <label for="">Email</label>
                <input type="text"  class="form-control" name="email" id=""  placeholder="Nhập Email" value="<?=$value['email']?>">
        
                <label for="">Số điện thoại</label>
                <input type="text" class="form-control" name="so_dien_thoai" id="" placeholder="Nhập Số điện thoại" value="<?=$value['so_dien_thoai']?>">
                <label for="">Ngày sinh</label>
                <input type="date" class="form-control" name="ngay_sinh" id="" placeholder="Nhập Ngày Sinh" value="<?=$value['ngay_sinh']?>">
                <label for="">Địa chỉ</label>
                <input type="text" class="form-control" name="dia_chi" id="" placeholder="Nhập địa chỉ" value="<?=$value['dia_chi']?>" >
        
                <label for="">Giới Tính :</label>
                <label for="">Nam</label>
                <input type="radio" class="form-radio" name="gioi_tinh" value="1" <?=$value['gioi_tinh'] !== 2?"checked" :""?> id=""  >
                
                <label for="">Nữ</label>
                <input type="radio" class="form-radio" name="gioi_tinh" value="2"   <?=$value['gioi_tinh'] !== 1?"checked" :""?> id=""   >
                <br>
              
        
                <label for="">Tên chức vụ</label>
       
         <select name="chuc_vu" id="" class="form-select">
            @foreach ($chucVu as $item)

            <option value="{{$item['id']}}"  <?=  $value['chuc_vu_id'] == $item['id'] ? "selected" : "" ?> >{{$item['ten_chuc_vu']}}</option>
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