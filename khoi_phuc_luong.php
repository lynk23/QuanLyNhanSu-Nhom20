<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['ids'])) {

    // Lọc ID an toàn
    $ids = array_map('intval', $_POST['ids']);
    $ids_string = implode(',', $ids);

    $sql = "
        UPDATE tbl_luong
        SET is_deleted = 0
        WHERE id IN ($ids_string)
    ";

    mysqli_query($conn, $sql);
}

header("Location: luong.php");
exit;
