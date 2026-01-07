<?php
include "connect.php";

/* ===============================
   HEADER XUẤT EXCEL
================================ */
header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=bang_luong.csv");

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
    "STT",
    "Mã nhân viên",
    "Họ tên",
    "Lương cơ bản",
    "Phụ cấp",
    "Thuế TNCN",
    "Tổng lương"
]);

/* ===============================
   LẤY DỮ LIỆU LƯƠNG
================================ */
$sql = "
    SELECT 
        manv,
        hoten,
        luongcoban,
        phucap,
        thuetncn,
        tongluong
    FROM tbl_luong
    WHERE is_deleted = 0
    ORDER BY manv
";

$result = mysqli_query($conn, $sql);

$stt = 1;
while ($row = mysqli_fetch_assoc($result)) {

    fputcsv($output, [
        $stt++,
        $row['manv'],
        $row['hoten'],
        $row['luongcoban'],
        $row['phucap'],
        $row['thuetncn'],
        $row['tongluong']
    ]);
}

/* ===============================
   ĐÓNG FILE
================================ */
fclose($output);
exit;
