<?php
include 'connect.php';

/* ===============================
   HEADER XUẤT EXCEL
================================ */
header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=baocaokhenthuongkyluat.csv");

/* Ghi BOM để Excel đọc tiếng Việt */
echo "\xEF\xBB\xBF";

/* ===============================
   MỞ OUTPUT
================================ */
$output = fopen("php://output", "w");

/* ===============================
   DÒNG TIÊU ĐỀ
================================ */
fputcsv($output, [
    "Ngày",
    "Mã nhân viên",
    "Tên nhân viên",
    "Bộ phận",
    "Nội dung",
    "Loại"
]);

/* ===============================
   LẤY DỮ LIỆU 
================================ */
$sql =
'SELECT
    kt.Ngay,
    kt.MaNV,
    nv.HoTen,
    bp.TenBP,
    kt.NoiDung,
    kt.Loai
FROM tbl_khenthuongkyluat kt
LEFT JOIN tbl_nhanvien nv ON kt.MaNV = nv.MaNV
LEFT JOIN tbl_bophan bp ON nv.IDBP = bp.IDBP
ORDER BY kt.Ngay ASC';

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Lỗi SQL: " . mysqli_error($conn));
}

$stt = 1;
while ($row = mysqli_fetch_assoc($result)) {

    fputcsv($output, [
        $stt++,
        $row['Ngay'],
        $row['MaNV'],
        $row['HoTen'],
        $row['TenBP'],
        $row['NoiDung'],
        $row['Loai']
    ]);
}

/* ===============================
   ĐÓNG FILE
================================ */
fclose($output);
exit;
?>

