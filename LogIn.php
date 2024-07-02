<?php
    include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat-BLACK&display=swap" rel="stylesheet">
    <title>Temsiz</title>
</head>
<body background="profiles/tech.jpg">
    <section class="side">
        <img src="profiles/logo_vector.png" alt="">
    </section>

    <section class="main">
        <div class="login-container">
            <p class="title">EMPLOYEE TASK MANAGEMENT SYSTEM</p>
            <div class="separator"></div>
            <p class="welcome-message">Please, provide login credential to proceed and have access to all our services</p>

            <form class="login-form" method="post">
                <div class="form-control">
                    <input type="text" placeholder="Employee ID" name="id">
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-control">
                    <input type="password" placeholder="Password" name="password">
                    <i class="fas fa-lock"></i>
                </div>
                <button class="submit" name="login">Login</button>
            </form>
            
            <?php
                $notice = "";

                if(isset($_POST["login"])){
                    if(empty($_POST["id"])){
                        $notice = "Enter your Employee ID!";
                        if(empty($_POST["password"])){
                            $notice = "Enter your Employee ID and Password!";
                        }
                    }elseif(empty($_POST["password"])){
                        $notice = "Enter your Password!";
                    }
                    else{
                        $id = $_POST["id"];
                        $password = $_POST["password"];
                        $result = mysqli_query($conn ,"SELECT * FROM accounts WHERE Employee_ID = '$id' AND Account_Status = 'Registered'");
                        $check = mysqli_num_rows($result);
                        $get = mysqli_fetch_assoc($result);

                        if($id == "Geruel" && $password == "123456"){
                            header("Location: AdminDash.php");
                        }
                        else if($check == 0){
                            $notice = "Invalid Employee_ID";
                        }
                        elseif(password_verify($password,$get['Password'])){
                            session_start();
                            $_SESSION["ID"] = $_POST["id"];
                            header("Location: Dashboard.php");
                        }
                        else{
                            $notice = "Incorrect Password!";
                        }
                    }
                }
            ?>



            <p style="color: red;background-color:white;padding:5px;border-radius:5px;font-weight:bold"><?php echo$notice ?></p><br>
            <div class="link">
                <a href="Register.php">Register</a>
                <a href="request.php">Forgot Password</a>
            </div>
        </div>
    </section>
</body>
</html>