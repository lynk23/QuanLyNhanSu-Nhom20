<?php
include_once('connect.php');

/* Lấy ID phòng ban từ URL */
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tbl_phongban WHERE IDPB = '$id'";
    $ketqua = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($ketqua);
}

/* Xử lý khi bấm nút Xoá */
if (isset($_POST['btnXoa'])) {
    $id = $_POST['txtid'];

    $sql_xoa = "DELETE FROM tbl_phongban WHERE IDPB = '$id'";
    mysqli_query($conn, $sql_xoa);

    header("Location: phongban.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Xoá phòng ban</title>
<link rel="stylesheet" href="phongban.css">
</head>

<body>

<div class="menu">
    <a href="phongban.php">Quản lý phòng ban</a>
</div>

<h2 class="tieude-form">XOÁ PHÒNG BAN</h2>

<form method="post"
      onsubmit="return confirm('Bạn có chắc chắn muốn xoá phòng ban này không?');">

    <p>ID phòng ban</p>
    <input type="text" name="txtid"
           value="<?php echo $row['IDPB']; ?>">

    <p>Tên phòng ban</p>
    <input type="text"
           value="<?php echo $row['TenPB']; ?>">

    <br><br>
    <input type="submit" name="btnXoa" value="Xoá"
           style="background-color: #808000; color:white;">
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

</body>
</html>
