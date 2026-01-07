<?php
include 'connect.php';

/* =========================
   KHÔI PHỤC CHẤM CÔNG
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['ids'])) {

    // Lọc các ID an toàn
    $ids = array_map('intval', $_POST['ids']);
    $ids_string = implode(',', $ids);

    // Cập nhật is_deleted = 0 (khôi phục)
    $sql = "
        UPDATE tbl_chamcong
        SET is_deleted = 0
        WHERE MaCC IN ($ids_string)
    ";

    mysqli_query($conn, $sql);
}

/* Chuyển về trang danh sách chấm công */
header("Location: chamcong.php");
exit;
