<!DOCTYPE html>
<html lang="en">

<script>
    function validateForm() {
        var name = document.forms["dataform"]["name"].value;
        var checkbox = document.forms["dataform"]["checkbox"].value;
        var radio = document.forms["dataform"]["radio"].value;
        var file = document.forms["dataform"]["file"].value;
        if (name == "" || checkbox == "" || radio == "" || file == "") {
            alert("กรุณากรอกข้อมูลให้ครบถ้วน");
            return false;
        }
    }
</script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Page</title>
</head>

<body>
    <form name="dataform" class="column" style="text-align:center" action="show.php" method="get" onsubmit="return validateForm() ">
        Name : <input type=" text" id="name" name="name" /><br>
        checkbox : <input type="checkbox" id="checkbox" name="checkbox" value="1" checked><br>
        radio : male <input type="radio" name="radio" checked value="male" />
        female <input type="radio" name="radio" value="female" /><br>
        file : <input type="file" name="file" id="imageinput" accept="image/png, image/gif, image/jpeg" onchange="showimage()" /><br>
        <button type=" submit">Save</button>
    </form>
    <!-- <img id="showimage" src="data:image/png;base64,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" alt="your image" /> -->
</body>
<script>
    function showimage() {
        console.log('aowdjhoiuwhdoiawhudih');
        let imageinput = document.querySelector("#imageinput");
        let imagepreview = document.querySelector("#showimage");
        const file = imageinput.file;
        if (file) {
            imagepreview.src = URL.createObjectURL(file);
        }
    }
</script>

</html>