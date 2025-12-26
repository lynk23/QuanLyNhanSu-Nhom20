<?php
include 'ketnoi.php';

/*
  Đồng bộ trạng thái chấm công theo trạng thái nhân viên
*/

// Nhân viên đã nghỉ
mysqli_query(
    $conn,
    "UPDATE tbl_chamcong 
     SET trangthai = 'Đã nghỉ'
     WHERE manv IN (
        SELECT manv FROM tbl_nhanvien WHERE trangthai = 'Đã nghỉ'
     )"
);

// Nhân viên còn làm
mysqli_query(
    $conn,
    "UPDATE tbl_chamcong 
     SET trangthai = 'Đi làm'
     WHERE manv IN (
        SELECT manv FROM tbl_nhanvien WHERE trangthai = 'Còn làm'
     )"
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quản lý chấm công</title>
    <link rel="stylesheet" href="quanly.css">

<script>
function getSelectedIds() {
    let checkboxes = document.querySelectorAll('input[name="ids[]"]:checked');
    return Array.from(checkboxes).map(cb => cb.value);
}

function handleEdit() {
    const ids = getSelectedIds();
    if (ids.length === 0) {
        alert("Vui lòng chọn ít nhất 1 dòng để sửa.");
        return;
    }

    let form = document.createElement('form');
    form.method = 'POST';
    form.action = 'sua_bangcong.php';

    ids.forEach(id => {
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids[]';
        input.value = id;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

function handleDelete() {
    const ids = getSelectedIds();
    if (ids.length === 0) {
        alert("Vui lòng chọn ít nhất 1 dòng để xóa.");
        return;
    }

    if (!confirm("Bạn có chắc muốn xóa các dòng đã chọn?")) return;

    let form = document.createElement('form');
    form.method = 'POST';
    form.action = 'xoa_chamcong.php';

    ids.forEach(id => {
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids[]';
        input.value = id;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

window.onload = function () {
    document.querySelectorAll('input[name="ids[]"]').forEach(cb => {
        cb.addEventListener('change', function () {
            this.closest('tr').classList.toggle('selected', this.checked);
        });
    });
};
</script>
</head>

<body>

<div class="menu-chuyen">
    <a href="nhanvien.php">👨‍💼Quản lý nhân viên</a>
    <a href="phongban.php">👤Quản lý phòng ban</a>
    <a href="luong.php">💵Quản lý lương</a>
    <a href="luong.php">✅Quản lý chấm công</a>
    <a href="baocao.php">📆Báo cáo thống kê</a>
</div>

<h2>DANH SÁCH CHẤM CÔNG</h2>

<form method="post">
<table>
    <tr>
        <th>Chọn</th>
        <th>Mã NV</th>
        <th>Họ tên</th>
        <th>Ngày</th>
        <th>Trạng thái</th>
    </tr>

<?php
$sql = "SELECT macc, manv, hoten, ngay, trangthai
        FROM tbl_chamcong
        ORDER BY ngay DESC, macc DESC";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='ids[]' value='{$row['macc']}'></td>";
        echo "<td>{$row['manv']}</td>";
        echo "<td>{$row['hoten']}</td>";
        echo "<td>{$row['ngay']}</td>";
        echo "<td>{$row['trangthai']}</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Không có dữ liệu chấm công.</td></tr>";
}
?>
</table>

<div class="menu-ngang" style="text-align:center; margin-top:20px;">
    <a href="them_chamcong.php" class="btn-them">+ Thêm chấm công</a>
    <a href="javascript:void(0)" onclick="handleEdit()" class="btn-sua">✍️Sửa chấm công</a>
    <a href="javascript:void(0)" onclick="handleDelete()" class="btn-xoa">❎Xóa chấm công</a>
    <a href="tu_dong_cham_cong.php"
       class="btn-them"
       style="background-color:#ffcc00;color:black;">
        🕛Tự động chấm công hôm nay
    </a>
</div>
</form>

<div style="position: fixed; top: 10px; right: 10px; z-index: 999;">
    <a href="index.php" style="
        background:#0d6efd;
        color:white;
        padding:10px;
        text-decoration:none;
        border-radius:6px;
        font-weight:bold;
    ">🏠 Trang chủ</a>
</div>

</body>
</html>
