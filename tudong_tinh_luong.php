<?php
session_start();
include "connect.php";

/* Lấy nhân viên đã chấm công hợp lệ */
$sql_nv = "
SELECT DISTINCT cc.MaNV, cc.Hoten
FROM tbl_chamcong cc
JOIN tbl_nhanvien nv ON cc.MaNV = nv.MaNV
WHERE IFNULL(cc.is_deleted,0) = 0
";

$rs = mysqli_query($conn, $sql_nv);
if (!$rs) {
    die("❌ LỖI SELECT: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($rs)) {

    $manv  = $row['MaNV'];
    $hoten = $row['Hoten'] ?: 'Chưa có tên';

    $luongcoban = 5000000;
    $phucap     = 0;
    $thuetncn   = 0;
    $tongluong  = $luongcoban;

    $check = mysqli_query($conn, "
        SELECT id FROM tbl_luong WHERE MaNV = '$manv'
    ");

    if (mysqli_num_rows($check) == 0) {

        $sql = "
        INSERT INTO tbl_luong
        (MaNV, hoten, Luongcoban, Phucap, ThueTNCN, Tongluong)
        VALUES
        ('$manv', '$hoten', $luongcoban, $phucap, $thuetncn, $tongluong)
        ";

    } else {

        $sql = "
        UPDATE tbl_luong SET
            hoten      = '$hoten',
            Luongcoban = $luongcoban,
            Phucap     = $phucap,
            ThueTNCN   = $thuetncn,
            Tongluong  = $tongluong
        WHERE MaNV = '$manv'
        ";
    }

    if (!mysqli_query($conn, $sql)) {
        die("❌ LỖI INSERT/UPDATE: " . mysqli_error($conn));
    }
}

$_SESSION['msg'] = "✅ Đã tự động tính lương";
header("Location: luong.php");
exit;
