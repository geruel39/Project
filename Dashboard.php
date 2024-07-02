<?php
    include("connection.php");
    session_start();
    $Employee_ID = $_SESSION["ID"];
    $info_result = mysqli_query($conn, "SELECT * FROM info WHERE Employee_ID = '$Employee_ID'");
    $ifetch = mysqli_fetch_assoc($info_result);
    $pending_result = mysqli_query($conn, "SELECT COUNT(Task_ID) FROM task WHERE Employee_ID = '$Employee_ID' AND Status IN ('Pending','Ongoing')");
    $pending = mysqli_fetch_assoc($pending_result);
    $finished_result = mysqli_query($conn, "SELECT COUNT(Task_ID) FROM task WHERE Employee_ID = '$Employee_ID' AND Status = 'Finished'");
    $finished = mysqli_fetch_assoc($finished_result);
    $project_result = mysqli_query($conn, "SELECT COUNT(Task_ID) FROM task WHERE Employee_ID = '$Employee_ID' AND Project_ID > 0");
    $project = mysqli_fetch_assoc($project_result);
    $fproject_result = mysqli_query($conn, "SELECT COUNT(Task_ID) FROM task WHERE Employee_ID = '$Employee_ID' AND Project_ID > 0 AND Status = 'Finished'");
    $fproject = mysqli_fetch_assoc($fproject_result);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/dashboard.css">
</head>
<body class="bg-smoke">
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
        <br><form method='post' action="Dashboard.php"><button type='submit' <?php echo"class='btn btn-$color'" ?> name='status'><?php echo$acc['Status']?></button></form><br>
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
    
    <div class="container mt-3">
        <div class="row">
            <div class="col-7"><h3 style="color: white;">Dashboard</h3></div>
        </div>
        <br>
        <div class="row text-center d-flex justify-content-center align-items-center">
            <div class="col-3 dashcontent mx-2">
                <img src="profiles/clipboard.svg" class="img-responsive">
                <h2><span id="pendingCount"><?php echo$pending['COUNT(Task_ID)'] ?></sp'an></h2>
                <p>Pending Task</p>
            </div>
            <div class="col-3 dashcontent mx-2">
                <img src="profiles/clipboard-check.svg" class="img-responsive">
                <h2><span id="finishedCount"><?php echo$finished['COUNT(Task_ID)'] ?></span></h2>
                <p>Finished Task</p>
            </div>
            <div class="col-3 dashcontent mx-2">
                <img src="profiles/collection.svg" class="img-responsive">
                <h2><span id="projectsCount"><?php echo$project['COUNT(Task_ID)'] ?></span></h2>
                <p>Projects</p>
            </div>
            <div class="col-3 dashcontent mx-2">
                <img src="profiles/collection-fill.svg" class="img-responsive">
                <h2><span id="fprojectsCount"><?php echo$fproject['COUNT(Task_ID)'] ?></span></h2>
                <p>Finished Projects</p>
            </div>
    </div>

    <div class="taskchart-container p-2">
        <div class="button-container">
            <h2 style="color: black;">Task Report</h2>
            <button id="monthly-btn">Monthly</button>
            <button id="yearly-btn">Yearly</button>
        </div>

        <div class="chart-container">
            <div class="chart" id="attendance-chart">
            </div>
        </div>
    </div>
    <div class="container-flex mt-5 text-center">
        <div class="col-6">
            <div class="p-1">
                <h3 style="background: rgba(255, 255, 255, 0.2);padding:10px;backdrop-filter: blur(5px);">Employee Task Rank</h3>
                <table class="table table-success">
                    <thead>
                        <th>Rank</th>
                        <th>Employee Name</th>
                        <th>Finished Tasks</th>
                    </thead>
                <?php
                $rank_result = mysqli_query($conn, "SELECT Employee_ID,COUNT(Task_ID) FROM task WHERE Status = 'Finished' GROUP BY Employee_ID ORDER BY COUNT(Task_ID) DESC LIMIT 10");
                $rank = 0;
                while($row = mysqli_fetch_assoc($rank_result)){

                    $getname = mysqli_query($conn, "SELECT * FROM info WHERE Employee_ID = '$row[Employee_ID]'");
                    $name = mysqli_fetch_assoc($getname);
                    $getnum = mysqli_query($conn, "SELECT * FROM task WHERE Employee_ID = '$row[Employee_ID]' && Status = 'Finished'");
                    $num = mysqli_num_rows($getnum);
                    $rank++;
                    echo"
                        <tbody>
                            <th>$rank</th>
                            <td>{$name['Firstname']} {$name['Lastname']}</td>
                            <td>$num</td>
                        </tbody>";
                }
                ?>
                </table>
            </div>
        </div>
        <div class="col-6">
            <div class="p-1">
                <h3 style="background: rgba(255, 255, 255, 0.2);padding:10px;backdrop-filter: blur(5px);">Task Reminder</h3>
                <table class="table table-success">
                    <thead>
                        <th>Task No.</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </thead>

                <?php
                    $remind_result = mysqli_query($conn, "SELECT * FROM task WHERE Employee_ID = '$Employee_ID' AND Status IN('Pending','Ongoing')");

                while($row = mysqli_fetch_assoc($remind_result)){
                echo"
                    <tbody>
                        <td>{$row['Task_ID']}</td>
                        <td>{$row['Due']}</td>
                        <td>{$row['Status']}</td>
                    </tbody>";
                }
                ?>
                </table>
            </div>
        </div>
    </div>
</div>

    <script src="js/dashboard.js"></script>
</body>
</html>