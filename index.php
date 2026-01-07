<?php
session_start();
include "connect.php"; // nhúng kết nối database

$message = ""; // thông báo lỗi hoặc thành công

if (isset($_POST['dangnhap'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM tbl_taikhoan WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        header("Location: trangchu.php");
        exit; // dừng script ngay lập tức
        
    } else {
        $message = "Sai tên đăng nhập hoặc mật khẩu!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Form Đăng nhập</title>
</head>
<body>
<div id="wrapper">
    <form action="" method="POST" id="form-login">
        <h1 class="form-heading">Đăng Nhập</h1>

        <div class="form-group">
            <i class="fa-solid fa-user"></i>
            <input type="text" class="form-input" name="username" placeholder="Tên đăng nhập" required>
        </div>

        <div class="form-group">
            <i class="fa-solid fa-key"></i>
            <input type="password" class="form-input" name="password" placeholder="Mật khẩu" required>
            <i class="fa-solid fa-eye" id="eye"></i>
        </div>

        <input type="submit" name="dangnhap" value="Đăng nhập" class="form-submit">

        <?php if ($message): ?>
            <p style="color:red; text-align:center; margin-top:10px;"><?php echo $message; ?></p>
        <?php endif; ?>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="app.js"></script>
</body>
</html>
