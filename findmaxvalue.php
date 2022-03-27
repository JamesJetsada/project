<?php
$number = array(11, 28, 19, 49, 7);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หาค่ามากที่สุด</title>
</head>

<body>
    <div class="column" style="text-align: center;">
        ค่าใน Array : <?php
                        foreach ($number as $key => $value) {
                            echo "  $value" . "   ";
                        }
                        ?><br>
        ค่ามากที่สุดคือ <?php
                        echo max($number)
                        ?>
        <a href="ajax.php">ทดสอบ Ajax</a>
    </div>




</body>

</html>