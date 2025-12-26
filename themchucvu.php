<?php
include_once('connect.php');

if (isset($_POST['btnThem']))
{
    $id = $_POST['txtid'];
    $tencv = $_POST['txttencv'];
    

    $sql = "INSERT INTO tbl_chucvu VALUES ('$id','$tencv')";

    $ketqua = mysqli_query($conn, $sql);

    if ($ketqua)
    {
        header('location:chucvu.php');
    }
    else
    {
        echo "Thêm thất bại";
    }
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>Thêm phòng ban </title>
    <link rel="stylesheet" href="chucvu.css">
</head>
<div class="menu">
    <a href="chucvu.php"> Quản lý chức vụ </a>
</div>
<h2 class="tieude-form"> THÊM CHỨC VỤ </h2>
<form action="" method="post">

    <p> ID chức vụ </p>
    <input type="text" name="txtid">

    <p> Tên chức vụ </p>
    <input type="text" name="txttencv">

    <br></br>
    <input type="submit" name="btnThem" value="Thêm">
</form>
<br></br>
<div sylte="position: fixed; top: 10px; right: 10px; z-index: 999;">
<a href="trangchu.php" style="
    background-color: #2F4F4F;
    color: white;
    padding: 10px 18px;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    "> 🏠 Trang chủ </a>
</div>