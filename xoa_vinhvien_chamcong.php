<?php
session_start();
include "connect.php";

/* ===============================
   KIỂM TRA DỮ LIỆU
================================ */
if (empty($_POST['ids'])) {
    $_SESSION['msg'] = "❌ Vui lòng chọn ít nhất 1 dòng chấm công";
    header("Location: chamcong.php");
    exit;
}

/* ===============================
   LẤY DANH SÁCH MaCC
================================ */
$ids  = array_map('intval', $_POST['ids']);
$list = implode(',', $ids);

/* ===============================
   XÓA VĨNH VIỄN
================================ */
$sql = "DELETE FROM tbl_chamcong WHERE MaCC IN ($list)";
mysqli_query($conn, $sql);

/* ===============================
   THÔNG BÁO
================================ */
$_SESSION['msg'] = "✅ Đã xóa vĩnh viễn chấm công";
header("Location: chamcong.php");
exit;
