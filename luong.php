<?php
session_start();
include 'connect.php';

/* ===============================
   TỰ ĐỘNG THÊM LƯƠNG CHO NHÂN VIÊN
================================ */
$nhanvien_query = mysqli_query(
    $conn,
    "SELECT manv, hoten FROM tbl_nhanvien"
);

while ($nv = mysqli_fetch_assoc($nhanvien_query)) {

    $manv  = (int)$nv['manv'];
    $hoten = mysqli_real_escape_string($conn, $nv['hoten']);

    $kiemtra = mysqli_query(
        $conn,
        "SELECT ID FROM tbl_luong WHERE MaNV = $manv"
    );

    if (mysqli_num_rows($kiemtra) == 0) {

        $luongcoban = 5000000;
        $phucap     = 0;
        $thuetncn   = 500000;
        $tongluong  = $luongcoban + $phucap - $thuetncn;

        mysqli_query(
            $conn,
            "INSERT INTO tbl_luong (MaNV, Hoten, Luongcoban, Phucap, ThueTNCN)
             VALUES ($manv, '$hoten', $luongcoban, $phucap, $thuetncn)"
        );
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quản lý lương</title>
    <link rel="stylesheet" href="luong.css">
</head>
<body>

<div class="menu-chuyen">
    <a href="nhanvien.php">👨‍💼 Nhân viên</a>
    <a href="phongban.php">🏢 Phòng ban</a>
    <a href="luong.php">💵 Lương</a>
    <a href="chamcong.php">✅ Chấm công</a>
    <a href="baocao.php">📊 Báo cáo</a>
</div>

<h2>DANH SÁCH LƯƠNG NHÂN VIÊN</h2>

<form method="post">
<table>
    <tr>
        <th>Chọn</th>
        <th>Mã NV</th>
        <th>Họ tên</th>
        <th>Lương cơ bản</th>
        <th>Phụ cấp</th>
        <th>Thuế TNCN</th>
        <th>Thực nhận</th>
    </tr>

<?php
$sql = "
SELECT 
    ID,
    MaNV,
    Hoten,
    Luongcoban,
    Phucap,
    ThueTNCN
FROM tbl_luong
ORDER BY ID DESC
";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {

    $thucnhan = $row['Luongcoban'] + $row['Phucap'] - $row['ThueTNCN'];
    ?>
    <tr>
        <td>
            <input type="checkbox" name="ids[]" value="<?= $row['ID'] ?>">
        </td>
        <td><?= $row['MaNV'] ?></td>
        <td><?= $row['Hoten'] ?></td>
        <td><?= number_format($row['Luongcoban'], 0, ',', '.') ?></td>
        <td><?= number_format($row['Phucap'], 0, ',', '.') ?></td>
        <td><?= number_format($row['ThueTNCN'], 0, ',', '.') ?></td>
        <td><strong><?= number_format($thucnhan, 0, ',', '.') ?></strong></td>
    </tr>
<?php } ?>
</table>

<div class="action">
    <button type="button" onclick="handleEdit()">✏️ Sửa</button>
    <button type="button" onclick="handleDelete()">🗑️ Xóa</button>
</div>
</form>

<a href="index.php" class="home-btn">🏠 Trang chủ</a>

<script>
function getSelectedIds() {
    return Array.from(
        document.querySelectorAll('input[name="ids[]"]:checked')
    ).map(cb => cb.value);
}

function handleEdit() {
    const ids = getSelectedIds();
    if (ids.length === 0) {
        alert("Chọn ít nhất 1 dòng để sửa");
        return;
    }
    submitForm('sua_luong.php', ids);
}

function handleDelete() {
    const ids = getSelectedIds();
    if (ids.length === 0) {
        alert("Chọn ít nhất 1 dòng để xóa");
        return;
    }
    if (!confirm("Bạn chắc chắn muốn xóa?")) return;
    submitForm('xoa_luong.php', ids);
}

function submitForm(action, ids) {
    let form = document.createElement('form');
    form.method = 'POST';
    form.action = action;
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

/* highlight dòng */
document.querySelectorAll('input[name="ids[]"]').forEach(cb => {
    cb.addEventListener('change', function () {
        this.closest('tr').classList.toggle('selected', this.checked);
    });
});
</script>

</body>
</html>

