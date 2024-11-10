<?php

use App\Controllers\ChucVuController;

use App\Controllers\DanhMucController;
use App\Controllers\SanPhamController;
use App\Controllers\UserController;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;


$url = isset($_GET['url']) ?  $_GET['url'] : "/";
$router = new RouteCollector();

// filter check đăng nhập
$router->filter('auth', function () {
    if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
        header('location: ' . BASE_URL . 'login');
        die;
        //   return view('admin.user.login');
    }
    });
    $router->get('logout', [UserController::class, 'logout']);
    $router->get('login', [UserController::class, 'login']);
    $router->post('auth', [UserController::class, 'auth']);
    $router->group(['before' => 'auth'], function () use ($router) {
    $router->get('/', [UserController::class, 'index']);

    // Route Quản lý khách hàng
    $router->get('list-user', [UserController::class, 'index']);

    $router->get('delete/{id}', [UserController::class, 'delete']);
    $router->get('edit/{id}', [UserController::class, 'edit']);

    $router->post('Update-User', [UserController::class, 'update']);
    $router->get('page-add', [UserController::class, 'add_view']);
    $router->post('newAdd', [UserController::class, 'push']);
    // Route Quản lý chức vụ
    $router->post('search-chucVu', [ChucVuController::class, 'search']);
    $router->post('update-chucVu', [ChucVuController::class, 'update']);
    $router->get('edit-chucVu/{id}', [ChucVuController::class, 'edit']);
    $router->get('delete-chucVu/{id}', [ChucVuController::class, 'delete']);
    $router->get('list-chucVu', [ChucVuController::class, 'index']);
    $router->get('add-chucVu-page', [ChucVuController::class, 'add_view']);
    $router->post('addNew-chucVu', [ChucVuController::class, 'push']);

    // Route Quản lý sản phẩm
    $router->get('list-sanPham', [SanPhamController::class, 'index']);
    $router->get('page-add-sanPham', [SanPhamController::class, 'add_view']);
    $router->get('delete-sanPham/{id}', [SanPhamController::class, 'delete']);
    $router->get('edit-sanPham/{id}', [SanPhamController::class, 'edit']);
    $router->post('newAdd-sanPham', [SanPhamController::class, 'push']);
    $router->post('Update-SanPham', [SanPhamController::class, 'update']);
    // Route Quản lý danh mục
    $router->get('list-danhMuc', [DanhMucController::class, 'index']);
    $router->get('add-danhMuc-page', [DanhMucController::class, 'add_view']);
    $router->post('addNew-danhMuc', [DanhMucController::class, 'push']);
    $router->get('edit-danhMuc/{id}', [DanhMucController::class, 'edit']);
    $router->post('update-danhMuc', [DanhMucController::class, 'update']);
    $router->get('delete-danhMuc/{id}', [DanhMucController::class, 'delete']);
    $router->post('search-danhMuc', [DanhMucController::class, 'search']);
});


// Route cho trang đăng nhập
// $router->get('login', function() {
//     // Nội dung trang đăng nhập
//     echo 'Login page';
// });
// if(empty($_SESSION['user'])){
//    header("location:?url=login");
// }

// khu vực cần quan tâm -----------
// Khu vực định nghĩa các đường dẫn 
// Cách định nghĩa ra 1 route
// GET, POST
// $router-> phương thức http ('tên route', {hàm thực hiện công việc})

// $router -> get('/', [UserController::class, 'index']);


// $router->get('he', [CustomerController::class, 'helllo']);
// khu vực cần quan tâm -----------

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// Print out the value returned from the dispatched function
echo $response;
