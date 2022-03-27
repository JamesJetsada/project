<?php
session_start();
include("connect.php");
$id_shop ='';

if (isset( $_GET['id_shop']) && !empty($_GET['id_shop'])) {
    $id_shop = $_GET['id_shop'];
}else{
    $id_shop = $_SESSION['id_shop'];
}
// $_SESSION['id_shop'] = $_GET['id_shop'];


// $id_shop = $_SESSION['id_shop'];
// $_SESSION['id_shop'] = $id_shop

$res = mysqli_query($dbcon, "SELECT tb_product.name ,tb_product.img_url,tb_product.status,tb_product.price,(SELECT COUNT(*) FROM tb_product WHERE shop_id='$id_shop') as total FROM tb_product INNER JOIN tb_shop ON tb_product.shop_id=tb_shop.id_shop WHERE tb_product.shop_id= '$id_shop' AND tb_shop.id_shop ='$id_shop' AND tb_product.status = 1;");
$message = '';


// if (isset($_POST['add'])) {
//     $discount = $_POST['valdis'];
//     $discount_db = mysqli_query($dbcon, "SELECT * FROM discount WHERE code = '$discount' AND shop_id ='$id_shop'");
//     if (mysqli_num_rows($discount_db)) {
//         $message = 'พบส่วนลด';
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <link rel="StyleSheet" href="style/dashborad.css">
    <title>Product Page</title>
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
    <h1 style="text-align:center;">ร้านของคุณ</h1>
    <div style="text-align:right">
        <button class="button button1" onclick="on()">
            เปิด
        </button>
        <button class="button button2" onclick="off()">
            ปิด
        </button>
    </div>
 
    <table id="myTable" style="text-align:center;">
        <tr>
            <th>ชื่อสินค้า</th>
            <th>รูป</th>
            <th>ราคา</th>
            <th></th>
        </tr>
        <?php if ($res) {
            while ($show = mysqli_fetch_object($res)) {
                echo "<tr>";
                echo "<td><H2>$show->name</H2></td>";
                echo "<td><img src=" . $show->img_url . " alt=" . "Girl in a jacket" . " width=" . "200" . " height=" . "200" . "></td>";
                echo "<td><H1>$show->price</H1></td>";
                echo "<td>
                <a href='add.php?name=$show->name&img_url=$show->img_url&price=$show->price'>เพิ่มลงในตระกล้า</a>
                </td>";
                echo "</tr>";
            }
        } ?>
    </table>
</body>
<script>
    function on() {
        window.location.href = 'turnonstatus.php';
    }

    function off() {
        window.location.href = 'turnoffstatus.php';
    }

    function productpage() {
        window.location.href = 'product.php';

    }

    function add($name, $img_url, $price) {
        if (confirm("เพิ่มลงตระกล้า") == true) {

        }
    }

    function myFunction() {
        if (confirm("ต้องการออกจากระบบหรือไม่") == true) {
            window.location.href = 'logout.php';
        }
    }
</script>
<script>

</script>

</html>