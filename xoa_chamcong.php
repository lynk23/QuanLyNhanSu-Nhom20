<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['ids'])) {

    // Ép kiểu an toàn
    $maccs = array_map('intval', $_POST['ids']);
    $macc_string = implode(',', $maccs);

    if (!empty($macc_string)) {
        $sql = "DELETE FROM tbl_chamcong WHERE macc IN ($macc_string)";
        mysqli_query($conn, $sql);
    }

    header("Location: chamcong.php");
    exit();
}

echo "Không có bản ghi nào được chọn.";
?>