<?php
session_start();
include "connect.php";

/* =========================
   KIỂM TRA FORM
========================= */
if (!isset($_POST['ids']) || count($_POST['ids']) == 0) {
    $_SESSION['msg'] = "❌ Vui lòng chọn nhân viên để thêm / cập nhật lương";
    header("Location: luong.php");
    exit;
}

foreach ($_POST['ids'] as $id_luong) {

    $id_luong = (int)$id_luong;

    /* =========================
       LẤY MaNV TỪ tbl_luong
    ========================= */
    $q = mysqli_query($conn, "
        SELECT MaNV 
        FROM tbl_luong 
        WHERE id = $id_luong
    ");

    if (mysqli_num_rows($q) == 0) {
        continue;
    }

    $row = mysqli_fetch_assoc($q);
    $manv = $row['MaNV'];

    /* =========================
       LẤY TÊN NHÂN VIÊN
    ========================= */
    $nv = mysqli_query($conn, "
        SELECT HoTen 
        FROM tbl_nhanvien 
        WHERE MaNV = '$manv'
    ");

    if (mysqli_num_rows($nv) == 0) {
        continue;
    }

    $hoten = mysqli_fetch_assoc($nv)['HoTen'];

    /* =========================
       GIÁ TRỊ MẶC ĐỊNH
    ========================= */
    $luongcoban = 5000000;
    $phucap     = 0;
    $thuetncn   = 0;
    $tongluong  = $luongcoban + $phucap - $thuetncn;

    /* =========================
       CẬP NHẬT LƯƠNG
    ========================= */
    mysqli_query($conn, "
        UPDATE tbl_luong SET
            HoTen       = '$hoten',
            Luongcoban  = $luongcoban,
            Phucap      = $phucap,
            ThueTNCN    = $thuetncn,
            Tongluong   = $tongluong
        WHERE id = $id_luong
    ");
}

$_SESSION['msg'] = "✅ Thêm / cập nhật lương thành công";
header("Location: luong.php");
exit;
