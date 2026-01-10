<?php
session_start();
include "connect.php";

/* Kiểm tra dữ liệu */
if (!isset($_POST['ids']) || empty($_POST['ids'])) {
    $_SESSION['msg'] = "❌ Vui lòng chọn ít nhất 1 dòng để xóa vĩnh viễn";
    header("Location: luong.php");
    exit;
}

/* Lọc ID an toàn */
$ids = array_map('intval', $_POST['ids']);
$id_list = implode(',', $ids);

/* XÓA VĨNH VIỄN */
$sql = "DELETE FROM tbl_luong WHERE id IN ($id_list)";
mysqli_query($conn, $sql);

$_SESSION['msg'] = "✅ Đã xóa vĩnh viễn lương đã chọn";
header("Location: luong.php");
exit;
