<?php
include "connect.php";

if (!empty($_POST['ids'])) {
    $ids = implode(',', array_map('intval', $_POST['ids']));
    mysqli_query($conn, "UPDATE tbl_luong SET is_deleted=1 WHERE id IN ($ids)");
}

header("Location: luong.php");
exit;
