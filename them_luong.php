<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $manv = (int)$_POST['manv'];

    // Lấy họ tên theo mã nhân viên
    $getNV = mysqli_query(
        $conn,
        "SELECT hoten FROM tbl_nhanvien WHERE manv = $manv"
    );
    $nv = mysqli_fetch_assoc($getNV);
    $hoten = mysqli_real_escape_string($conn, $nv['hoten']);

    // Lấy & xử lý tiền
    $luongcoban = (int)str_replace(['.', ','], '', $_POST['luongcoban']);
    $thuetncn   = (int)str_replace(['.', ','], '', $_POST['thuetncn']);

    // Tính tổng lương
    $tongluong = $luongcoban - $thuetncn;

    // Insert vào bảng tbl_luong
    $sql = "INSERT INTO tbl_luong (manv, hoten, luongcoban, thuetncn, tongluong)
            VALUES ($manv, '$hoten', $luongcoban, $thuetncn, $tongluong)";

    mysqli_query($conn, $sql);

    header("Location: luong.php");
    exit();
}

// Lấy danh sách nhân viên
$nhanvien = mysqli_query(
    $conn,
    "SELECT manv, hoten FROM tbl_nhanvien"
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thêm Thông Tin Lương</title>
    <link rel="stylesheet" href="luong.css">
</head>
<body>

<div class="menu">
    <a href="luong.php">Quản lý lương</a>
</div>

<h2 class="tieude-form">THÊM THÔNG TIN LƯƠNG</h2>

<div class="form-container">
<form method="post">

    <label>Chọn nhân viên:</label>
    <select name="manv" required>
        <option value="">-- Chọn nhân viên --</option>
        <?php while ($nv = mysqli_fetch_assoc($nhanvien)) { ?>
            <option value="<?= $nv['manv'] ?>">
                <?= $nv['hoten'] ?>
            </option>
        <?php } ?>
    </select><br>

    <label>Lương cơ bản:</label>
    <input type="text" id="luongcoban_show" placeholder="Nhập lương cơ bản" required>
    <input type="hidden" name="luongcoban" id="luongcoban"><br>

    <label>Thuế TNCN:</label>
    <input type="text" id="thuetncn_show" placeholder="Nhập thuế TNCN" required>
    <input type="hidden" name="thuetncn" id="thuetncn"><br>

    <input type="submit" value="Lưu thông tin lương">
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
    ">🏠Trang chủ</a>
</div>

<script>
function formatCurrency(input, hiddenId) {
    input.addEventListener('input', function () {
        let raw = this.value.replace(/\D/g, '');
        if (raw === '') raw = '0';

        this.value = raw.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        document.getElementById(hiddenId).value = raw;
    });
}

window.onload = function () {
    formatCurrency(
        document.getElementById("luongcoban_show"),
        "luongcoban"
    );
    formatCurrency(
        document.getElementById("thuetncn_show"),
        "thuetncn"
    );
};
</script>

</body>
</html>
