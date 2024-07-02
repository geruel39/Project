<?php
    include("connection.php");
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
            background-color: #006769;
        }

        .box{
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            padding: 100px;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 1.2rem;
            font-weight: 700;
        }
        input{
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3); 
        }
    </style>
</head>
<body>
    <div style="position: fixed;top: 30px;left: 30px;color: white;">
        <button class="btn btn-danger"><a href="LogIn.php" style="color: white;"> Back </a></button>
    </div>
    <div class="box">
        <h1>Request Password Reset</h1><br>
        <form action="request.php" method="post">
            Employee ID: <input type="text" name="id" class="form-control form-control-lg"><br>
            Receive Reply: <input type="text" name="via" class="form-control form-control-lg">
            <span class="form-text">Enter any contact info (Phone number, Email, etc...)</span><br><br>
            <center><input type="submit" name="submit" value="Request" class="btn btn-primary btn-lg"></center>
        </form><br>
        <center style="color:red;">
        <?php
    if(isset($_POST["submit"])){
        if(empty($_POST["id"])){
            echo"Enter the Employee ID";
        }else if(empty($_POST["via"])){
            echo"Enter contact info";
        }else{
            $id = $_POST["id"];
            $via = $_POST["via"];
            $acc_res = mysqli_query($conn, "SELECT * FROM accounts WHERE Employee_ID = '$id'");
            $accnum = mysqli_num_rows($acc_res);

            if($accnum == 0){
                echo"Employee ID doesn't exist";
            }
            else{
                mysqli_query($conn, "INSERT INTO password_reset (Employee_ID,Via) VALUES ('$id','$via')");
                echo"Request has been made!";
            }
        }
    }
?>
        </center>
    </div>
</body>
</html>