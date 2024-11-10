<?php

namespace App\Controllers;

use App\Models\ChucVu;
use App\Models\User;
use DateTime;

class ChucVuController
{


    private $ChucVu;
    public function __construct()
    {

        $this->ChucVu = new ChucVu();
    }
    public function index()
    {
        $list = $this->ChucVu->getAll();


        return view('admins.chucvu.index', compact('list'));
    }
    public function delete($id)
    {
        if(  $this -> ChucVu -> Delete($id)){

            with('success',"Xóa danh mục thành công",'list-chucVu');
        }
       

            // $_SESSION['success'] = "Xóa danh mục thành công";
            // header("location:?url=list-chucVu");
        


        // else{
        //     // $_SESSION['errors'] = "Danh mục chức vụ của bạn còn tồn tại bên người dùng không thể xóa danh mục này";
        //     // header("Location:?url=list-chucVu");
         
           
        // }
        
    }

    public function edit($id)
    {

        $value = $this->ChucVu->getOne($id);

        return view('admins.chucvu.update', compact('value'));
    }
    public function add_view()
    {

        return view('admins.chucvu.add');
    }
    public function push()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $chuc_vu = $_POST['chuc_vu'];


            if (
                $chuc_vu == ""

            ) {
                with('errors', "Tất cả các trường không được để trống", 'add-chucVu-page');
            } elseif (

                $chuc_vu == ""
            ) {
                $chuc_vu == "" ? with('errors', "Tên chức vụ không được để trống", 'add-chucVu-page') : "";
            } else {

                // Kiểm tra số điện thoại


                // Xử lý nếu số điện thoại không hợp lệ


                // Nếu cả email và số điện thoại đều hợp lệ, tiếp tục xử lý

                $data = [
                    'ten_chuc_vu' => $chuc_vu

                ];


                $this->ChucVu->add($data);


                with('success', "Thêm mới thành công", 'list-chucVu');
            }
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $chuc_vu = $_POST['chuc_vu'];
            $id = $_POST['id'];
         
            if (

                $chuc_vu == ""
            ) {
                with('errors', "Tất cả các trường không được để trống", 'page-add');
            } elseif (


                $chuc_vu == ""
            ) {
                // $anh_dai_dien == "" ? with('errors', "Ảnh người dùng không được để trống", 'edit/'.$id) : "";
                $chuc_vu == "" ? with('errors', "Tên chức vụ không được để trống", 'add-chucVu-page') : "";
            } else {


                // Xử lý nếu email không hợp lệ


                // Nếu cả email và số điện thoại đều hợp lệ, tiếp tục xử lý



                $data = [

                    'ten_chuc_vu' => $chuc_vu

                ];




                $this->ChucVu->update($data, $id);
                header("location:?url=list-chucVu");
            }
        }
    }
    public function search(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
                $search = $_POST['search'];

               $list = $this -> ChucVu ->Search($search);
               return view('admins.chucvu.index', compact('list'));
        }
    }
}
