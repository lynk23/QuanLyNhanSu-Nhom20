<?php
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Thêm lương</title>
<link rel="stylesheet" href="luong.css">
</head>
<body>

<div class="luong-page">

<h2>➕ THÊM LƯƠNG NHÂN VIÊN</h2>

<?php if (!empty($_SESSION['msg'])) { ?>
    <div class="alert"><?= $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
<?php } ?>

<form method="post" action="xuly_them_luong.php">

<label>Nhân viên</label>
<select name="manv" required>
    <option value="">-- Chọn nhân viên --</option>
    <?php
    $nv = mysqli_query($conn, "SELECT MaNV, HoTen FROM tbl_nhanvien");
    while ($r = mysqli_fetch_assoc($nv)) {
        echo "<option value='{$r['MaNV']}'>{$r['MaNV']} - {$r['HoTen']}</option>";
    }
    ?>
</select>

<label>Lương cơ bản</label>
<input type="number" name="luongcoban" value="5000000" required>

<label>Phụ cấp</label>
<input type="number" name="phucap" value="0">

<label>Thuế TNCN</label>
<input type="number" name="thuetncn" value="0">

<br><br>
<button type="submit" class="btn-submit">💾 Lưu lương</button>
<a href="luong.php" class="home-btn">⬅ Quản lý lương</a>

</form>

</div>
</body>
</html>
