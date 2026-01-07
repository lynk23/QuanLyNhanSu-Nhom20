<?php
include "connect.php";

/* ===============================
   TỰ ĐỘNG CHẤM CÔNG HÔM NAY
=============================== */

// Lấy ngày hôm nay
$today = date('Y-m-d');

// Lấy danh sách nhân viên hiện tại
$sql_nv = "SELECT MaNV, HoTen, TrangThai FROM tbl_nhanvien";
$result_nv = mysqli_query($conn, $sql_nv);

while ($nv = mysqli_fetch_assoc($result_nv)) {

    $manv = $nv['MaNV'];
    $hoten = mysqli_real_escape_string($conn, $nv['HoTen']);
    $trangthai = ($nv['TrangThai'] == 'Còn làm') ? 'Đi làm' : 'Đã nghỉ';

    // Kiểm tra xem nhân viên này đã có bản ghi hôm nay chưa
    $check = mysqli_query($conn, "
        SELECT MaCC FROM tbl_chamcong
        WHERE MaNV='$manv' AND Ngay='$today'
    ");

    if (mysqli_num_rows($check) == 0) {
        // Thêm bản ghi mới
        mysqli_query($conn, "
            INSERT INTO tbl_chamcong
            (MaNV, HoTen, Ngay, TrangThai, is_deleted)
            VALUES
            ('$manv', '$hoten', '$today', '$trangthai', 0)
        ");
    }
}

/* Chuyển về trang danh sách chấm công */
header("Location: chamcong.php");
exit;
