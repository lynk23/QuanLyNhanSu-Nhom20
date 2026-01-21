<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'nhanvien') {
    header("Location: index.php");
    exit();
}

$manv = $_SESSION['MaNV'];

$sql = "SELECT * FROM tbl_nhanvien WHERE MaNV = '$manv'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Không tìm thấy thông tin nhân viên";
    exit();
}

$nv = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <ul>
            <li>
                <a href="nhanvien.php">
                    <i class="fas fa-home"></i>
                    <div class="title">Trang chủ</div>
                </a>
            </li>
            <li class="active">
                <a href="thongtincanhan.php">
                    <i class="fas fa-id-card"></i>
                    <div class="title">Thông tin cá nhân</div>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <div class="title">Đăng xuất</div>
                </a>
            </li>
        </ul>
    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- TOP BAR  -->
        <div class="top-bar">
            <div class="search">
                <input type="text" placeholder="Tìm kiếm...">
                <i class="fas fa-search"></i>
            </div>
            <div class="user">
                <img src="OIP.jpg" alt="">
                <span><?= $_SESSION['username'] ?></span>
            </div>
        </div>

        <!-- NỘI DUNG THÔNG TIN CÁ NHÂN -->
        <div class="profile-box">
            <h2>👤 Thông tin cá nhân</h2>

            <p><b>Họ tên:</b> <?= $nv['HoTen'] ?></p>
            <p><b>Ngày sinh:</b> <?= $nv['NgaySinh'] ?></p>
            <p><b>Giới tính:</b> <?= $nv['GioiTinh'] ?></p>
            <p><b>Điện thoại:</b> <?= $nv['DienThoai'] ?></p>
            <p><b>CCCD:</b> <?= $nv['CCCD'] ?></p>
            <p><b>Địa chỉ:</b> <?= $nv['DiaChi'] ?></p>
            <p><b>Phòng ban:</b> <?= $nv['IDPB'] ?></p>
        </div>

    </div>
</div>

</body>
</html>
