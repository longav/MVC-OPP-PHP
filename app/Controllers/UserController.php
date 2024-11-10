<?php

namespace App\Controllers;

use App\Models\ChucVu;
use App\Models\User;
use DateTime;

class UserController
{

      private $user;
      private $ChucVu;
public function logout(){
            unset($_SESSION['user']);
            header("location:?url=login");
     
    
      
}
      public function login(){
            return view('admins.user.login');
      }
      public function auth(){
            if(isset($_SESSION['user'])){
                  route('login');
            }{
                  $email = $_POST['email'];
                  $pass = $_POST['pass'];
                  $regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
                  if (!preg_match($regex_email, $email)) {
                        with('errors','Tài khoản không đúng định dạng email','login');
                  } 
                $user =   $this -> user -> login($email,$pass);
                  if(!empty($user)){
              
                        $_SESSION['user'] = $user;
                       header('location:?url=/');
                  }else{
                        with('errors','Tài khoản hoặc mật khẩu không đúng','login');
                  }
            }
          
      }
      public function __construct()
      {
            $this->user = new User();
            $this->ChucVu = new ChucVu();
      }
      public function index()
      {
            $list = $this->user->getAll();


            return view('admins.user.index', compact('list'));
      }
      public function delete($id)
      {
           $value =  $this -> user ->getOne($id);
            $this->user->Delete($id);
            $imgPath =  'public/img/' . $value['anh_dai_dien'];
            unlink($imgPath);
            with('success',"Xóa thành công",'list-user');
        
            
      }

      public function edit($id)
      {
            $chucVu = $this->ChucVu->getAll();
            $value = $this->user->getOne($id);

            return view('admins.user.edit', compact('value', 'chucVu'));
      }
      public function add_view()
      {
            $value = $this->ChucVu->getAll();
            return view('admins.user.add', compact('value'));
      }
      public function push()
      {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                  $anh_dai_dien = basename($_FILES['anh_dai_dien']['name']);
                  $ho_ten = $_POST['ten_nguoi_dung'];
                  $mat_khau = $_POST['mat_khau'];
                  $email = $_POST['email'];
                  $ngay_sinh = $_POST['ngay_sinh'];

                  $so_dien_thoai = $_POST['so_dien_thoai'];
                  $dia_chi = $_POST['dia_chi'];
                  $gioi_tinh = $_POST['gioi_tinh'];
                  $today = new DateTime();
                  $dateOfBirth = new DateTime($ngay_sinh);
                  $chuc_vu_id = $_POST['chuc_vu'];

                  $imgPath =  'public/img/' . $anh_dai_dien;
                  if (
                        $anh_dai_dien == "" &&
                        $ho_ten == "" &&
                        $mat_khau == "" &&
                        $email == "" &&
                        $ngay_sinh == "" &&
                        $so_dien_thoai == "" &&
                        $dia_chi == ""
                  ) {
                        with('errors', "Tất cả các trường không được để trống", 'page-add');
                  } elseif (

                        $anh_dai_dien == "" ||
                        $ho_ten == "" ||
                        $mat_khau == "" ||
                        $email == "" ||
                        $ngay_sinh == "" ||
                        $so_dien_thoai == "" ||
                        $dia_chi == ""
                  ) {
                        $anh_dai_dien == "" ? with('errors', "Ảnh người dùng không được để trống", 'page-add') : "";
                        $ho_ten == "" ? with('errors', ["Tên người dùng không được để trống"], 'page-add') : "";
                        $mat_khau == "" ? with('errors', "Mật khẩu  không được để trống", 'page-add') : "";
                        $email == "" ? with('errors', "Email không được để trống", 'page-add') : "";
                        $ngay_sinh == "" ? with('errors', "Ngày sinh không được để trống", 'page-add') : "";
                        $so_dien_thoai == "" ? with('errors', "Số điện thoại không được để trống", 'page-add') : "";
                        $dia_chi == "" ? with('errors', "Địa chỉ không được để trống", 'page-add') : "";
                  } else {
                        $regex_phone = '/(84|0[3|5|7|8|9])+([0-9]{8})\b/';
                        $regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
                           // Kiểm tra mật khẩu
                        if(strlen($mat_khau) < 8){
                              echo "Mật khẩu phải trên 8 ký tự";
                              
                              with('errors', "Mật khẩu phải trên 8 ký tự", 'page-add');
                        }
                        // Kiểm tra ngày sinh
                        if ($dateOfBirth >= $today) {
                              with('errors', "ngày sinh không được lớn hơn ngày hiện tại", 'page-add');
                       
                          }
                     
                        // Kiểm tra email
                        if (preg_match($regex_email, $email) === 1) {
                              $checkEmail = true;
                        } else {
                              $checkEmail = false;
                        }

                        // Kiểm tra số điện thoại
                        if (preg_match($regex_phone, $so_dien_thoai) === 1) {
                              $checkPhone = true;
                        } else {
                              $checkPhone = false;
                        }

                        // Xử lý nếu email không hợp lệ
                        if ($checkEmail == false) {
                              with('errors', "Email không hợp lệ", 'page-add');
                              // }
                        }

                        // Xử lý nếu số điện thoại không hợp lệ
                        if ($checkPhone == false) {
                              with('errors', "Số điện thoại không hợp lệ", 'page-add');
                              exit;
                        }

                        // Nếu cả email và số điện thoại đều hợp lệ, tiếp tục xử lý

                        $data = [
                              'anh_dai_dien' => $anh_dai_dien,
                              'ho_ten' => $ho_ten,
                              'email' => $email,
                              'ngay_sinh' => $ngay_sinh,
                              'so_dien_thoai' => $so_dien_thoai,
                              'dia_chi' => $dia_chi,
                              'gioi_tinh' => $gioi_tinh,
                              'mat_khau' => $mat_khau,
                              'chuc_vu_id' => $chuc_vu_id,
                              'trang_thai' => 1,

                        ];
                        if ($checkEmail && $checkPhone) {
                              if (move_uploaded_file($_FILES['anh_dai_dien']['tmp_name'], $imgPath)) {
                                    $this->user->add($data);

                                    // header("location:'?url=list-user");
                              }
                              with('success', "Thêm mới thành công", 'list-user');
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

                  $anh_dai_dien = basename($_FILES['anh_dai_dien']['name']);
                  $ho_ten = $_POST['ten_nguoi_dung'];
                  $mat_khau = $_POST['mat_khau'];
                  $email = $_POST['email'];
                  $ngay_sinh = $_POST['ngay_sinh'];

                  $so_dien_thoai = $_POST['so_dien_thoai'];
                  $dia_chi = $_POST['dia_chi'];
                  $gioi_tinh = $_POST['gioi_tinh'];


                  $chuc_vu_id = $_POST['chuc_vu'];
                  $imgPath =  'public/img/' . $anh_dai_dien;
                  $id = $_POST['id'];
                  if (
                      
                        $ho_ten == "" &&
                        $mat_khau == "" &&
                        $email == "" &&
                        $ngay_sinh == "" &&
                        $so_dien_thoai == "" &&
                        $dia_chi == ""
                  ) {
                        with('errors', "Tất cả các trường không được để trống", 'page-add');
                  } elseif (

                     
                        $ho_ten == "" ||
                        $mat_khau == "" ||
                        $email == "" ||
                        $ngay_sinh == "" ||
                        $so_dien_thoai == "" ||
                        $dia_chi == ""
                  ) {
                        // $anh_dai_dien == "" ? with('errors', "Ảnh người dùng không được để trống", 'edit/'.$id) : "";
                        $ho_ten == "" ? with('errors', ["Tên người dùng không được để trống"], 'edit/') : "";
                        $mat_khau == "" ? with('errors', "Mật khẩu  không được để trống", 'edit/'.$id) : "";
                        $email == "" ? with('errors', "Email không được để trống", 'edit/'.$id) : "";
                        $ngay_sinh == "" ? with('errors', "Ngày sinh không được để trống", 'edit/'.$id) : "";
                        $so_dien_thoai == "" ? with('errors', "Số điện thoại không được để trống", 'edit/'.$id) : "";
                        $dia_chi == "" ? with('errors', "Địa chỉ không được để trống", 'edit/'.$id) : "";
                  } else {
                        $regex_phone = '/(84|0[3|5|7|8|9])+([0-9]{8})\b/';
                        $regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
                        if(strlen($mat_khau) > 8){
                              with('errors', "Mật khẩu phải trên 8 ký tự", 'edit/'.$id);
                        }
                        // Kiểm tra email
                        if (preg_match($regex_email, $email) === 1) {
                              $checkEmail = true;
                        } else {
                              $checkEmail = false;
                        }

                        // Kiểm tra số điện thoại
                        if (preg_match($regex_phone, $so_dien_thoai) === 1) {
                              $checkPhone = true;
                        } else {
                              $checkPhone = false;
                        }

                        // Xử lý nếu email không hợp lệ
                        if ($checkEmail == false) {
                              with('errors', "Email không hợp lệ", 'edit/'.$id);
                              // }
                        }

                        // Xử lý nếu số điện thoại không hợp lệ
                        if ($checkPhone == false) {
                              with('errors', "Số điện thoại không hợp lệ", 'edit/'.$id);
                              exit;
                        }

                        // Nếu cả email và số điện thoại đều hợp lệ, tiếp tục xử lý


                     
                        $data = [

                              'ho_ten' => $ho_ten,
                              'email' => $email,
                              'ngay_sinh' => $ngay_sinh,
                              'so_dien_thoai' => $so_dien_thoai,
                              'dia_chi' => $dia_chi,
                              'gioi_tinh' => $gioi_tinh,
                              'mat_khau' => $mat_khau,
                              'chuc_vu_id' => $chuc_vu_id,
                              'trang_thai' => 1,

                        ];
                        if (!empty($anh_dai_dien)) {
                              $data['anh_dai_dien'] = $anh_dai_dien;
                          } else {
                              // Nếu $anh_dai_dien rỗng thì xóa phần tử 'anh_dai_dien' khỏi mảng $data nếu nó tồn tại
                              unset($data['anh_dai_dien']);
                          }
                           
                        if (move_uploaded_file($_FILES['anh_dai_dien']['tmp_name'], $imgPath)) {
                        }
                        if ($checkEmail && $checkPhone) {

                              $this->user->update($data, $id);
                              header("location:?url=list-user");
                        }
                  }
            }
      }
}
