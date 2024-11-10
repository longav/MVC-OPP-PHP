<?php

namespace App\Models;


use PDOException;

class User extends Model implements base
{
    private $model;
    public function __construct()
    {
        $this->model = parent::connectDB();
    }

    public function getAll()
    {
        // 
        try {
            $sql = "SELECT DISTINCT `nguoi_dungs`. * ,  `chuc_vus`.`id` AS `id_chuc_vu`, 
                    `chuc_vus`.`ten_chuc_vu` 
                    FROM `nguoi_dungs`
                    INNER JOIN `chuc_vus` ON `nguoi_dungs`.`chuc_vu_id` = `chuc_vus`.`id`
                    ORDER BY `nguoi_dungs`.`id` DESC;
";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
            // var_dump($stmt->fetchAll());
            // die();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function Delete($id)
    {

        try {
            $sql = "DELETE FROM `nguoi_dungs` WHERE `id` = {$id}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function add($data)
    {

        // Khởi tạo chuỗi tên cột và chuỗi placeholder
        $columns = '';
        $placeholders = '';

        // Lặp qua mảng $data để xây dựng các chuỗi
        foreach ($data as $key => $value) {
            $columns .= "`$key`, "; // Tạo chuỗi tên cột (vd: `ho_ten`, `email`, ...)
            $placeholders .= ":$key, "; // Tạo chuỗi placeholder (vd: :ho_ten, :email, ...)
        }

        // Bỏ dấu phẩy cuối cùng của các chuỗi
        $columns = rtrim($columns, ', ');
        $placeholders = rtrim($placeholders, ', ');

        // Tạo câu truy vấn SQL với các placeholder
        $sql = "INSERT INTO `nguoi_dungs`($columns) VALUES ($placeholders)";

        // Hiển thị câu lệnh SQL để kiểm tra

        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($sql);

        // Gán giá trị cho các placeholder từ mảng $data
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Thực thi câu lệnh
        $stmt->execute();
    }
    public function getOne($id)
    {

        try {
            $sql = "SELECT * FROM `nguoi_dungs` WHERE `id` = {$id}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function update($arr, $id)
    {


        try {
            // Khởi tạo chuỗi cập nhật từ mảng $arr
            $setString = '';
            foreach ($arr as $key => $value) {
                $setString .= "$key = :$key, "; // Tạo cặp key = :key
            }
            // Bỏ dấu phẩy cuối cùng
            $setString = rtrim($setString, ', ');

            // Tạo câu truy vấn SQL với các placeholder
            $sql = "UPDATE `nguoi_dungs` SET $setString WHERE `id` = :id";

            // Chuẩn bị câu lệnh
            $stmt = $this->conn->prepare($sql);

            // Gán giá trị cho các placeholder từ mảng $arr
            foreach ($arr as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            // Gán thêm giá trị cho `id`
            $stmt->bindValue(':id', $id);

            // Thực thi câu lệnh
            $stmt->execute();

            // Kiểm tra xem có bản ghi nào bị ảnh hưởng không (tức là đã cập nhật thành công)
            if ($stmt->rowCount()) {
                return "Record with ID $id has been updated successfully.";
            } else {
                return "No changes made or record not found.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function login($email, $pass)
    {
        $sql = "SELECT  *
        FROM `nguoi_dungs` WHERE  `email` = '$email' AND `mat_khau` = '$pass'   ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
}
