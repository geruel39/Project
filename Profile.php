<?php
    include("connection.php");
    session_start();
    $Employee_ID = $_SESSION["ID"];
    $info_result = mysqli_query($conn, "SELECT * FROM info WHERE Employee_ID = '$Employee_ID'");
    $ifetch = mysqli_fetch_assoc($info_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/employee.css">
</head>
<body class="bg-smoke">
    <!-- NAVIGATION -->
    <div class="row navigation">
        <div class="col-2 logo"><a href="Dashboard.php"><img src="profiles/logo.png" alt="Temsiz"></a><span>TEMSIZ</span></div>
        <div class="col-2 links">
            <a href="Dashboard.php" class="animated-link">Dashboard</a>
            <a href="Profile.php" class="animated-link">Profile</a>
            <a href="Task.php" class="animated-link">Task</a>
        </div>
        <div class="col-7 sideprofile"><img src="<?php echo$ifetch['picture']?>"> <span><?php echo$ifetch['Firstname'] ." ". $ifetch['Lastname']; ?></span></div>
        <div class="col menu"><i class="lni lni-menu" id="drop"></i></div>
    </div>
    <?php
        $acc_result = mysqli_query($conn, "SELECT * FROM accounts WHERE Employee_ID = '$Employee_ID'");
        $acc = mysqli_fetch_assoc($acc_result);
        $color = "";
        
            if($acc["Status"] == "Active"){
                $color = "success";
            }
            else if($acc["Status"] == "Inactive"){
                $color = "danger";
            }
    ?>
    <div class="dropdown">
        <br><form method='post'><button type='submit' <?php echo"class='btn btn-$color'" ?> name='status'><?php echo$acc['Status']?></button></form><br>
        <a href="Help.html"><i class="lni lni-help"></i> Help</a><br>
        <a href="About.html"><i class="lni lni-magnifier"></i> About</a><br>
        <form method="post">
            <button class="btn btn-link" style="text-decoration: none;" type="submit" name="out"><a href="LogIn.php"><i class="lni lni-exit"></i> Logout</a></button>
        </form><br> 
    </div>
    <?php
        if(isset($_POST['status'])){
            if($acc['Status'] == "Active"){
                mysqli_query($conn, "UPDATE accounts SET Status = 'Inactive' WHERE Employee_ID = '$Employee_ID'");
            }
            else if($acc['Status'] == "Inactive"){
                mysqli_query($conn, "UPDATE accounts SET Status = 'Active' WHERE Employee_ID = '$Employee_ID'");
            }
        }

        if(isset($_POST["out"])){
            session_destroy();
            header("Location: LogIn.php");
        }
    ?>

    <!-- CONTENT -->
    <div class="container mt-3">
        <div class="row">
            <div class="col-auto"><h3 style="color: white;">Profile</h3></div>
        </div>
        <br>
        <div class="card">
            <form method="post">
                <div class="card-header bg-teal text-white d-flex align-items-center">
                    <div class="profile-img mr-3">
                        <img src="<?php echo$ifetch['picture']?>" alt="Profile Image" class="rounded-circle">
                    </div>
                    <div class="profile-nav-info">
                        <h3 class="user-name ms-2"><?php echo$ifetch['Firstname'] ." ". $ifetch['Lastname']; ?></h3>
                        <div class="address">
                            <p class="state ms-2"><?php echo$ifetch['Position']; ?></p>
                            <p class="country ms-2">Employee ID: <?php echo$Employee_ID; ?></p>
                        </div>
                    </div>
                    <div class="profile-option ml-auto">
                        <button class="btn btn-warning" ><a href="settings.php" style="color:white">Edit Profile</a></button>
                    </div>
                </div>
            </form>
            <div class="card-body card">
                <div class="user-bio mb-4">
                    <h3>About Me</h3>
                    <p class="bio"><?php echo$ifetch['Bio']; ?></p>
                </div>
                <hr class="section-divider">
                <div class="user-info">
                    <h3>Details</h3>
                    <div class="row">
                        <div class="col-md-4 de">
                            <ul class="list-unstyled"><br>
                                <li class="detail-item"><h5>PERSONAL INFO</h5></li><br>
                                <li class="detail-item"><strong>Age:</strong> 65</li>
                                <li class="detail-item"><strong>Date of Birth:</strong> <?php echo$ifetch['Birthday']; ?></li>
                                <li class="detail-item"><strong>Gender:</strong> <?php echo$ifetch['Gender']; ?> </li>
                                <li class="detail-item"><strong>Country:</strong> <?php echo$ifetch['Country']; ?></li>
                                <li class="detail-item"><strong>Main Language:</strong> <?php echo$ifetch['Language']; ?></li>
                            </ul>
                        </div>
                        <div class="col-md-4 de">
                            <ul class="list-unstyled"><br>
                                <li class="detail-item"><h5>CONTACT INFO</h5></li><br>
                                <li class="detail-item"><strong>Contact No.:</strong> <?php echo$ifetch['Contact']; ?></li>
                                <li class="detail-item"><strong>Email:</strong> <?php echo$ifetch['Email']; ?></li>
                                <li class="detail-item"><strong>Address</strong> <?php echo$ifetch['Address']; ?></li><br>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-unstyled"><br>    
                                <li class="detail-item"><h5>STATUS</h5></li><br>
                                <li class="detail-item"><strong>Type of Employment:</strong> <?php echo$ifetch['Type_of_Employment']; ?></li>
                                <li class="detail-item"><strong>Working Days:</strong> <?php echo$ifetch['Working_Days']; ?></li>
                                <li class="detail-item"><strong>Work Hours:</strong> <?php echo$ifetch['Working_Hours']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="section-divider">
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="function.js"></script>
    <script src="js/function.js"></script>
</body>
</html>