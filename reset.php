<?php
    include("connection.php");

    $request_res = mysqli_query($conn, "SELECT * FROM password_reset");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
            background-color: #455370;
        }

        .box{
            width: 1000px;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .box .row {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: flex;
            justify-content: center;
            font-size: 2rem;
            padding: 100px;
        }

        .box .row .col-auto {
            margin-left: 50px;
            margin-right: 50px;
        }
    </style>
</head>
<body>
    <div style="position: fixed;top: 30px;left: 30px;color: white;">
        <button class="btn btn-danger"><a href="Manage.php" style="color: white;"> Back </a></button>
    </div>
    <div class="container box mt-5 p-5">
        <h1 class="text-center" style="color: white;">Request</h1><br>
        <?php
        while($row = mysqli_fetch_assoc($request_res)){
            echo"
            <div class='row p-3 mb-2 '>
                <div class='col-auto bord'>{$row['Employee_ID']}</div>
                <div class='col-auto bord'>{$row['Via']}</div>
                <div class='col-auto'><button class='btn btn-danger'>Reset</button></div>
            </div>";           
        }
        ?>
    </div>
</body>
</html>