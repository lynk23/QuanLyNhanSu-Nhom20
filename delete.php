<?php
include 'db.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tbl_nhanvien WHERE MaNV='$id'");
header("Location: wp_index.php");
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT HinhAnh FROM tbl_nhanvien WHERE MaNV=$id"));
unlink("C:\xampp\htdocs\nhanvien\anhNV" . $row['HinhAnh']);

mysqli_query($conn, "DELETE FROM tbl_nhanvien WHERE MaNV=$id");
