<?php
include "connect.php";

function money($s) {
    return (int)str_replace(['.', ','], '', $s);
}

foreach ($_POST['luong'] as $l) {

    $id = (int)$l['id'];
    $luongcoban = money($l['luongcoban']);
    $phucap = money($l['phucap']);
    $thuetncn = money($l['thuetncn']);
    $tongluong = $luongcoban + $phucap - $thuetncn;

    mysqli_query($conn, "
        UPDATE tbl_luong SET
            luongcoban=$luongcoban,
            phucap=$phucap,
            thuetncn=$thuetncn,
            tongluong=$tongluong
        WHERE id=$id
    ");
}

header("Location: luong.php");
exit;
