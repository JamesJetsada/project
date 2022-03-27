<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show</title>
</head>

<body>
    <div class="colunm" style="text-align:center">
        <?php
        echo "name : " . $_GET['name'];
        ?>
        <br>
        <?php
        echo "checkbox : " . $_GET['checkbox'];
        ?> <br>
        <?php
        echo "radio : " . $_GET['radio'];
        ?> <br>
        <?php
        echo "file : " . $_GET['file'];
        ?> <br><a href="findmaxvalue.php">หาค่ามากสุด</a>
    </div>


</body>

</html>