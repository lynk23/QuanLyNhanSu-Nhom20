<?php
session_start();
include "connect.php";

/* =========================
   KIỂM TRA FORM
========================= */
if (!isset($_POST['ids']) || count($_POST['ids']) == 0) {
    $_SESSION['msg'] = "❌ Vui lòng chọn nhân viên để thêm / cập nhật chấm công";
    header("Location: chamcong.php");
    exit;
}

/* =========================
   Lặp qua các MaCC được chọn
========================= */
foreach ($_POST['ids'] as $macc) {

    $macc = (int)$macc;

    /* =========================
       LẤY MaNV TỪ tbl_chamcong
    ========================= */
    $q = mysqli_query($conn, "
        SELECT MaNV 
        FROM tbl_chamcong 
        WHERE MaCC = $macc
    ");

    if (mysqli_num_rows($q) == 0) {
        continue;
    }

    $row = mysqli_fetch_assoc($q);
    $manv = $row['MaNV'];

    /* =========================
       LẤY HỌ TÊN NHÂN VIÊN
    ========================= */
    $nv = mysqli_query($conn, "
        SELECT HoTen, TrangThai
        FROM tbl_nhanvien 
        WHERE MaNV = '$manv'
    ");

    if (mysqli_num_rows($nv) == 0) {
        continue;
    }

    $nv_row = mysqli_fetch_assoc($nv);
    $hoten = $nv_row['HoTen'];
    $trangthai = ($nv_row['TrangThai'] == 'Còn làm') ? 'Đi làm' : 'Đã nghỉ';

    /* =========================
       NGÀY HIỆN TẠI
    ========================= */
    $ngay = date('Y-m-d');

    /* =========================
       KIỂM TRA NẾU ĐÃ CHẤM CÔNG HÔM NAY
    ========================= */
    $check = mysqli_query($conn, "
        SELECT * 
        FROM tbl_chamcong 
        WHERE MaNV = '$manv' AND Ngay = '$ngay' AND is_deleted = 0
    ");

    if (mysqli_num_rows($check) > 0) {
        // Nếu đã tồn tại, cập nhật trạng thái
        mysqli_query($conn, "
            UPDATE tbl_chamcong 
            SET HoTen = '$hoten',
                TrangThai = '$trangthai'
            WHERE MaNV = '$manv' AND Ngay = '$ngay'
        ");
    } else {
        // Nếu chưa có, thêm mới
        mysqli_query($conn, "
            INSERT INTO tbl_chamcong (MaNV, HoTen, Ngay, TrangThai, is_deleted)
            VALUES ('$manv', '$hoten', '$ngay', '$trangthai', 0)
        ");
    }
}

$_SESSION['msg'] = "✅ Thêm / cập nhật chấm công thành công";
header("Location: chamcong.php");
exit;
