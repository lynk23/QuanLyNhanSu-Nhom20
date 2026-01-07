<?php
include "connect.php";

/* ===============================
   LẤY DANH SÁCH LƯƠNG
   Chỉ lấy bản ghi chưa xóa
================================ */
$sql = "
    SELECT 
        ID,
        MaNV,
        hoten,
        Luongcoban,
        Phucap,
        ThueTNCN,
        Tongluong
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

<div class="luong-page">

    <div class="menu">
        <a href="luong.php">⬅ Quản lý lương</a>
    </div>

    <h2 class="tieude-form">SỬA THÔNG TIN LƯƠNG</h2>

    <div class="form-container">
    <form method="post" action="xuly_sua_luong.php">

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="luong-item">

            <strong>
                <?= htmlspecialchars($row['hoten']) ?>
                (<?= htmlspecialchars($row['MaNV']) ?>)
            </strong>

            <!-- ID lương (BẮT BUỘC) -->
            <input type="hidden" name="ID[<?= $row['ID'] ?>]" value="<?= $row['ID'] ?>">
            <input type="hidden" name="MaNV[<?= $row['ID'] ?>]" value="<?= htmlspecialchars($row['MaNV']) ?>">
            <input type="hidden" name="hoten[<?= $row['ID'] ?>]" value="<?= htmlspecialchars($row['hoten']) ?>">

            <label>Lương cơ bản</label>
            <input type="number" name="Luongcoban[<?= $row['ID'] ?>]"
                   value="<?= $row['Luongcoban'] ?>" step="1000">

            <label>Phụ cấp</label>
            <input type="number" name="Phucap[<?= $row['ID'] ?>]"
                   value="<?= $row['Phucap'] ?>" step="1000">

            <label>Thuế TNCN</label>
            <input type="number" name="ThueTNCN[<?= $row['ID'] ?>]"
                   value="<?= $row['ThueTNCN'] ?>" step="1000">

            <label>Tổng lương</label>
            <input type="number" name="Tongluong[<?= $row['ID'] ?>]"
                   value="<?= $row['Tongluong'] ?>" step="1000">

        </div>
        <hr>
    <?php } ?>

    <button type="submit" class="btn-submit">💾 Cập nhật toàn bộ lương</button>
    </form>
    </div>

</div>
</body>
</html>
