<?php
include "ketnoi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ids'])) {

    $ids = array_map('intval', $_POST['ids']);
    $ids_string = implode(',', $ids);

    // ❌ luong  →  ✅ tbl_luong
    $sql = "SELECT * FROM tbl_luong WHERE id IN ($ids_string)";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        header("Location: luong.php");
        exit();
    }

} else {
    header("Location: luong.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin lương</title>
    <link rel="stylesheet" href="luong.css">
</head>
<body>

<div class="menu">
    <a href="luong.php">📊 Quản lý lương</a>
</div>

<h2 class="tieude-form">SỬA LƯƠNG NHÂN VIÊN</h2>

<div class="form-container">
<form method="post" action="xuly_sua_luong.php">

<?php while ($row = mysqli_fetch_assoc($result)) { 
    $id = $row['id'];
?>
<div class="nhanvien-block">
    <strong>
        Nhân viên: (<?= $row['manv'] ?>) <?= $row['hoten'] ?>
    </strong><br><br>

    <input type="hidden" name="luong[<?= $id ?>][id]" value="<?= $id ?>">

    <label>Lương cơ bản:</label>
    <input type="text"
           class="money"
           data-hidden="luongcoban<?= $id ?>"
           value="<?= number_format($row['luongcoban'], 0, ',', '.') ?>"
           required>
    <input type="hidden"
           name="luong[<?= $id ?>][luongcoban]"
           id="luongcoban<?= $id ?>"
           value="<?= $row['luongcoban'] ?>">

    <label>Thuế TNCN:</label>
    <input type="text"
           class="money"
           data-hidden="thuetncn<?= $id ?>"
           value="<?= number_format($row['thuetncn'], 0, ',', '.') ?>"
           required>
    <input type="hidden"
           name="luong[<?= $id ?>][thuetncn]"
           id="thuetncn<?= $id ?>"
           value="<?= $row['thuetncn'] ?>">
</div>
<hr>
<?php } ?>

<input type="submit" value="Cập nhật tất cả">
</form>
</div>

<div style="position: fixed; top: 10px; right: 30px;">
    <a href="index.php" style="
        background:#007bff;
        color:white;
        padding:10px;
        text-decoration:none;
        font-weight:bold;
    ">Trang chủ</a>
</div>

<script>
/* Format tiền + đổ vào input hidden */
document.querySelectorAll('.money').forEach(input => {
    input.addEventListener('input', function () {
        let raw = this.value.replace(/\D/g, '');
        if (raw === '') raw = '0';

        this.value = raw.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        document.getElementById(this.dataset.hidden).value = raw;
    });
});
</script>

</body>
</html>
