<!DOCTYPE html>
<html lang="en">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Page</title>
</head>

<body>
    <a id="btn">Getdata API</a>
    <a id="btn2" onclick="loadDoc()">Ajax Changetext</a>
    <p id="change">Change !!!!!!!!!!</p>
    <h1>
    </h1>
</body>

</html>
<script>
    function loadDoc() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("change").innerHTML =
                this.responseText;
        }
        xhttp.open("GET", "https://api.coindesk.com/v1/bpi/currentprice.json");
        xhttp.send();
    }
</script>
<script>
    $('#btn').click(() => {
        $.ajax({
            type: "GET",
            data: {
                // data: the_id
            },
            dataType: "json",
            url: "https://api.coindesk.com/v1/bpi/currentprice.json",
            success: function(data) {
                // console.log(data);
                // test = JSON.parse(this.data);
                // console.log(test);
                $("#demo").append(data);
            }
        });
    });
</script>