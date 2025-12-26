<?php
session_start();
include 'ketnoi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['luong'])) {

    $count = 0;

    foreach ($_POST['luong'] as $id => $data) {

        // Ép kiểu an toàn
        $id = (int)$id;

        if ($id <= 0) continue;

        $luongcoban = isset($data['luongcoban']) ? (int)$data['luongcoban'] : 0;
        $thuetncn   = isset($data['thuetncn'])   ? (int)$data['thuetncn']   : 0;

        // Tính tổng lương
        $tongluong = $luongcoban - $thuetncn;

        // ❗ Chỉ update bản ghi CHƯA bị xóa mềm
        $sql = "UPDATE tbl_luong SET
                    luongcoban = $luongcoban,
                    thuetncn   = $thuetncn,
                    tongluong  = $tongluong
                WHERE id = $id AND is_deleted = 0";

        if (mysqli_query($conn, $sql)) {
            if (mysqli_affected_rows($conn) > 0) {
                $count++;
            }
        }
    }

    // Thông báo kết quả
    if ($count > 0) {
        $_SESSION['msg'] = "✅ Đã cập nhật $count bản ghi lương";
    } else {
        $_SESSION['msg'] = "⚠️ Không có bản ghi nào được cập nhật";
    }

    header("Location: luong.php");
    exit();

} else {
    $_SESSION['msg'] = "❌ Dữ liệu sửa không hợp lệ";
    header("Location: luong.php");
    exit();
}
