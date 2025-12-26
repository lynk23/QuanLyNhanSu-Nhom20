<?php
session_start();
include 'connect.php';

/* Tự động thêm lương cho nhân viên chưa có */
$nhanvien_query = mysqli_query($conn, "SELECT manv FROM tbl_nhanvien");
while ($nv = mysqli_fetch_assoc($nhanvien_query)) {
    $nv_id = (int)$nv['manv'];
    $hoten = mysqli_real_escape_string($conn, $nv['hoten']);

    $kiemtra = mysqli_query(
        $conn,
        "SELECT id FROM tbl_luong WHERE manv = $nv_id"
    );

    if (mysqli_num_rows($kiemtra) == 0) {
        $luongcoban = 5000000;
        $thuetncn = 5000000;
        $tongluong = $luongcoban - $thuetncn;

        mysqli_query(
            $conn,
            "INSERT INTO tbl_luong (manv, hoten, luongcoban, phucap, thuetn)
             VALUES ($nv_id, '$hoten', $luongcoban, $thuetncn, $tongluong)"
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
    <style>
        tr.selected { background-color: #d4f4dd !important; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    </style>
</head>
<body>

<div class="menu-chuyen">
    <a href="nhanvien.php">👨‍💼Quản lý nhân viên</a>
    <a href="phongban.php">👤Quản lý phòng ban</a>
    <a href="luong.php">💵Quản lý lương</a>
    <a href="chamcong.php">✅Quản lý chấm công</a>
    <a href="baocao.php">📆Báo cáo thống kê</a>
    <?php if (!empty($_SESSION['msg'])) { ?>
    <div class="alert">
        <?= $_SESSION['msg'] ?>
    </div>
    <?php unset($_SESSION['msg']); } ?>
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
        <th>Tổng lương</th>
    </tr>

<?php
$sql = "
    SELECT 
        tbl_luong.id,
        tbl_luong.manv,
        tbl_luong.hoten,
        tbl_luong.luongcoban,
        tbl_luong.phucap,
        tbl_luong.thuetncn,
        tbl_luong.tongluong
    FROM tbl_luong
    LEFT JOIN tbl_nhanvien 
        ON tbl_luong.manv = tbl_nhanvien.manv
    WHERE tbl_luong.is_deleted = 0
    ORDER BY tbl_luong.id DESC
";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $tongluong = $row['luongcoban'] + $row['phucap'] - $row['thuetn'];
    ?>
    <tr>
        <td>
            <input type="checkbox" name="ids[]" value="<?= $row['id'] ?>">
        </td>
        <td><?= $row['manv'] ?></td>
        <td><?= $row['hoten'] ?></td>
        <td><?= number_format($row['luongcoban'], 0, ',', '.') ?></td>
        <td><?= number_format($row['thuetncn'], 0, ',', '.') ?></td>
        <td><?= number_format($row['tongluong'], 0, ',', '.') ?></td>
    </tr>
<?php } ?>
</table>

<div class="action">
    <button type="button" class="btn-edit" onclick="handleEdit()">✏️ Sửa</button>
    <button type="button" class="btn-delete" onclick="handleDelete()">🗑️ Xóa</button>
</div>

</form>

<div style="position: fixed; top: 10px; right: 10px;">
    <a href="index.php" style="
        background:#007bff;
        color:white;
        padding:10px 18px;
        text-decoration:none;
        border-radius:6px;
        font-weight:bold;
    ">🏠Trang chủ</a>
</div>

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
    form.action = 'sua_luong.php';

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

    if (!confirm("Bạn chắc chắn muốn xóa?")) return;

    let form = document.createElement('form');
    form.method = 'POST';
    form.action = 'xoa_luong.php';

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

/* Tô màu dòng được chọn */
document.querySelectorAll('input[name="ids[]"]').forEach(cb => {
    cb.addEventListener('change', function () {
        this.closest('tr').classList.toggle('selected', this.checked);
    });
});
</script>

</body>
</html>
