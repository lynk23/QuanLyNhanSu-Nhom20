<?php
include 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['ids'])) {

    $ids = array_map('intval', $_POST['ids']);
    $ids_string = implode(',', $ids);

    if ($ids_string !== '') {
        $sql = "UPDATE tbl_luong 
                SET is_deleted = 1 
                WHERE id IN ($ids_string)";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['msg'] = "🗑️ Đã xóa " . count($ids) . " bản ghi lương";
        } else {
            $_SESSION['msg'] = "❌ Lỗi khi xóa dữ liệu";
        }
    }

}

header("Location: luong.php");
exit();
