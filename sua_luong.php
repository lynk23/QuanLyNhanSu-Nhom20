<?php
include "connect.php";

/* ===============================
   LẤY DANH SÁCH LƯƠNG
================================ */
$sql = "
    SELECT 
        id,
        manv,
        hoten,
        luongcoban,
        phucap,
        thuetncn,
        tongluong
    FROM tbl_luong
    WHERE is_deleted = 0
    ORDER BY hoten
";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Không có dữ liệu lương để sửa");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sửa lương</title>
<link rel="stylesheet" href="luong.css">
</head>
<body>

<div class="menu">
    <a href="luong.php">⬅ Quản lý lương</a>
</div>

<h2 class="tieude-form">SỬA THÔNG TIN LƯƠNG</h2>

<div class="form-container">
<form method="post" action="xuly_sua_luong.php">

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="nhanvien-block">

        <strong>
            <?= htmlspecialchars($row['hoten']) ?> 
            (<?= htmlspecialchars($row['manv']) ?>)
        </strong>

        <!-- ID lương (BẮT BUỘC) -->
        <input type="hidden" name="luong[<?= $row['id'] ?>][id]" value="<?= $row['id'] ?>">

        <label>Lương cơ bản</label>
        <input type="text" name="luong[<?= $row['id'] ?>][luongcoban]"
               value="<?= $row['luongcoban'] ?>">

        <label>Phụ cấp</label>
        <input type="text" name="luong[<?= $row['id'] ?>][phucap]"
               value="<?= $row['phucap'] ?>">

        <label>Thuế TNCN</label>
        <input type="text" name="luong[<?= $row['id'] ?>][thuetncn]"
               value="<?= $row['thuetncn'] ?>">

    </div>
    <hr>
<?php } ?>

<input type="submit" value="💾 Cập nhật toàn bộ lương">

</form>
</div>

</body>
</html>
