<?php
include_once('connect.php');

$sql = "SELECT * FROM tbl_chucvu";

$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách phòng ban </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="chucvu.css">
    
</head>
<div class="menu">
    <a href= "nhanvien.php"> 🧑🏼‍💼 Quản lý nhân viên</a>
    <a href="phongban.php"> 🏢 Quản lý phòng ban </a>
    <a href="luong.php"> 💶 Quản lý lương</a>
    <a href="chamcong.php"> ✅ Quản lý chấm công</a>
    <a href="baocao.php"> 🗒️ Báo cáo thống kê</a>
</div>
<h2>DANH SÁCH CHỨC VỤ</h2> 

<form method ="post" id="formPhongBan">
    <table border="5" witdth="70%" align= "center" cellspacing="0" cellpadding="8">
        <tr>
                <th>Chọn</th>
                <th>ID</th>
                <th>Tên chức vụ<th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td>
            <input type="checkbox" name="ids[]" value="<?php echo $row['IDCV']; ?>">
        </td>
        <td><?php echo $row['IDCV']; ?></td>
        <td><?php echo $row['TenCV']; ?></td>
    </tr>
    <?php } ?>

    </table>
    <div class="menu" style="text-align: center; margin-top: 20px;">
    <a href="themchucvu.php" class="btn-them"> ➕ Thêm chức vụ </a>
        <a href ="suachucvu.php" class="btn-sua"> ✍️  Sửa chức vụ </a>
        <a href="xoachucvu.php" class="btn-xoa"> 🗑️ Xoá chức vụ </a>
    </div>
</form>
<br></br>

<br></br>
<div sylte="position: fixed; top: 10px; right: 10px; z-index: 999;">
    <a href="trangchu.php" style="
    background-color: #696969;
    color: white;
    padding: 10px 18px;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    "> 🏠 Trang chủ </a>
 
</div>
</body>
</html>
