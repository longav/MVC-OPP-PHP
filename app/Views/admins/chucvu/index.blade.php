<!-- {Kế thừa bộ khung} -->
@extends('layouts.admin')

@section('title')
    Danh sách Chức Vụ
@endsection

@section('css')
@endsection

@section('content')
    <div class="card container">
      
        <div class="card-header">
            <h1> Danh sách Chức Vụ</h1>
        </div>
        <table class="table">  
            
        <div class="card-body">
            @if (!empty($_SESSION['success']))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $_SESSION['success'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (!empty($_SESSION['errors']))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $_SESSION['success'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
   <div class="d-flex justify-content-between">
    <div class="">
        <a class="btn btn-primary" href="{{route('add-chucVu-page')}}">+ ADD</a>
    </div>
   
    <div class="d-flex ">
        <form class="" role="search" action="{{route('search-chucVu')}}" method="POST">
            <input class="form-control me-2 w-75 bg-dark-subtle" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
   </div>
            <div class="table-responsive">
           
         
              
                    <thead>


                        <tr>

                            <th>Số thứ tự</th>
                            <th>Tên chức vụ</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $user => $value)
                            <tr>
                                <td scope="row">{{ $user }}</td>
                                <td>{{$value['ten_chuc_vu']}}</td>
                               <td> <a class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa không')" href="?url=delete-chucVu/{{ $value['id'] }}">Xóa</a></td>
                                <td><a class="btn btn-warning" href="?url=edit-chucVu/{{ $value['id'] }}">Sửa</a></td>
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
