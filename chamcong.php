
<?php
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý chấm công</title>
    <link rel="stylesheet" href="chamcong.css">
</head>
<body>

<div class="chamcong-page">

    <!-- MENU -->
    <div class="menu-chuyen">
        <a href="nhanvien.php">👨‍💼 Quản lý nhân viên</a>
        <a href="phongban.php">🏢 Quản lý phòng ban</a>
        <a href="luong.php">💰 Quản lý lương</a>
        <a href="chamcong.php">✅ Quản lý chấm công</a>
        <a href="baocao.php">📆 Báo cáo thống kê</a>
    </div>

    <h2>DANH SÁCH CHẤM CÔNG</h2>

    <!-- THÔNG BÁO -->
    <?php if (!empty($_SESSION['msg'])) { ?>
        <div class="alert">
            <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
        </div>
    <?php } ?>

    <form method="post">

    <div class="table-wrap">
    <table>
        <tr>
            <th>Chọn</th>
            <th>Mã CC</th>
            <th>Mã NV</th>
            <th>Họ tên</th>
            <th>Ngày</th>
            <th>Trạng thái</th>
        </tr>

    <?php
    /* ===============================
    HIỂN THỊ CHẤM CÔNG + ĐÃ XÓA
    ================================ */
    $sql = "
    SELECT cc.MaCC,
        nv.MaNV,
        nv.HoTen,
        cc.Ngay,
        cc.TrangThai,
        IFNULL(cc.is_deleted,0) AS is_deleted
    FROM tbl_nhanvien nv
    LEFT JOIN tbl_chamcong cc
        ON nv.MaNV = cc.MaNV
    ORDER BY cc.Ngay DESC, nv.MaNV
    ";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr<?php if($row['is_deleted']==1) echo " style='background:#f8d7da;'"; ?>>

        <!-- CHECKBOX -->
        <td>
            <?php if (!empty($row['MaCC'])) { ?>
                <input type="checkbox" name="maccs[]" value="<?= $row['MaCC'] ?>">
            <?php } else { ?>
                —
            <?php } ?>
        </td>

        <td><?= $row['MaCC'] ?? '—' ?></td>
        <td><?= htmlspecialchars($row['MaNV']) ?></td>
        <td><?= htmlspecialchars($row['HoTen']) ?></td>
        <td><?= $row['Ngay'] ?? '—' ?></td>
        <td>
            <?php
            if (empty($row['MaCC'])) {
                echo '—';
            } elseif ($row['is_deleted'] == 1) {
                echo '<span style="color:red;font-weight:bold">🗑️ Đã xóa</span>';
            } else {
                echo '<span style="color:limegreen;font-weight:bold">✔ ' . htmlspecialchars($row['TrangThai']) . '</span>';
            }
            ?>
        </td>

    </tr>
    <?php } ?>

    </table>
    </div>

    <!-- ACTION -->
    <div class="action">
        <button type="submit" formaction="them_chamcong.php">
            ➕ Thêm / Cập nhật chấm công
        </button>

        <button type="submit" formaction="sua_chamcong.php">
            ✏️ Sửa
        </button>

        <button type="submit"
                formaction="xoa_chamcong.php">
            🗑️ Xóa
        </button>

        <button type="submit" formaction="khoi_phuc_chamcong.php">
            ♻️ Khôi phục
        </button>

        <button type="submit" formaction="tudong_chamcong.php">
            🕛 Tự động chấm công
        </button>

        <button type="submit" formaction="xoa_vinhvien_chamcong.php" class="danger"
                onclick="return confirm('⚠️ Xóa vĩnh viễn chấm công! Không thể khôi phục. Bạn chắc chắn?')">
            ❌ Xóa vĩnh viễn
        </button>

    </div>

    </form>

    <a href="index.php" class="home-btn">🏠 Trang chủ</a>

</div>
</body>
</html>
