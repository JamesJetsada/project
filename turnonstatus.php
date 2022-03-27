<?php
session_start();

$id_shop = $_SESSION['id_shop'];
include('connect.php');
mysqli_query($dbcon, "UPDATE tb_product  SET status = '1' WHERE shop_id= '$id_shop'");
echo "<script>window.location.href='product.php';</script>";
?>