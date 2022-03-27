<?php
session_start();
$id_shop = $_SESSION['id_user'];
include('connect.php');
$name = $_GET['name'];
$img_url= $_GET['img_url'];	
$price= $_GET['price'];
mysqli_query($dbcon, "INSERT INTO busket VALUE (NULL,'$name','$img_url','$price');");
echo "<script>window.location.href='product.php';</script>";
