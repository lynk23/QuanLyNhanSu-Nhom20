<?php
include "connect.php";

$luong_ngay = 300000;
$thue = 0.1;

$sql = "
    SELECT MaNV, Hoten, COUNT(*) AS songay
    FROM tbl_chamcong
    WHERE TrangThai='Có mặt'
    GROUP BY MaNV, Hoten
";

$result = mysqli_query($conn, $sql);

while ($r = mysqli_fetch_assoc($result)) {

    $manv = $r['MaNV'];
    $hoten = mysqli_real_escape_string($conn, $r['Hoten']);
    $luongcoban = $r['songay'] * $luong_ngay;
    $phucap = 0;
    $thuetncn = (int)($luongcoban * $thue);
    $tongluong = $luongcoban - $thuetncn;

    $check = mysqli_query($conn, "SELECT id FROM tbl_luong WHERE manv='$manv'");

    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "
            UPDATE tbl_luong SET
                hoten='$hoten',
                luongcoban=$luongcoban,
                phucap=$phucap,
                thuetncn=$thuetncn,
                tongluong=$tongluong,
                is_deleted=0
            WHERE manv='$manv'
        ");
    } else {
        mysqli_query($conn, "
            INSERT INTO tbl_luong
            (manv, hoten, luongcoban, phucap, thuetncn, tongluong)
            VALUES
            ('$manv','$hoten',$luongcoban,$phucap,$thuetncn,$tongluong)
        ");
    }
}

header("Location: luong.php");
exit;
