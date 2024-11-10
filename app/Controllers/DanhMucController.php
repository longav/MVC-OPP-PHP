<?php

namespace App\Controllers;


use App\Models\DanhMuc;



class DanhMucController
{


    private $DanhMuc;
    public function __construct()
    {

        $this-> DanhMuc = new DanhMuc();
    }
    public function index()
    {
        $list = $this->DanhMuc->getAll();


        return view('admins.danhmuc.index', compact('list'));
    }
    public function delete($id)
    {
        if(  $this -> DanhMuc -> Delete($id)){

            with('success',"Xóa danh mục thành công",'list-danhMuc');
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

        $value = $this-> DanhMuc->getOne($id);

        return view('admins.danhmuc.update', compact('value'));
    }
    public function add_view()
    {

        return view('admins.danhmuc.add');
    }
    public function push()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $danh_muc = $_POST['danh_muc'];

      
            if (
                $danh_muc == ""

            ) {
             
                with('errors', "Tất cả các trường không được để trống", 'add-danhMuc-page');
            } else {


                $data = [
                    'ten_danh_muc' => $danh_muc

                ];


                $this-> DanhMuc ->add($data);


                with('success', "Thêm mới thành công", 'list-danhMuc');
            }
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $danh_muc = $_POST['danh_muc'];
            $id = $_POST['id'];
         
            if (

                $danh_muc == ""
            ) {
                with('errors', "Tất cả các trường không được để trống", 'edit-danhMuc/'. $id);
            } elseif (


                $danh_muc == ""
            ) {
                // $anh_dai_dien == "" ? with('errors', "Ảnh người dùng không được để trống", 'edit/'.$id) : "";
                $danh_muc == "" ? with('errors', "Tên danh mục không được để trống", 'edit-danhMuc/'. $id) : "";
            } else {


                // Xử lý nếu email không hợp lệ


                // Nếu cả email và số điện thoại đều hợp lệ, tiếp tục xử lý



                $data = [

                    'ten_danh_muc' => $danh_muc

                ];




                $this->DanhMuc->update($data, $id);
                header("location:?url=list-danhMuc");
            }
        }
    }
    public function search(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
                $search = $_POST['search'];

               $list = $this -> DanhMuc ->Search($search);
               return view('admins.danhmuc.index', compact('list'));
        }
    }
}
