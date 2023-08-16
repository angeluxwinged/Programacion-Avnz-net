<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canvas</title>

    <style>
        canvas{
            background: rgb(255, 255, 255);
        }
    </style>
</head>

<body>
    <canvas id="myCanvas" width="500" height="500"> </canvas>

    <script>
    var canvas = document.getElementById('myCanvas');
    var ctx = canvas.getContext('2d');

        var seta = new Image();
        seta.src = "images/seta.png";
        ctx.drawImage(seta, 200, 200, 100, 100);

    </script>
</body>
</html>