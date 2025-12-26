<?php
include "connect.php";

/* =========================
   XỬ LÝ CẬP NHẬT (POST)
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['macc'])) {

    $macc      = (int)$_POST['macc'];
    $ngay      = $_POST['ngay'];
    $trangthai = $_POST['trangthai'];

    $sql = "UPDATE tbl_chamcong 
            SET ngay = '$ngay',
                trangthai = '$trangthai'
            WHERE macc = $macc";

    mysqli_query($conn, $sql);

    header("Location: chamcong.php");
    exit();
}

/* =========================
   LẤY DỮ LIỆU CŨ (GET)
========================= */
if (!isset($_GET['macc'])) {
    header("Location: chamcong.php");
    exit();
}

$macc = (int)$_GET['macc'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM tbl_chamcong WHERE macc = $macc"
);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: chamcong.php");
    exit();
}

$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sửa chấm công</title>
    <link rel="stylesheet" href="chamcong.css">
</head>
<body>

<h2 class="tieude-form">SỬA CHẤM CÔNG</h2>

<div class="form-container">
<form method="post">

    <input type="hidden" name="macc" value="<?= $row['macc'] ?>">

    <div>
        <label>Mã chấm công:</label>
        <strong><?= $row['macc'] ?></strong>
    </div>

    <div>
        <label>Nhân viên:</label>
        <strong><?= $row['manv'] ?> - <?= $row['hoten'] ?></strong>
    </div>

    <div>
        <label>Ngày công:</label>
        <input type="date" name="ngay" value="<?= $row['ngay'] ?>" required>
    </div>

    <div>
        <label>Trạng thái:</label>
        <select name="trangthai" required>
            <option value="Đi làm" <?= $row['trangthai']=='Đi làm'?'selected':'' ?>>Đi làm</option>
            <option value="Vắng" <?= $row['trangthai']=='Vắng'?'selected':'' ?>>Vắng</option>
            <option value="Nghỉ phép" <?= $row['trangthai']=='Nghỉ phép'?'selected':'' ?>>Nghỉ phép</option>
            <option value="Đã nghỉ" <?= $row['trangthai']=='Đã nghỉ'?'selected':'' ?>>Đã nghỉ</option>
        </select>
    </div>

    <input type="submit" value="Lưu thay đổi">
</form>
</div>

<div style="text-align:center; margin-top:20px;">
    <a href="chamcong.php" style="
        background:#dc3545;
        color:white;
        padding:10px 15px;
        text-decoration:none;
        border-radius:6px;
        font-weight:bold;
    ">⬅ Quay lại danh sách</a>
</div>

</body>
</html>
