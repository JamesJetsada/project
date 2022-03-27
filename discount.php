<?php
if (!isset($_SESSION)) {
    session_start();
}
include('connect.php');
$message = '';
$id_shop = $_SESSION['id_user'];
if (isset($_POST['code'])) {
    $discount = $_POST['valdis'];
    $discount_db = mysqli_query($dbcon, "SELECT * FROM discount WHERE code = '$discount' AND shop_id ='$id_shop'");
    if (mysqli_num_rows($discount_db)) {
        $message = 'ใช้ส่วนลดแล้ว';
        $_SESSION['discount'] = $message;
    }
}
echo "<script>window.location.href='subquery.php';</script>";
?>
