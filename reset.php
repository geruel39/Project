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
            height: 600px;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            overflow-y: scroll;
            text-align: center;
        }

        .box::-webkit-scrollbar{
            width: 0;
            height: 0;
        }

        .box .row {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: flex;
            justify-content: center;
            font-size: 1.5rem;
        }

        .box .row .col-auto {
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
                <div class='col-auto'>{$row['Employee_ID']}</div>
                <div class='col-auto'>{$row['Via']}</div>
                <div class='col-auto'>
                    <form method='post' action='reset.php'>
                        <input type='hidden' name='id' value='{$row['Employee_ID']}'>
                        <button type='submit 'class='btn btn-danger' name='reset'>Reset</button> 
                        <button type='submit 'class='btn btn-dark' name='denied'>Denied</button>
                    </form>
                </div>
            </div>"; 
            
            if(isset($_POST["reset"])){
                $id = $_POST["id"];
                echo"<div style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color: white;padding:40px;box-shadow: 0px 0px 5px black'>
                    <h6>Are you sure to RESET?</h6>
                        <form method='post' action='reset.php'>
                            <input type='hidden' name='id2' value='$id'>
                            <button type='submit' class='btn btn-success' name='yes'>Yes</button>
                            <button type='submit' class='btn btn-danger' name='no'>No</button>
                        </form>
                    </div>";
            }

            if(isset($_POST['no'])){
                header("Location: reset.php");
            }
            else if (isset($_POST["yes"])){
                $id2 = $_POST["id2"];
                $pass = "tmz";
                $hash = password_hash($pass,PASSWORD_DEFAULT);
                mysqli_query($conn, "UPDATE accounts SET Password = '$hash' WHERE Employee_ID = '$id2'");
                mysqli_query($conn, "DELETE FROM password_reset WHERE Employee_ID = '$id2'");
                echo"<div style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color: white;padding:40px;box-shadow: 0px 0px 5px black;color:green;'>
                    <h6>Done!</h6>
                        <form method='post' action='reset.php'>
                            <button type='submit' class='btn btn-success' name='yes'>Close</button>
                        </form>
                    </div>";
            }


            if(isset($_POST["denied"])){
                $id = $_POST["id"];
                echo"<div style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color: white;padding:40px;box-shadow: 0px 0px 5px black'>
                    <h6>Are you sure to DENIED?</h6>
                        <form method='post' action='reset.php'>
                            <input type='hidden' name='id2' value='$id'>
                            <button type='submit' class='btn btn-success' name='yes'>Yes</button>
                            <button type='submit' class='btn btn-danger' name='no'>No</button>
                        </form>
                    </div>";
            }

            if(isset($_POST['no'])){
                header("Location: reset.php");
            }
            else if (isset($_POST["yes"])){
                $id2 = $_POST["id2"];
                mysqli_query($conn, "DELETE FROM password_reset WHERE Employee_ID = '$id2'");
                echo"<div style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color: white;padding:40px;box-shadow: 0px 0px 5px black;color:green;'>
                    <h6>Done!</h6>
                        <form method='post' action='reset.php'>
                            <button type='submit' class='btn btn-success' name='yes'>Close</button>
                        </form>
                    </div>";
            }
        }
        ?>
    </div>
</body>
</html>