<?php
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý lương</title>
    <link rel="stylesheet" href="luong.css">
</head>
<body>

<div class="luong-page">
    <!-- MENU -->
    <div class="menu-chuyen">
        <a href="nhanvien.php">👨‍💼 Quản lý nhân viên</a>
        <a href="phongban.php">🏢 Quản lý phòng ban</a>
        <a href="luong.php">💰 Quản lý lương</a>
        <a href="chamcong.php">✅ Quản lý chấm công</a>
        <a href="baocao.php">📆Báo cáo thống kê</a>
    </div>

    <h2>DANH SÁCH LƯƠNG NHÂN VIÊN</h2>

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
            <th>Mã NV</th>
            <th>Họ tên</th>
            <th>Lương cơ bản</th>
            <th>Phụ cấp</th>
            <th>Thuế TNCN</th>
            <th>Thực nhận</th>
            <th>Trạng thái</th>
        </tr>

    <?php
    /* ===============================
    JOIN ĐÚNG – KHÔNG LỌC is_deleted
    ================================ */
    $sql = "
    SELECT
        nv.MaNV                    AS manv,
        nv.HoTen                   AS hoten,
        l.id                       AS id,
        IFNULL(l.Luongcoban, 0)    AS luongcoban,
        IFNULL(l.Phucap, 0)        AS phucap,
        IFNULL(l.ThueTNCN, 0)      AS thuetncn,
        IFNULL(l.Tongluong, 0)     AS tongluong,
        IFNULL(l.is_deleted, 0)    AS is_deleted
    FROM tbl_nhanvien nv
    LEFT JOIN tbl_luong l
        ON nv.MaNV = l.MaNV
    ORDER BY nv.MaNV
    ";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>

        <!-- CHECKBOX -->
        <td>
            <?php if (!empty($row['id'])) { ?>
                <input type="checkbox" name="manvs[]" value="<?= $row['manv'] ?>">
            <?php } else { ?>
                —
            <?php } ?>
        </td>

        <td><?= htmlspecialchars($row['manv']) ?></td>
        <td><?= htmlspecialchars($row['hoten']) ?></td>

        <td><?= number_format($row['luongcoban'], 0, ',', '.') ?></td>
        <td><?= number_format($row['phucap'], 0, ',', '.') ?></td>
        <td><?= number_format($row['thuetncn'], 0, ',', '.') ?></td>
        <td><strong><?= number_format($row['tongluong'], 0, ',', '.') ?></strong></td>

        <!-- TRẠNG THÁI -->
        <td>
            <?php
            if (empty($row['id'])) {
                echo '—';
            } elseif ($row['is_deleted'] == 1) {
                echo '<span style="color:red;font-weight:bold">🗑️ Đã xóa</span>';
            } else {
                echo '<span style="color:limegreen;font-weight:bold">✔ Hoạt động</span>';
            }
            ?>
        </td>

    </tr>
    <?php } ?>

    </table>
    </div>

   <!-- ACTION -->
    <div class="action">
        <button type="submit" formaction="them_luong.php">
            ➕ Thêm / Cập nhật lương
        </button>

        <button type="submit" formaction="sua_luong.php">
            ✏️ Sửa
        </button>

        <button type="submit"
                formaction="xoa_luong.php"
                onclick="return confirm('Xóa tạm thời các dòng đã chọn?')">
            🗑️ Xóa
        </button>

        <button type="submit" formaction="khoi_phuc_luong.php">
            ♻️ Khôi phục
        </button>

        <!-- ✅ NÚT XÓA VĨNH VIỄN -->
        <button type="submit"
                formaction="xoa_vinhvien_luong.php"
                class="danger"
                onclick="return confirm('⚠️ Xóa vĩnh viễn! Không thể khôi phục. Bạn chắc chắn?')">
            ❌ Xóa vĩnh viễn
        </button>

        <button type="submit" formaction="xuat_excel_luong.php">
            📥 Xuất Excel
        </button>

        <button type="submit" formaction="tudong_tinh_luong.php">
            🧮 Tự động tính lương
        </button>

    </div>

    </form>

    <a href="index.php" class="home-btn">🏠 Trang chủ</a>
</div>
</body>
</html>