<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "qlnhsu";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Lỗi kết nối: " . mysqli_connect_error());
}
