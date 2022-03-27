<?php
session_start();
include('connect.php');
$msg = '';

if (isset($_POST['submit'])) {
    $time = time() - 30;
    $ip_address = getIp();

    $query = mysqli_query($dbcon, "SELECT count(*) as total_count FROM loginlogs WHERE Trytime AND ipAddress='$ip_address'");
    $check_login_row = mysqli_fetch_assoc($query);
    $total_count = $check_login_row['total_count'];

    if ($total_count == 5) {
        $msg = "ล็อกอินผิดครบ 5 ครั้งกรุณารอ 30 วินาที";
    } else {
        $username = mysqli_real_escape_string($dbcon, $_POST['username']);
        $password = mysqli_real_escape_string($dbcon, $_POST['password']);
        $res = mysqli_query($dbcon, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        if (mysqli_num_rows($res)) {
            while ($show = mysqli_fetch_array($res)) {
                $_SESSION['id_user'] = $show[0];
            }
            $msg = '';
            $_SESSION['IS_LOGIN'] = 'yes';
            $_SESSION['username'] = $username;
            mysqli_query($dbcon, "DELETE FROM loginlogs WHERE ipAddress = '$ip_address'");
            echo "<script>window.location.href='dashboard.php';</script>";
        } else {
            $total_count++;
            $rem_attm = 5 - $total_count;
            if ($rem_attm == 0) {
                $msg = "ล็อกอินผิดครบ 5 ครั้งกรุณารอ 30 วินาที";
            } else {
                $msg = "รหัสผ่านหรือชื่อผู้ใช้ไม่ถูกต้อง สามารถผิดได้อีก : $rem_attm ครั้ง";
            }
            $try_time = time();
            mysqli_query($dbcon, "INSERT INTO loginlogs(ipAddress,Trytime) VALUE('$ip_address','$try_time')");
        }
    }
}
function getIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARD_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARD_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="StyleSheet" href="style/mystyle.css">
    <title>Login Page</title>
</head>
<script>

</script>

<body>
    <div class="formlogin" id="fromlogin">
        <form action="" style="text-align:center" method="post">
            <H1 style="color:black"> Login </H1><br>
            <h3 style="color:black">Username</h3> <input style="color:black" type="text" name="username" id="username"><br><br>
            <h3 style="color:black">Password</h3> <input style="color:black" type="password" name="password" id="password"><br><br>
            <button  style="color:black" type="submit" name="submit" id="submit">Login</button>
        </form>
        <br>
        <div id="res" style="color:black">
            <?php
            if ($msg != '') {
                echo $msg;
            }
            ?>
        </div>

    </div>

</body>

</html>