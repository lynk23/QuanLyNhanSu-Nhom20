<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $manv = $_POST['manv'];
    $ngay = $_POST['ngay'];
    $trangthai = $_POST['trangthai'];

    // Lấy họ tên theo mã nhân viên
    $getNV = mysqli_query(
        $conn,
        "SELECT hoten FROM tbl_nhanvien WHERE manv = '$manv'"
    );
    $nv = mysqli_fetch_assoc($getNV);
    $hoten = $nv['hoten'];

    // Insert vào bảng chấm công
    $sql = "INSERT INTO tbl_chamcong (manv, hoten, ngay, trangthai)
            VALUES ('$manv', '$hoten', '$ngay', '$trangthai')";

    mysqli_query($conn, $sql);

    header("Location: chamcong.php");
    exit();
}

// Lấy danh sách nhân viên
$ds_nv = mysqli_query(
    $conn,
    "SELECT manv, hoten FROM tbl_nhanvien"
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thêm chấm công</title>
    <link rel="stylesheet" href="quanly.css">
</head>
<body>

<div class="menu">
    <a href="chamcong.php">📅 Quản lý chấm công</a>
</div>

<h2 class="tieude-form">THÊM CHẤM CÔNG</h2>

<div class="form-container">
<form method="post">
    
        <label>Nhân viên:</label>
        <select name="manv" required>
            <option value="">-- Chọn nhân viên --</option>
            <?php while ($nv = mysqli_fetch_assoc($ds_nv)) { ?>
                <option value="<?= $nv['manv'] ?>">
                    <?= $nv['manv'] ?> - <?= $nv['hoten'] ?>
                </option>
            <?php } ?>
        </select>
  
        <label>Ngày công:</label>
        <input type="date" name="ngay" required>
   
        <label>Trạng thái:</label>
        <select name="trangthai" required>
            <option value="Đi làm">Đi làm</option>
            <option value="Vắng">Vắng</option>
            <option value="Nghỉ phép">Nghỉ phép</option>
            <option value="Đã nghỉ">Đã nghỉ</option>
        </select>
    </div>
    
    <input type="submit" value="Lưu chấm công">
</form>
</div>

<div style="position: fixed; top: 10px; right: 10px;">
    <a href="index.php" style="
        background:#007bff;
        color:white;
        padding:10px 15px;
        text-decoration:none;
        border-radius:6px;
        font-weight:bold;
    ">🏠 Trang chủ</a>
</div>

</body>
</html>
