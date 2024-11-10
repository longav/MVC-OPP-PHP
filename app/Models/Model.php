<?php

namespace App\Models;

use PDO;
use PDOException;

class Model
{
    protected $conn;

    public function connectDB()
    {
        $host       = DB_HOST;
        $dbname     = DB_NAME;

        // Kết nối đến CSDL
        try {
            // Tạo kết nối bằng PDO
            $this->conn = new PDO(
                "mysql:host=$host; dbname=$dbname",
                DB_USERNAME,
                DB_PASSWORD
            );

            // Thiết lập cơ chế lỗi
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Cài đặt chế độ hiển thị dữ liệu
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $this->conn;
            // echo "Kết nối thành công";
        } catch (PDOException $e) {
            echo "Lỗi kết nối CSDL: " . $e->getMessage();
        }
    }
}
