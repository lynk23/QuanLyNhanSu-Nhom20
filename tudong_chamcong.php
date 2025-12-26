<?php
include "ketnoi.php";

/* =========================
   1. LẤY NGÀY HÔM NAY
========================= */
$ngay = date('Y-m-d');

/* =========================
   2. LẤY DANH SÁCH NHÂN VIÊN
========================= */
$sql_nv = "SELECT manv, hoten FROM tbl_nhanvien";
$result_nv = mysqli_query($conn, $sql_nv);

$inserted = 0;

/* =========================
   3. DUYỆT TỪNG NHÂN VIÊN
========================= */
while ($nv = mysqli_fetch_assoc($result_nv)) {

    $manv  = $nv['manv'];
    $hoten = $nv['hoten'];

    // Kiểm tra đã chấm công hôm nay chưa
    $sql_check = "SELECT 1 
                  FROM tbl_chamcong 
                  WHERE manv = '$manv' AND ngay = '$ngay'";
    $check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($check) == 0) {

        // Chưa có → thêm mới
        $sql_insert = "INSERT INTO tbl_chamcong (manv, hoten, ngay, trangthai)
                       VALUES ('$manv', '$hoten', '$ngay', 'Đi làm')";

        mysqli_query($conn, $sql_insert);
        $inserted++;
    }
}

/* =========================
   4. THÔNG BÁO + CHUYỂN HƯỚNG
========================= */
echo "<script>
    alert('Đã tự động chấm công $inserted nhân viên cho ngày $ngay');
    window.location.href = 'chamcong.php';
</script>";
?>