<?php
include "connect.php";

/* ===============================
   LẤY DANH SÁCH CHẤM CÔNG
   Chỉ lấy bản ghi chưa xóa (is_deleted = 0)
================================ */
$sql = "
    SELECT 
        MaCC,
        MaNV,
        HoTen,
        Ngay,
        TrangThai
    FROM tbl_chamcong
    WHERE is_deleted = 0
    ORDER BY Ngay DESC, HoTen
";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Không có dữ liệu chấm công để sửa");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sửa chấm công</title>
<link rel="stylesheet" href="chamcong.css">
</head>
<body>

<div class="menu">
    <a href="chamcong.php">⬅ Quản lý chấm công</a>
</div>

<h2 class="tieude-form">SỬA THÔNG TIN CHẤM CÔNG</h2>

<div class="form-container">
<form method="post" action="xuly_sua_chamcong.php">

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="nhanvien-block">

        <strong>
            <?= htmlspecialchars($row['HoTen']) ?> 
            (<?= htmlspecialchars($row['MaNV']) ?>)
        </strong>

        <!-- ID chấm công (BẮT BUỘC) -->
        <input type="hidden" name="MaCC[<?= $row['MaCC'] ?>]" value="<?= $row['MaCC'] ?>">
        <input type="hidden" name="MaNV[<?= $row['MaCC'] ?>]" value="<?= htmlspecialchars($row['MaNV']) ?>">
        <input type="hidden" name="HoTen[<?= $row['MaCC'] ?>]" value="<?= htmlspecialchars($row['HoTen']) ?>">

        <label>Ngày</label>
        <input type="date" name="Ngay[<?= $row['MaCC'] ?>]" value="<?= $row['Ngay'] ?>">

        <label>Trạng thái</label>
        <select name="TrangThai[<?= $row['MaCC'] ?>]">
            <option value="Đi làm" <?= $row['TrangThai']=='Đi làm'?'selected':'' ?>>Đi làm</option>
            <option value="Đã nghỉ" <?= $row['TrangThai']=='Đã nghỉ'?'selected':'' ?>>Đã nghỉ</option>
        </select>

    </div>
    <hr>
<?php } ?>

<input type="submit" value="💾 Cập nhật toàn bộ chấm công">

</form>
</div>

</body>
</html>
