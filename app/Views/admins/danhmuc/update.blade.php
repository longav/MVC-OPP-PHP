@extends('layouts.admin')

@section('title')
    Thêm mới chức vụ
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection

@section('content')
    <h1>TSửa danh mục</h1>
    @if (!empty($_SESSION['success']))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $_SESSION['success'] }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (!empty($_SESSION['errors']))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $_SESSION['errors'] }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="?url=update-danhMuc"class="form" enctype="multipart/form-data" method="post">

        <label for="">Id danh mục</label>
        <input type="text" hidden class="form-control" name="id" id="" value="<?=$value['id']?>">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control" name="danh_muc" id="" value="<?=$value['ten_danh_muc']?>">


        <div class="mt-5">
            <input type="reset" class="btn btn-info me-3" id="" placeholder="Nhập lại">

            <button class="btn btn-primary " type="submit">Cập nhập</button>
        </div>
    </form>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endsection