<?php
session_start();
include "connect.php";

/* =========================
   KIỂM TRA DỮ LIỆU
========================= */
if (empty($_POST['manvs'])) {
    $_SESSION['msg'] = "❌ Vui lòng chọn ít nhất 1 nhân viên để xóa lương";
    header("Location: luong.php");
    exit;
}

/* =========================
   LỌC MaNV AN TOÀN
========================= */
$manvs = array_map(function ($v) use ($conn) {
    return "'" . mysqli_real_escape_string($conn, $v) . "'";
}, $_POST['manvs']);

$list = implode(',', $manvs);

/* =========================
   XÓA VĨNH VIỄN
========================= */
$sql = "DELETE FROM tbl_luong WHERE MaNV IN ($list)";
mysqli_query($conn, $sql);

/* =========================
   THÔNG BÁO
========================= */
$_SESSION['msg'] = "✅ Đã xóa vĩnh viễn lương nhân viên đã chọn";
header("Location: luong.php");
exit;
