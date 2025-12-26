<?php
include_once('connect.php');

/* LẤY DỮ LIỆU KHI LOAD FORM */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_phongban WHERE IDPB = '$id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
}

/* XỬ LÝ KHI BẤM NÚT SỬA */
if (isset($_POST['btnSua'])) {
    $id = $_POST['txtid'];
    $tenpb = $_POST['txttenpb'];

    $sql = "UPDATE tbl_phongban 
            SET TenPB = '$tenpb' 
            WHERE IDPB = '$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: phongban.php");
        exit();
    } else {
        echo "Sửa thất bại";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sửa phòng ban</title>
<link rel="stylesheet" href="phongban.css">
</head>

<div class="menu">
    <a href="phongban.php">Quản lý phòng ban</a>
</div>

<h2 class="tieude-form">SỬA PHÒNG BAN</h2>

<form action="" method="post">

    <p>ID phòng ban </p>
    <input type="text" name="txtid" value="<?php echo $row['IDPB']; ?>">

    <p>Tên phòng ban </p>
    <input type="text" name="txttenpb" value="<?php echo $row['TenPB']; ?>">

    <br><br>
    <input type="submit" name="btnSua" value="Sửa">
</form>

<br><br>

<div style="position: fixed; top: 10px; right: 10px; z-index: 999;">
    <a href="trangchu.php" style="
        background-color: #A52A2A;
        color: white;
        padding: 10px 18px;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    ">Trang chủ</a>
</div>

</html>
