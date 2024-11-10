<?php

namespace App\Controllers;


use App\Models\DanhMuc;
use App\Models\SanPham;

use DateTime;

class SanPhamController
{

      private $SanPham;
      private $DanhMuc;
      public function __construct()
      {
            $this->SanPham = new SanPham();
            $this->DanhMuc = new DanhMuc();
      }
      public function index()
      {
            $list = $this->SanPham->getAll();
            // var_dump($list);

            return view('admins.sanpham.index', compact('list'));
      }
      public function delete($id)
      {
            $value =  $this->SanPham->getOne($id);
            $this->SanPham->Delete($id);
            $imgPath =  'public/img/' . $value['hinh_anh'];
            unlink($imgPath);
            with('success', "Xóa thành công", 'list-sanPham');
      }

      public function edit($id)
      {
            $danhMuc = $this->DanhMuc->getAll();
            $value = $this->SanPham->getOne($id);

            return view('admins.sanpham.edit', compact('value', 'danhMuc'));
      }
      public function add_view()
      {
            $value = $this->DanhMuc->getAll();
            return view('admins.sanpham.add', compact('value'));
      }
      public function push()
      {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                  $anh_dai_dien = basename($_FILES['anh_san_pham']['name']);
                  $ten_san_pham = $_POST['ten_san_pham'];
                  $gia_san_pham = $_POST['gia_san_pham'];
                  $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
                  $so_luong = $_POST['so_luong'];

                  $ngay_nhap = $_POST['ngay_nhap'];
                  $danh_muc = $_POST['danh_muc'];
                  $dateNow = new DateTime();

                  $imgPath =  'public/img/' . $anh_dai_dien;
                  if (
                        $anh_dai_dien == "" &&
                        $ten_san_pham == "" &&
                        $gia_san_pham == "" &&
                        $gia_khuyen_mai == "" &&
                        $so_luong == "" &&
                        $ngay_nhap == ""

                  ) {
                        with('errors', "Tất cả các trường không được để trống", 'page-add-sanPham');
                  } else if (

                        $anh_dai_dien == "" ||
                        $ten_san_pham == "" ||
                        $gia_san_pham == "" ||
                        $gia_khuyen_mai == "" ||
                        $so_luong == "" ||
                        $ngay_nhap == ""

                  ) {
                        $anh_dai_dien == "" ? with('errors', "Ảnh sản phẩm không được để trống", 'page-add-sanPham') : "";
                        $ten_san_pham == "" ? with('errors', "Tên sản phẩm không được để trống", 'page-add-sanPham') : "";
                        $gia_san_pham == "" ? with('errors', "Giá  không được để trống", 'page-add-sanPham') : "";
                        $gia_khuyen_mai == "" ? with('errors', "Giá khuyến mãi không được để trống", 'page-add-sanPham') : "";
                        $so_luong == "" ? with('errors', "Số lượng không được để trống", 'page-add-sanPham') : "";
                        $ngay_nhap == "" ? with('errors', "Ngày nhập không được để trống", 'page-add-sanPham') : "";
                  } else {

                        // Kiểm tra mật khẩu
                        if ($gia_san_pham < $gia_khuyen_mai) {

                              with('errors', "Giá khuyến mãi không được lớn hơn giá sản phẩm", 'page-add-sanPham');
                        }
                        // Kiểm tra ngày sinh
                        if ($dateNow <= $ngay_nhap) {
                              with('errors', "Ngày nhập không được lớn hơn ngày hiện tại", 'page-add-sanPham');
                        }
                        if ($so_luong < 0) {
                              with('errors', "Số Lượng phải lớn hơn 0!", 'page-add-sanPham');
                        }




                        $data = [
                              'hinh_anh' => $anh_dai_dien,
                              'ten_san_pham' => $ten_san_pham,
                              'gia_san_pham' => $gia_san_pham,
                              'gia_khuyen_mai' => $gia_khuyen_mai,
                              'so_luong' => $so_luong,
                              'ngay_nhap' => $ngay_nhap,
                              'danh_muc_id' => $danh_muc,

                              'trang_thai' => 1,

                        ];

                        if (move_uploaded_file($_FILES['anh_san_pham']['tmp_name'], $imgPath)) {

                              $this->SanPham->add($data);
                              with('success', "Thêm mới thành công", 'list-sanPham');
                              // header("location:'?url=list-user");
                        }



                        // $regex_phone = '/(84|0[3|5|7|8|9])+([0-9]{8})\b/';
                        // $regexEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";


                        // if (preg_match($regexEmail, $email) === 1) {

                        //       return $checkEmail = true;

                        // }else{

                        //       return $checkEmail = false;

                        // }
                        // if (preg_match($regex_phone, $so_dien_thoai) === 1) {

                        //       return $checkPhone = true;
                        // }else{

                        //       return $checkPhone = false;
                        // }
                        // if ($checkEmail == false) {
                        //       echo "Email không hợp lệ!";
                        //       // Redirect hoặc thông báo lỗi tuỳ vào ứng dụng của bạn
                        //       exit; // Dừng thực thi nếu muốn
                        //       //  with('errors', "Email không hợp lệ", 'page-add');
                        // }
                        // if ($checkPhone == false) {
                        //       echo "Số điện thoại không hợp lệ!";
                        //       exit;
                        //       //with('errors', "Số điện thoại không hợp lệ", 'page-add');
                        // }





                        // $data = [
                        //       'anh_dai_dien' => $anh_dai_dien,
                        //       'ho_ten' => $ho_ten,
                        //       'email' => $email,
                        //       'ngay_sinh' => $ngay_sinh,
                        //       'so_dien_thoai' => $so_dien_thoai,
                        //       'dia_chi' => $dia_chi,
                        //       'gioi_tinh' => $gioi_tinh,
                        //       'mat_khau' => $mat_khau,
                        //       'chuc_vu_id' => $chuc_vu_id,
                        //       'trang_thai' => 1,

                        // ];
                        // if ($checkEmail && $checkPhone) {
                        //       if (move_uploaded_file($_FILES['anh_dai_dien']['tmp_name'], $imgPath)) {
                        //             $this->user->add($data);

                        //             // header("location:'?url=list-user");
                        //       }
                        //       with('success', "Thêm mới thành công", 'list-user');
                        // }
                  }
            }
      }

      public function update()
      {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  $id = $_POST['id'];
                  $anh_dai_dien = basename($_FILES['anh_san_pham']['name']);
                  $ten_san_pham = $_POST['ten_san_pham'];
                  $gia_san_pham = $_POST['gia_san_pham'];
                  $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
                  $so_luong = $_POST['so_luong'];

                  $ngay_nhap = $_POST['ngay_nhap'];
                  $danh_muc = $_POST['danh_muc'];
                  $dateNow = new DateTime();

                  $imgPath =  'public/img/' . $anh_dai_dien;
                  if (
                      
                        $ten_san_pham == "" &&
                        $gia_san_pham == "" &&
                        $gia_khuyen_mai == "" &&
                        $so_luong == "" &&
                        $ngay_nhap == ""

                  ) {
                        with('errors', "Tất cả các trường không được để trống", 'page-add-sanPham');
                  } else if (

                       
                        $ten_san_pham == "" ||
                        $gia_san_pham == "" ||
                        $gia_khuyen_mai == "" ||
                        $so_luong == "" ||
                        $ngay_nhap == ""

                  ) {

                        $ten_san_pham == "" ? with('errors', "Tên sản phẩm không được để trống", 'edit-sanPham/' . $id) : "";
                        $gia_san_pham == "" ? with('errors', "Giá  không được để trống", 'edit-sanPham/' . $id) : "";
                        $gia_khuyen_mai == "" ? with('errors', "Giá khuyến mãi không được để trống", 'edit-sanPham/' . $id) : "";
                        $so_luong == "" ? with('errors', "Số lượng không được để trống", 'edit-sanPham/' . $id) : "";
                        $ngay_nhap == "" ? with('errors', "Ngày nhập không được để trống", 'edit-sanPham/' . $id) : "";
                  } else {
                        echo "hi";
                      
                        // Kiểm tra mật khẩu
                        if ($gia_san_pham < $gia_khuyen_mai) {

                              with('errors', "Giá khuyến mãi không được lớn hơn giá sản phẩm", 'page-add-sanPham');
                        }
                        // Kiểm tra ngày sinh
                        if ($dateNow <= $ngay_nhap) {
                              with('errors', "Ngày nhập không được lớn hơn ngày hiện tại", 'page-add-sanPham');
                        }
                        if ($so_luong < 0) {
                              with('errors', "Số Lượng phải lớn hơn 0!", 'page-add-sanPham');
                        }




                        $data = [

                              'ten_san_pham' => $ten_san_pham,
                              'gia_san_pham' => $gia_san_pham,
                              'gia_khuyen_mai' => $gia_khuyen_mai,
                              'so_luong' => $so_luong,
                              'ngay_nhap' => $ngay_nhap,
                              'danh_muc_id' => $danh_muc,
                              'trang_thai' => 1,

                        ];

                        if (!empty($anh_dai_dien)) {
                              $data['hinh_anh'] = $anh_dai_dien;
                        } else {
                              // Nếu $anh_dai_dien rỗng thì xóa phần tử 'anh_dai_dien' khỏi mảng $data nếu nó tồn tại
                              unset($data['hinh_anh']);
                        }

                        if (move_uploaded_file($_FILES['anh_san_pham']['tmp_name'], $imgPath)) {
                        }

                     $this->SanPham->update($data, $id);
                  
                        header("location:?url=list-sanPham");
                  }
            }
      }
}
