<?php
// Kết nối CSDL
$conn = mysqli_connect("localhost", "root", "", "qlnhsu");
mysqli_set_charset($conn, "utf8");

// Lấy mã nhân viên từ URL
if (!isset($_GET['MaNV'])) {
    header("Location: wp_index.php");
    exit();
}

$MaNV = $_GET['MaNV'];

// Lấy thông tin nhân viên
$sql = "SELECT * FROM tbl_nhanvien WHERE MaNV = '$MaNV'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Không tìm thấy nhân viên";
    exit;
}

// Xử lý cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $HoTen       = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh    = $_POST['NgaySinh'];
    $DienThoai = $row['DienThoai']; // GIỮ SỐ CŨ

if (!empty($_POST['DienThoai'])) {
    $DienThoai = $_POST['DienThoai'];
}

    $HinhAnh = $row['HinhAnh'];
if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
    if (!empty($_FILES['HinhAnh']['name'])) {
        $tenAnh = time().'_'.$_FILES['HinhAnh']['name'];
        move_uploaded_file($_FILES['HinhAnh']['tmp_name'], "uploads/".$tenAnh);
        $HinhAnh = $tenAnh;
    }
}
    $sql_update = "UPDATE tbl_nhanvien SET
                HoTen = '$HoTen',
                GioiTinh = '$GioiTinh',
                NgaySinh = '$NgaySinh',
                DienThoai = '$DienThoai',
                HinhAnh = '$HinhAnh'
               WHERE MaNV = '$MaNV'";
  

    if (mysqli_query($conn, $sql_update)) {
        header("Location: wp_index.php");
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

    <form method="POST" enctype="multipart/form-data">
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
                <input type="radio" name="GioiTinh" value="1"
                <?= ($row['GioiTinh'] == 1) ? 'checked' : '' ?>> Nam

                <input type="radio" name="GioiTinh" value="0"
                <?= ($row['GioiTinh'] == 0) ? 'checked' : '' ?>> Nữ

            </div>
        </div>

        <div class="form-group">
            <label>Ngày sinh</label>
            <input type="date" name="NgaySinh" value="<?php echo $row['NgaySinh']; ?>">
        </div>
        <div class="form-group">
            <label>Số điện thoại</label>
            <input type="text" name="DienThoai" value="<?php echo $row['DienThoai']; ?>">
        </div>
        <div class="form-group">
            <label>Chức vụ</label>
            <input type="text" name="ChucVu" value="<?php echo $row['IDCV']; ?>">
        </div>
        <div class="form-group">
            <label>Phòng Ban</label>
            <input type="text" name="phong" value="<?php echo $row['IDPB']; ?>">
        </div>
        <input type="file" name="HinhAnh">
        <br>
        <img src="../nhanvien/uploads/<?= $row['HinhAnh'] ?>" width="80">
        <div class="form-actions">
            <button type="submit">Cập nhật</button>
            <a href="wp_index.php">Quay lại</a>
        </div>
    </form>
</div>

</body>
</html>
