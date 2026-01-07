<?php
$keyword  = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$gioitinh = isset($_GET['gioitinh']) ? $_GET['gioitinh'] : '';

include 'connect.php';

$where = "1=1";

if (!empty($_GET['keyword'])) {
    $kw = $_GET['keyword'];
    $where .= " AND HoTen LIKE '%$kw%'";
}

if (!empty($_GET['gioitinh'])) {
    $gt = $_GET['gioitinh'];
    $where .= " AND GioiTinh='$gt'";
}

$sql = "SELECT * FROM tbl_nhanvien WHERE $where";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="nhanvien.css">
<title>Quản lý nhân sự</title>
</head>
<body>

<h2 style="text-align: center">DANH SÁCH NHÂN VIÊN</h2>

<form method="GET" class="search-box">
    <input type="text" name="keyword"
           placeholder="Nhập mã NV hoặc họ tên"
           value="<?php echo $keyword; ?>">

    <select name="gioitinh">
        <option value="">-- Giới tính --</option>
        <option value="Nam" <?php if($gioitinh=="Nam") echo "selected"; ?>>Nam</option>
        <option value="Nữ" <?php if($gioitinh=="Nữ") echo "selected"; ?>>Nữ</option>
    </select>

    <button type="submit">Tìm kiếm</button>
    <a href="nhanvien.php">Làm mới</a>
</form>
<div class="top-actions">
    <a href="add.php" class="btn-add">Thêm nhân viên</a>
</div>

<table>
<tr>
    <th>Mã NV</th>
    <th>Họ tên</th>
    <th>Ảnh</th>
    <th>Giới tính</th>
    <th>Chức vụ</th>
    <th>Phòng</th>
    <th>Số điện thoại</th>
    <th>Hành động</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['MaNV'] ?></td>
    <td><?= $row['HoTen'] ?></td>
    <td><img src="images/<?= $row['HinhAnh'] ?>"></td>
    <td><?= $row['GioiTinh'] ?></td>
    <td><?= $row['IDCV'] ?></td>
    <td><?= $row['IDPB'] ?></td>
    <td><?= $row['DienThoai'] ?></td>
    <td>
        <a href="edit.php?MaNV=<?php echo $row['MaNV'] ?>">✏️</a>
        <a href="delete.php?id=<?= $row['MaNV'] ?>"
           onclick="return confirm('Bạn có chắc muốn xóa?')">🗑</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
