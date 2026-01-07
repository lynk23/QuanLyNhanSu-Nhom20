<?php
include "connect.php";

/* =========================
   XỬ LÝ SỬA TOÀN BỘ CHẤM CÔNG
========================= */
if (!isset($_POST['MaCC']) || count($_POST['MaCC']) == 0) {
    header("Location: sua_chamcong.php");
    exit;
}

foreach ($_POST['MaCC'] as $macc) {

    $macc = (int)$macc;

    $manv = $_POST['MaNV'][$macc] ?? '';
    $hoten = $_POST['HoTen'][$macc] ?? '';
    $ngay = $_POST['Ngay'][$macc] ?? '';
    $trangthai = $_POST['TrangThai'][$macc] ?? '';

    // Cập nhật chấm công
    $sql = "
        UPDATE tbl_chamcong SET
            HoTen = '".mysqli_real_escape_string($conn,$hoten)."',
            Ngay = '".mysqli_real_escape_string($conn,$ngay)."',
            TrangThai = '".mysqli_real_escape_string($conn,$trangthai)."'
        WHERE MaCC = $macc
    ";
    mysqli_query($conn, $sql);
}

header("Location: chamcong.php");
exit;
