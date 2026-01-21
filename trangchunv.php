<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'nhanvien') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Trang Nhân Viên</title>
</head>
<body>

<div class="container">

    <!-- SIDEBAR NHÂN VIÊN -->
    <div class="sidebar">
        <ul>
            <li>
                <a href="trangchunv.php">
                    <i class="fas fa-home"></i>
                    <div class="title">Trang chủ</div>
                </a>
            </li>

            <li>
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

    <!-- MAIN NHÂN VIÊN -->
     <!-- MAIN -->
<div class="main">
    <div class="top-bar">
        <div class="search">
            <input type="text" placeholder="Tìm kiếm...">
            <i class="fas fa-search"></i>
        </div>

        <div class="user">
            <img src="OIP.jpg" alt="">
            <span><?php echo $_SESSION['username']; ?></span>
        </div>
    </div>

    <h2 style="margin: 20px 20px 10px;">
        Xin chào, <?php echo $_SESSION['username']; ?> 👋
    </h2>

    <p style="margin-left: 20px; color: #555;">
        Chúc bạn một ngày làm việc hiệu quả!
    </p>

    <!-- NỘI DUNG -->
    <div class="cards">
        <div class="card">
            <div class="card-content">
                <div class="number">👋</div>
                <div class="card-name">Chào mừng bạn</div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="number">📄</div>
                <div class="card-name">Xem thông tin cá nhân</div>
            </div>
        </div>

      
    </div>
  <!-- KHU VỰC DƯỚI CARD -->
<div class="bottom-section">

    <!-- THÔNG BÁO -->
    <div class="notifications">
        <div class="notification-header">
            <h3>🔔 Thông báo</h3>
        </div>

        <ul class="notification-list">
            <li>
                <span class="dot blue"></span>
                <div class="text">
                    <strong>Chấm công</strong>
                    <p>Vui lòng chấm công đúng giờ.</p>
                </div>
                <span class="time">Hôm nay</span>
            </li>

            <li>
                <span class="dot green"></span>
                <div class="text">
                    <strong>Lương</strong>
                    <p>Lương tháng sẽ trả ngày 28.</p>
                </div>
                <span class="time">1 ngày trước</span>
            </li>
        </ul>
    </div>

    <!-- CÔNG VIỆC / LỊCH HÔM NAY -->
    <div class="today-work">
        <div class="work-header">
            <h3>📅 Công việc hôm nay</h3>
        </div>

        <ul class="work-list">
            <li>08:00 – Chấm công</li>
            <li>09:00 – Làm việc tại phòng</li>
            <li>14:00 – Họp phòng</li>
            <li>17:00 – Kết thúc ca</li>
        </ul>
    </div>

</div>

</div>

