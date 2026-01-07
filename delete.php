<?php
include 'connect.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tbl_nhanvien WHERE MaNV='$id'");
header("Location: trangchu.php");
?>