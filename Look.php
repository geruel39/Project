<?php
    include("connection.php");
    session_start();

    $Employee_ID = "";

    if(isset($_POST["check"])){
        $Employee_ID = $_POST["infoid"];
    }

    $_SESSION["idedit"] = $Employee_ID; 

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
    <!-- CONTENT -->
    <div class="container mt-3">
        <div class="row">
            <div class="col-auto"><form method="post"><button class="btn btn-danger" name="close">CLOSE</button></form></div>
        </div>
        <?php
            if(isset($_POST["close"])){
                header("Location: Manage.php");
            }
        ?>  
        <br>
        <div class="card">
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
                            <a href="edit.php" class="btn">Edit Profile</a>
                    </div>
                </div>
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