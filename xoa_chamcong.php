<?php
include "connect.php";

/* =========================
   XÓA CHẤM CÔNG (Soft Delete)
========================= */
if (!empty($_POST['ids'])) {

    // Lọc các ID an toàn
    $ids = array_map('intval', $_POST['ids']);
    $ids_string = implode(',', $ids);

    // Cập nhật is_deleted = 1
    $sql = "
        UPDATE tbl_chamcong
        SET is_deleted = 1
        WHERE MaCC IN ($ids_string)
    ";

    mysqli_query($conn, $sql);
}

/* Chuyển về trang danh sách chấm công */
header("Location: chamcong.php");
exit;
