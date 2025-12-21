
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include 'connect.php';

/* Tổng nhân viên */
$tongnv = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS tong FROM tbl_nhanvien")
)['tong'];

/* Thống kê giới tính */
$nam = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS sl FROM tbl_nhanvien WHERE GioiTinh = 0")
)['sl'];

$nu = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS sl FROM tbl_nhanvien WHERE GioiTinh = 1")
)['sl'];

/* Thống kê phòng ban */
$phongban = mysqli_query($conn,
    "SELECT IDPB, COUNT(*) AS soluong FROM tbl_nhanvien GROUP BY IDPB"
);

/* Thống kê bộ phận */
$bophan = mysqli_query($conn,
    "SELECT IDBP, COUNT(*) AS soluong FROM tbl_nhanvien GROUP BY IDBP"
);

/* Thống kê chức vụ */
$chucvu = mysqli_query($conn,
    "SELECT IDCV, COUNT(*) AS soluong FROM tbl_nhanvien GROUP BY IDCV"
);

/* Danh sách nhân viên */
$danhsach = mysqli_query($conn, "SELECT * FROM tbl_nhanvien");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Báo cáo thống kê nhân sự</title>
    <link rel="stylesheet" href="baocao.css">
</head>
<body>

<div class="container">
    <h1>BÁO CÁO THỐNG KÊ NHÂN SỰ</h1>

    <!-- Tổng quan -->
    <div class="summary">
        <div class="box">👥 Tổng nhân viên<br><b><?= $tongnv ?></b></div>
        <div class="box">👨 Nam<br><b><?= $nam ?></b></div>
        <div class="box">👩 Nữ<br><b><?= $nu ?></b></div>
    </div>
    
    <h2>Thống kê theo phòng ban</h2>
    <table>
        <tr>
            <th>ID Phòng ban</th>
            <th>Số nhân viên</th>
        </tr>
        <?php while ($pb = mysqli_fetch_assoc($phongban)) { ?>
        <tr>
            <td><?= $pb['IDPB'] ?></td>
            <td><?= $pb['soluong'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <h2>Thống kê theo bộ phận</h2>
    <table>
        <tr>
            <th>ID Bộ Phận</th>
            <th>Số nhân viên</th>
        </tr>
        <?php while ($bp = mysqli_fetch_assoc($bophan)) { ?>
        <tr>
            <td><?= $bp['IDBP'] ?></td>
            <td><?= $bp['soluong'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <h2>Thống kê theo chức vụ</h2>
    <table>
        <tr>
            <th>ID Chức vụ</th>
            <th>Số nhân viên</th>
        </tr>
        <?php while ($cv = mysqli_fetch_assoc($chucvu)) { ?>
        <tr>
            <td><?= $cv['IDCV'] ?></td>
            <td><?= $cv['soluong'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <h2>Danh sách nhân viên</h2>
    <table>
        <tr>
            <th>Mã NV</th>
            <th>Họ tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Điện thoại</th>
            <th>CCCD</th>
            <th>Địa chỉ</th>
            <th>Ảnh</th>
            <th>IDPB</th>
            <th>IDBP</th>
            <th>IDCV</th>
            <th>IDTD</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($danhsach)) { ?>
        <tr>
            <td><?= $row['MaNV'] ?></td>
            <td><?= $row['HoTen'] ?></td>
            <td><?= $row['GioiTinh']==0 ? 'Nam' : 'Nữ' ?></td>
            <td><?= $row['NgaySinh'] ?></td>
            <td><?= $row['DienThoai'] ?? 'NULL' ?></td>
            <td><?= $row['CCCD'] ?></td>
            <td><?= $row['DiaChi'] ?? 'NULL' ?></td>
            <td>
                <?php if ($row['HinhAnh']) { ?>
                    <img src="uploads/<?= $row['HinhAnh'] ?>">
                <?php } else { echo "Không có"; } ?>
            </td>
            <td><?= $row['IDPB'] ?></td>
            <td><?= $row['IDBP'] ?></td>
            <td><?= $row['IDCV'] ?></td> 
            <td><?= $row['IDTD'] ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
