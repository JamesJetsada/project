<?php

if (!isset($_SESSION)) {
    session_start();
}

include('connect.php');
$message = '';
$id_user = $_SESSION['id_user'];
$id_shop = $_SESSION['id_shop'];
$discount_conf = '';
if (isset($_SESSION['discount']) && !empty($_SESSION['discount'])) {
    $discount_conf = $_SESSION['discount'];
}
if (isset($_POST['deletecode'])) {
    unset($_SESSION['discount']);
    $discount_conf = '';
}

if ($discount_conf != '') {
    $res = mysqli_query($dbcon, "SELECT *,(SELECT SUM(price) as total FROM busket WHERE id_user= '$id_user') as total FROM busket WHERE id_user= '$id_user';");
    $dc = mysqli_query($dbcon, "SELECT SUM(price)*0.9 as total FROM busket WHERE id_user= '$id_user'");
    $pay = mysqli_query($dbcon, "SELECT (SUM(price)*0.9)*1.07 as total FROM busket WHERE id_user= '$id_user'");
    $test = mysqli_query($dbcon, "SELECT SUM(price) as total,(SELECT SUM(price)*0.9 as total FROM busket WHERE id_user= '$id_user') as total_dc FROM busket WHERE id_user= '$id_user'");
} else {
    $res = mysqli_query($dbcon, "SELECT *,(SELECT SUM(price) as total FROM busket WHERE id_user= '$id_user') as total FROM busket WHERE id_user= '$id_user';");
    $test = mysqli_query($dbcon, "SELECT SUM(price) as total FROM busket WHERE id_user= '$id_user'");
    $pay = mysqli_query($dbcon, "SELECT SUM(price)*1.07 as total FROM busket WHERE id_user= '$id_user'");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="StyleSheet" href="style/dashborad.css">
    <title>Sub Query</title>
</head>

<body>
    <div class="topnav">
        <div style="text-align:center;">
            <h1 style="color:#ddd"> สวัสดีคุณ <?php echo $_SESSION['username'] ?></h1>
        </div>
        <a href="dashboard.php">หน้าหลัก</a>
        <a class="active" href="subquery.php">ตระกล้าสินค้า</a>
        <a onclick="myFunction()">ออกจากระบบ</a>
    </div>
    <form action="discount.php" style="text-align:right" method="post">
        รหัสส่วนลด : <input type="text" name="valdis" id="valdis">
        <button class="button button2" id="code" type="submit" name="code" id="code">
            เช็คโค้ด
        </button>
    </form>
    <form action="" style="text-align:right" method="post">
        <button class="button button2" id="deletecode" type="submit" name="deletecode" id="deletecode">
            ลบโค้ด
        </button>
    </form>

    <div id="res" style="text-align:right">
        <?php
        if ($discount_conf != '') {
            echo $discount_conf;
        }
        ?>
    </div>
    <div>
        <h1>รายการสินค้าในตระกล้า</h1>
    </div>
    <table id="myTable" style="text-align:center;">
        <tr>
            <th>ชื่อสินค้า</th>
            <th>รูป</th>
            <th>ราคา</th>
        </tr>
        <?php
        if ($res) {
            while ($show = mysqli_fetch_object($res)) {
                echo "<tr>";
                echo "<td><H2>$show->name</H2></td>";
                echo "<td><img src=" . $show->img_url . " alt=" . "Girl in a jacket" . " width=" . "200" . " height=" . "200" . "></td>";
                echo "<td><H1>$show->price</H1></td>";
                echo "</tr>";
            }
        } ?>
    </table>
    <div>
        <?php if (isset($dc)) {
            while ($show = mysqli_fetch_object($test)) {
                echo "<h1>ราคารวม  $show->total บาท </h1>";
                echo "<h1>ราคาหลังหักส่วนลด 10%  $show->total_dc บาท </h1>";
            }
        } else {
            while ($show = mysqli_fetch_object($test)) {
                echo "<h1>ราคารวม  $show->total บาท </h1>";
            }
        }
        ?>
    </div>
    <div>
        <h1>
            ราคารวมสุทธิ (vat 7%) <?php while ($show = mysqli_fetch_object($pay)) {
                                        echo $show->total;
                                    } ?> บาท
        </h1>
    </div>

</body>
<script>
    function myFunction() {
        if (confirm("ต้องการออกจากระบบหรือไม่") == true) {
            window.location.href = 'logout.php';
        }
    }
</script>

</html>