<?php
include "ketnoi.php";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['chamcong'])) {

    foreach ($_POST['chamcong'] as $macc => $data) {

        // Ép kiểu an toàn
        $macc = (int)$macc;

        $ngay = $data['ngay'];
        $trangthai = $data['trangthai'];

        if ($macc > 0) {
            $sql = "UPDATE tbl_chamcong 
                    SET ngay = '$ngay',
                        trangthai = '$trangthai'
                    WHERE macc = $macc";

            mysqli_query($conn, $sql);
        }
    }

    header("Location: chamcong.php");
    exit();
}

echo "Dữ liệu không hợp lệ!";
