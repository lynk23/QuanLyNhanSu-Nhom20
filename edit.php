<?php
// Kết nối CSDL
$conn = mysqli_connect("localhost", "root", "", "quanlynhansu");
mysqli_set_charset($conn, "utf8");

// Lấy mã nhân viên từ URL
if (!isset($_GET['MaNV'])) {
    header("Location: trangchu.php");
    exit();
}

$MaNV = $_GET['MaNV'];

// Lấy thông tin nhân viên
$sql = "SELECT * FROM tbl_nhanvien WHERE MaNV = '$MaNV'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Nhân viên không tồn tại";
    exit();
}

$row = mysqli_fetch_assoc($result);

// Xử lý cập nhật
if (isset($_POST['btnUpdate'])) {
    $HoTen       = $_POST['HoTen'];
    $GioiTinh    = $_POST['GioiTinh'];
    $NgaySinh    = $_POST['NgaySinh'];
    $SoDienThoai = $_POST['SoDienThoai'];

    $update = "UPDATE tbl_nhanvien SET
                HoTen = '$HoTen',
                GioiTinh = '$GioiTinh',
                NgaySinh = '$NgaySinh',
                SoDienThoai = '$SoDienThoai'
               WHERE MaNV = '$MaNV'";

    if (mysqli_query($conn, $update)) {
        header("Location: trangchu.php");
        exit();
    } else {
        echo "Lỗi cập nhật!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa nhân viên</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
        }
        .form-container {
            width: 450px;
            margin: 50px auto;
            background: #fff;
            padding: 25px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
        }
        .gender-group {
            display: flex;
            gap: 20px;
        }
        .form-actions {
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 8px 20px;
            background: #ffc107;
            border: none;
            cursor: pointer;
        }
        a {
            margin-left: 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Cập nhật nhân viên</h2>

    <form method="POST">
        <div class="form-group">
            <label>Mã nhân viên</label>
            <input type="text" value="<?php echo $row['MaNV']; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Họ tên</label>
            <input type="text" name="HoTen" value="<?php echo $row['HoTen']; ?>" required>
        </div>

        <div class="form-group">
            <label>Giới tính</label>
            <div class="gender-group">
                <label>
                    <input type="radio" name="GioiTinh" value="Nam"
                    <?php if ($row['GioiTinh'] == 'Nam') echo "checked"; ?>> Nam
                </label>
                <label>
                    <input type="radio" name="GioiTinh" value="Nữ"
                    <?php if ($row['GioiTinh'] == 'Nữ') echo "checked"; ?>> Nữ
                </label>
            </div>
        </div>

        <div class="form-group">
            <label>Ngày sinh</label>
            <input type="date" name="NgaySinh" value="<?php echo $row['NgaySinh']; ?>">
        </div>
        <div class="form-group">
            <label>Số điện thoại</label>
            <input type="text" name="SoDienThoai" value="<?php echo $row['DienThoai']; ?>">
        </div>
        <div class="form-group">
            <label>Chức vụ</label>
            <input type="text" name="ChucVu" value="<?php echo $row['IDCV']; ?>">
        </div>
        <div class="form-group">
            <label>Phòng Ban</label>
            <input type="text" name="phong" value="<?php echo $row['IDPB']; ?>">
        </div>
        <div class="form-actions">
            <button type="submit" name="btnUpdate">Cập nhật</button>
            <a href="trangchu.php">Quay lại</a>
        </div>
    </form>
</div>

</body>
</html>
