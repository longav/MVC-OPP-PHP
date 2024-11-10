<?php

use eftec\bladeone\BladeOne;

// Hàm hiển thị giao diện
function view($viewFile, $data = [])
{
    $viewDir = "./app/Views";
    $storageDir = "./storage";
    $blade = new BladeOne($viewDir, $storageDir, BladeOne::MODE_DEBUG);
    echo $blade->run($viewFile, $data);
}

// Hàm chuyển đường dẫn
function route($url)
{
    return BASE_URL . $url;
}


// Hàm thông báo lỗi và thông báo thành công
// $key <=> success hoặc errors
// $msg <=> câu thông báo lỗi /thành công
function with($key, $msg, $route)
{
    $_SESSION[$key] = $msg;
    switch ($key) {
        case 'success':
            unset($_SESSION['errors']);
            break;
        case 'errors':
            unset($_SESSION['success']);
            break;
    }
    header('location:' . BASE_URL . $route . '?msg=' . $key);
    die;
}
