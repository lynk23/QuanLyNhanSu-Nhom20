<?php
include 'connect.php';

$sql =
'SELECT
    kt.Ngay,
    kt.MaNV,
    nv.HoTen,
    bp.TenBP,
    kt.NoiDung,
    kt.Loai
FROM tbl_khenthuongkyluat kt
LEFT JOIN tbl_nhanvien nv ON kt.MaNV = nv.MaNV
LEFT JOIN tbl_bophan bp ON nv.IDBP = bp.IDBP
ORDER BY kt.Ngay ASC';

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Lỗi SQL: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Báo cáo khen thưởng - kỷ luật</title>
    <link rel="stylesheet" href="baocao.css">
</head>
<body>

    <div class="container">
        <h1>BÁO CÁO KHEN THƯỞNG & KỶ LUẬT</h1>

        <!-- BẢNG BÁO CÁO -->
        <table>
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Mã NV</th>
                    <th>Tên nhân viên</th>
                    <th>Bộ phận</th>
                    <th>Nội dung</th>
                    <th>Loại</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= date("m/d/Y", strtotime($row['Ngay'])) ?></td>
                        <td><?= str_pad($row['MaNV'], 2, "0", STR_PAD_LEFT) ?></td>
                        <td><?= $row['HoTen'] ?></td>
                        <td><?= $row['TenBP'] ?></td>
                        <td><?= $row['NoiDung'] ?></td>
                        <td>
                            <?php if ($row['Loai'] == 1) { ?>
                                <span class="thuong">Khen thưởng</span>
                            <?php } else { ?>
                                <span class="kyluat">Kỷ luật</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" class="empty">Không có dữ liệu</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- NÚT CHỨC NĂNG -->
        <div class="actions">
            <button onclick="location.reload();" class="btn refresh">
                🔄 Làm mới
            </button>
            <button onclick="window.print();" class="btn print">
                🖨️ In báo cáo
            </button>
        </div>
    </div>
</body>
</html>
