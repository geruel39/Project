<?php
    include("connection.php");

    $archive_result = mysqli_query($conn, "SELECT * FROM archive");
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

        .container {
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .box{
            height: 400px;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        ul{
            list-style-type: none;
        }

        li{
            margin-bottom: 5px;
            font-weight: 600;
        }

        span{
            color: white;
        }
    </style>
</head>
<body>
    <div style="position: fixed;top: 30px;left: 30px;color: white;">
        <button class="btn btn-danger"><a href="Manage.php" style="color: white;"> Back </a></button>
    </div>
    <div class="container mt-3">
        <div class="row text-center"><h1 style="color:white">Archive</h1></div>
        <div class="row">
            <?php

            while($row = mysqli_fetch_assoc($archive_result)){
                echo"
                    <div class='col-3 mt-3'>
                        <div class='box p-3'>
                            <ul>
                                <li>Employee ID: <span>{$row['Employee_ID']}</span></li>
                                <li>Firstname: <span>{$row['Firstname']}</span></li>
                                <li>Lastname: <span>{$row['Lastname']}</span></li>
                                <li>Contact: <span>{$row['Contact']}</span></li>
                                <li>Email: <span>{$row['Email']}</span></li>
                                <li>Address: <span>{$row['Address']}</span></li>
                                <li>Birthday: <span>{$row['Birthday']}</span></li>
                                <li>Gender: <span>{$row['Gender']}</span></li>
                                <li>Country: <span>{$row['Country']}</span></li>
                                <li>Language: <span>{$row['Language']}</span></li>
                            </ul>
                            <div class='row text-end'>
                                <form action='archive.php' method='post'>
                                    <input type='hidden' name='emp' value='{$row['Employee_ID']}'>
                                    <input type='hidden' name='emp1' value='{$row['Firstname']}'>
                                    <input type='hidden' name='emp2' value='{$row['Lastname']}'>
                                    <input type='hidden' name='emp3' value='{$row['Contact']}'>
                                    <input type='hidden' name='emp4' value='{$row['Email']}'>
                                    <input type='hidden' name='emp5' value='{$row['Address']}'>
                                    <input type='hidden' name='emp6' value='{$row['Birthday']}'>
                                    <input type='hidden' name='emp7' value='{$row['Gender']}'>
                                    <input type='hidden' name='emp8' value='{$row['Country']}'>
                                    <input type='hidden' name='emp9' value='{$row['Language']}'>
                                    <button type='submit' name='restore' class='btn btn-primary'>Restore</button>
                                </form>
                            </div>
                        </div>
                    </div>";

                    if(isset($_POST["restore"])){
                        $id = $_POST["emp"];
                        $fname = $_POST["emp1"];
                        $lname = $_POST["emp2"];
                        $con = $_POST["emp3"];
                        $email = $_POST["emp4"];
                        $add = $_POST["emp5"];
                        $bd = $_POST["emp6"];
                        $gender = $_POST["emp7"];
                        $count = $_POST["emp8"];
                        $lan = $_POST["emp9"];
                        echo"<div style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color: white;padding:40px;box-shadow: 0px 0px 5px black'>
                            <h6>Are you sure to RESET?</h6>
                                <form method='post' action='archive.php'>
                                    <input type='hidden' name='dd' value='$id'>
                                    <input type='hidden' name='dd1' value='$fname'>
                                    <input type='hidden' name='dd2' value='$lname'>
                                    <input type='hidden' name='dd3' value='$con'>
                                    <input type='hidden' name='dd4' value='$email'>
                                    <input type='hidden' name='dd5' value='$add'>
                                    <input type='hidden' name='dd6' value='$bd'>
                                    <input type='hidden' name='dd7' value='$gender'>
                                    <input type='hidden' name='dd8' value='$count'>
                                    <input type='hidden' name='dd9' value='$lan'>
                                    <button type='submit' class='btn btn-success' name='yes'>Yes</button>
                                    <button type='submit' class='btn btn-danger' name='no'>No</button>
                                </form>
                            </div>";
                    }

                    if(isset($_POST["yes"])){
                        $id2 = $_POST["dd"]; 
                        $fname2 = $_POST["dd1"];
                        $lname2 = $_POST["dd2"];
                        $con2 = $_POST["dd3"];
                        $email2 = $_POST["dd4"];
                        $add2 = $_POST["dd5"];
                        $bd2 = $_POST["dd6"];
                        $gender2 = $_POST["dd7"];
                        $count2 = $_POST["dd8"];
                        $lan2 = $_POST["dd9"];
                        $pass = "tmz";
                        $hash = password_hash($pass,PASSWORD_DEFAULT);

                        mysqli_query($conn, "INSERT INTO accounts (Employee_ID,Password,Status,Account_Status) VALUES ('$id2','$hash','Inactive','Registered')");
                        mysqli_query($conn, "INSERT INTO info (Employee_ID,Firstname,Lastname,Contact,Email,Address,Birthday,Gender,Country,Language) VALUES ('$id2','$fname2','$lname2','$con2','$email2','$add2','$bd2','$gender2','$count2','$lan2')");
                        mysqli_query($conn, "DELETE FROM archive WHERE Employee_ID = '$id2'");
                        echo"<div style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color: white;padding:40px;box-shadow: 0px 0px 5px black;color:green;'>
                            <h6>Done!</h6>
                                <form method='post' action='archive.php'>
                                    <button type='submit' class='btn btn-success' name='close'>Close</button>
                                </form>
                            </div>";
                    }
            }
            ?>
        </div>
    </div>
</body>
</html>