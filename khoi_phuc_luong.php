<?php
include "connect.php";

if (!empty($_POST['manvs'])) {

    $manvs = array_map(function($v) use ($conn) {
        return "'" . mysqli_real_escape_string($conn, $v) . "'";
    }, $_POST['manvs']);

    $list = implode(',', $manvs);

    mysqli_query($conn, "
        UPDATE tbl_luong
        SET is_deleted = 0
        WHERE MaNV IN ($list)
    ");
}

header("Location: luong.php");
exit;
