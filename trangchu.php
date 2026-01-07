<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Quản Lý Nhân Sự</title>
</head>
<body>
<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="trangchu.php"><i class="fas fa-home"></i> <div class="title">Trang chủ</div></a></li>
            <li><a href="nhanvien.php"><i class="fas fa-user-tie"></i> <div class="title">Quản lý nhân viên</div></a></li>
            <li><a href="phongban.php"><i class="fas fa-cogs"></i> <div class="title">Phòng ban</div></a></li>
            <li><a href="luong.php"><i class="fas fa-money-bill-wave"></i> <div class="title">Lương và phụ cấp</div></a></li>
            <li><a href="baocao.php"><i class="fa fa-chart-bar"></i> <div class="title">Báo cáo và thống kê</div></a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <div class="title">Đăng xuất</div></a></li>
        </ul>
    </div>

    <!-- Main -->
    <div class="main">
        <div class="top-bar">
            <div class="search">
                <input type="text" id="searchInput" placeholder="Tìm kiếm..." onkeydown="searchEnter(event)">
                <i class="fas fa-search"></i>
                
            </div>

            <i class="far fa-bell"></i>
            <i class="fas fa-ellipsis-v"></i>
            <div class="user">
                <img src="OIP.jpg" alt="">
                <span><?php echo $_SESSION['username']; ?></span>
            </div>
        </div>

        <div class="cards">
            <div class="card">
                <div class="card-content">
                    <div class="number">67</div>
                    <div class="card-name">Nhân viên</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="number">10</div>
                    <div class="card-name">Phòng ban</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="number">45</div>
                    <div class="card-name">Đi làm hôm nay</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="number">5</div>
                    <div class="card-name">Nghỉ hôm nay</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-user-times"></i>
                </div>
            </div>
        </div>

        <!-- Thêm bảng nhân viên / chấm công nếu cần -->
        <div class="tables">
            <h2>Danh sách nhân viên gần đây</h2>
            <!-- Bảng nhân viên -->
            <table>
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Bộ phận</th>
                        <th>Chức vụ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nguyễn Văn A</td>
                        <td>Phòng Kinh Doanh</td>
                        <td>Nhân viên</td>
                        <td>
                            <i class="far fa-eye"></i>
                            <i class="far fa-edit"></i>
                            <i class="far fa-trash-alt"></i>
                        </td>
                    </tr>
                    <!-- Thêm dữ liệu khác -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
// Xử lý click menu
        document.querySelectorAll('.nav-menu li').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-menu li').forEach(li => {
                    li.classList.remove('active');
                });
                this.classList.add('active');
                
                // Thay đổi tiêu đề trang dựa trên menu được chọn
                const pageTitle = this.textContent;
                document.querySelector('.header h2').textContent = pageTitle;
                document.querySelector('.logo h1').textContent = pageTitle;
                
                console.log(`Đã chọn: ${pageTitle}`);
            });
        });
</script>
</body>
</html>
