<!-- {Kế thừa bộ khung} -->
@extends('layouts.admin')

@section('title')
    Đăng nhập
@endsection

@section('css')
@endsection

@section('content')
    <div class="card">


        <div class="card-header">
            <h3>Đăng nhập</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('auth') }}" method="POST">
            <div class="mb-3">
                @if (!empty($_SESSION['errors']))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $_SESSION['errors'] }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" placeholder="Nhập email" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Nhập password"  id="exampleInputPassword1" name="pass">
            </div>
    
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
 
@endsection

@section('js')
@endsection
