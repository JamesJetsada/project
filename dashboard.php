<?php
session_start();
include("connect.php");
if (!isset($_SESSION['IS_LOGIN'])) {
    echo "<script>window.location.href='login.php';</script>";
} else {
    $iduser = $_SESSION['id_user'];
    $res = mysqli_query($dbcon, "SELECT * FROM tb_shop WHERE id_user = $iduser");
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="StyleSheet" href="style/dashborad.css">
        <title>Dashboard</title>
    </head>

    <body>
        <div class="topnav">
            <div style="text-align:center;">
                <h1 style="color:#ddd"> สวัสดีคุณ <?php echo $_SESSION['username'] ?></h1>
            </div>
            <a class="active" href="dashboard.php">หน้าหลัก</a>
            <a href="subquery.php">ตระกล้าสินค้า</a>
            <a onclick="myFunction()">ออกจากระบบ</a>
        </div>
        <h1 style="text-align:center;">ร้าน</h1>
        <?php if ($res) {
            while ($show = mysqli_fetch_object($res)) {
                echo "<a href='product.php?id_shop=$show->id_shop'>ร้าน $show->name</a>";
            }
        } ?>



    </body>
    <script>
        function myFunction() {
            if (confirm("ต้องการออกจากระบบหรือไม่") == true) {
                window.location.href = 'logout.php';
            }
        }
    </script>

    </html>


<?php
}
?>