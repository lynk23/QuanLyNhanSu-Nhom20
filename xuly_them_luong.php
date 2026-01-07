<?php
session_start();
include "connect.php";

/* 1️⃣ KIỂM TRA DỮ LIỆU */
if (empty($_POST['manv'])) {
    $_SESSION['msg'] = "❌ Chưa chọn nhân viên";
    header("Location: them_luong.php");
    exit;
}

$manv = mysqli_real_escape_string($conn, $_POST['manv']);
$luongcoban = (int)$_POST['luongcoban'];
$phucap     = (int)$_POST['phucap'];
$thuetncn   = (int)$_POST['thuetncn'];
$tongluong  = $luongcoban + $phucap - $thuetncn;

/* 2️⃣ KIỂM TRA NHÂN VIÊN CÓ TỒN TẠI */
$checkNV = mysqli_query($conn,
    "SELECT HoTen FROM tbl_nhanvien WHERE MaNV = '$manv'"
);

if (mysqli_num_rows($checkNV) == 0) {
    $_SESSION['msg'] = "❌ Nhân viên không tồn tại";
    header("Location: them_luong.php");
    exit;
}

$hoten = mysqli_fetch_assoc($checkNV)['HoTen'];

/* 3️⃣ KIỂM TRA ĐÃ CÓ LƯƠNG CHƯA */
$checkLuong = mysqli_query($conn,
    "SELECT id FROM tbl_luong WHERE MaNV = '$manv'"
);

if (mysqli_num_rows($checkLuong) == 0) {
    /* 👉 CHƯA CÓ → INSERT */
    mysqli_query($conn, "
        INSERT INTO tbl_luong
        (MaNV, hoten, Luongcoban, Phucap, ThueTNCN, Tongluong)
        VALUES
        ('$manv', '$hoten', $luongcoban, $phucap, $thuetncn, $tongluong)
    ");
} else {
    /* 👉 CÓ → UPDATE */
    mysqli_query($conn, "
        UPDATE tbl_luong SET
            hoten      = '$hoten',
            Luongcoban = $luongcoban,
            Phucap     = $phucap,
            ThueTNCN   = $thuetncn,
            Tongluong  = $tongluong
        WHERE MaNV = '$manv'
    ");
}

$_SESSION['msg'] = "✅ Lưu lương thành công";
header("Location: luong.php");
exit;
