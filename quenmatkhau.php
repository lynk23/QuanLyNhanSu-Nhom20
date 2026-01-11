<?php
if (session_id() == "") session_start();

include "connect.php";

$thongbao = "";

if (isset($_POST['doimatkhau'])) {
    $username = $_POST['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // 1. Kiểm tra mật khẩu mới nhập lại
    if ($new_password != $confirm_password) {
        $thongbao = "Mật khẩu mới không khớp!";
    } else {
        // 2. Kiểm tra username + mật khẩu cũ
        if (isset($_POST['doimatkhau'])) {
    $username = $_POST['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // 1. Kiểm tra mật khẩu mới nhập lại
    if ($new_password != $confirm_password) {
        $thongbao = "Mật khẩu mới không khớp!";
    } else {
        // 2. Kiểm tra username + mật khẩu cũ
        $sql = "SELECT * FROM tbl_taikhoan WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Nếu mật khẩu cũ dùng hash, dùng password_verify
            if (!password_verify($old_password, $row['password'])) {
                $thongbao = "Mật khẩu cũ không đúng!";
            } else {
                // 3. Kiểm tra mật khẩu mới có chữ hoa + chữ thường + >=6 ký tự
                $hasUpper = preg_match('/[A-Z]/', $new_password);
                $hasLower = preg_match('/[a-z]/', $new_password);
                $hasLength = strlen($new_password) >= 6;

                if (!$hasUpper || !$hasLower || !$hasLength) {
                    $thongbao = "Mật khẩu mới phải có ít nhất 1 chữ hoa, 1 chữ thường và ≥ 6 ký tự!";
                } else {
                    // 4. Hash mật khẩu mới trước khi lưu
                    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

                    $sql_update = "UPDATE tbl_taikhoan 
                                   SET password='$hashedPassword' 
                                   WHERE username='$username'";
                    mysqli_query($conn, $sql_update);

                    $thongbao = "Đổi mật khẩu thành công!";
                }
            }
        } else {
            $thongbao = "Tên đăng nhập không tồn tại!";
        }
    }
}

        if (mysqli_num_rows($result) == 1) {
            // 3. Cập nhật mật khẩu mới
            $sql_update = "UPDATE tbl_taikhoan 
                           SET password='$new_password' 
                           WHERE username='$username'";
            mysqli_query($conn, $sql_update);

            $thongbao = "Đổi mật khẩu thành công!";
        } else {
            $thongbao = "Tên đăng nhập hoặc mật khẩu cũ không đúng!";
        }
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
        <h1 class="form-heading">Quên Mật Khẩu</h1>

        <?php if($thongbao != "") { ?>
            <p style="color:red; text-align:center; margin-bottom:10px;">
        <?php echo $thongbao; ?>
        </p>
        <?php } ?>


        <div class="form-group">
            <input type="text" class="form-input" name="username" placeholder="Tên đăng nhập" required>
        </div>

        <div class="form-group">
            <input type="password" class="form-input" name="old_password" placeholder="Mật khẩu cũ" required>
        </div>

        <div class="form-group">
            <input type="password" class="form-input" name="new_password" placeholder="Mật khẩu mới" required>
             <i class="fa-solid fa-eye" id="eye"></i>
        </div>

        <div class="form-group">
            <input type="password" class="form-input" name="confirm_password" placeholder="Nhập lại mật khẩu mới" required>
        </div>

        <input type="submit" name="doimatkhau" value="Đổi mật khẩu" class="form-submit">

        <div class="form-back">
            <a href="index.php">← Quay lại đăng nhập</a>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="app.js"></script>
</body>
</html>
