<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db.php';

if (isset($_POST['submit'])) {
    $MaNV = $_POST['MaNV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $SoDienThoai = $_POST['DienThoai'];
    $PhongBan = $_POST['IDPB'];
    $ChucVu = $_POST['IDCV'];

    $sql = "INSERT INTO tbl_nhanvien 
            (MaNV, HoTen, GioiTinh, NgaySinh, DienThoai, IDPB, IDCV)
            VALUES 
            ('$MaNV', '$HoTen', '$GioiTinh', '$NgaySinh', '$SoDienThoai', '$PhongBan', '$ChucVu')";

    mysqli_query($conn, $sql);

    header("Location: wp_index.php");
}


if (isset($_POST['tennv'])) {

    $tennv = $_POST['tennv'];

    $anh = $_FILES['anh'];
    $tenAnh = time() . "_" . $anh['name'];

    $thuMuc = "C:\xampp\htdocs\nhanvien\anhNV";
    move_uploaded_file($anh['tmp_name'], $thuMuc . $tenAnh);

    $sql = "INSERT INTO tbl_nhanvien (HoTen, HinhAnh)
            VALUES ('$tennv', '$tenAnh')";
    mysqli_query($conn, $sql);

    header("Location: wp_index.php");
}


?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm nhân viên</title>
    <link rel="stylesheet" href="wp_style.css">
</head>
<body>

<div class="container">
    <h2 style="text-align: center">THÊM NHÂN VIÊN</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="tennv" placeholder="Tên nhân viên" required>

        <input type="file" name="anh" accept="image/*" required>

        <button type="submit">Thêm</button>
    </form>
    <form method="post">
        <label>Mã nhân viên</label>
        <input type="text" name="MaNV" required>

        <label>Họ tên</label>
        <input type="text" name="HoTen" required>

        <label>Giới tính</label>
        <select name="GioiTinh">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>

        <label>Ngày sinh</label>
        <input type="date" name="NgaySinh">

        <label>Số điện thoại</label>
        <input type="text" name="DienThoai">

        <label>Phòng ban</label>
        <input type="text" name="IBPB">

        <label>Chức vụ</label>
        <input type="text" name="IDCV">

        <button type="submit" name="submit" class="btn btn-add" style="margin-top: 10px">
            Lưu nhân viên
        </button>

        <a href="wp_index.php" class="btn btn-delete" style="margin-top: 10px">Quay lại</a>
    </form>
</div>

</body>
</html>
