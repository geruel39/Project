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
	<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/admin.css">
</head>
<body class="bg-smoke">
    <div class="row navigation">
        <div class="col-lg-2 col-sm-12 logo"><a href="AdminDash.php"><img src="profiles/logo.png" alt="Temsiz"></a><span>TEMSIZ</span></div>
        <div class="col-lg-5 col-sm-12">
            <div class="container links">
            <a href="AdminDash.php" class="animated-link">Dashboard</a>
            <a href="EmployeeList.php" class="animated-link">Employee List</a>
            <a href="EmployeeTask.php" class="animated-link">Employee Task</a>
            <a href="Manage.php" class="animated-link">Manage Accounts</a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-3 sideprofile"><img src="profiles/3.jpg"> <span>Geruel Alcaraz (ADMIN)</span></div>
        <div class="col-lg-1 col-sm-9 menu"><i class="lni lni-menu" id="drop"></i></div>
    </div>
    <div class="dropdown">
        <br>
        <a href="Help.html"><i class="lni lni-help"></i> Help</a><br>
        <a href="About2.html"><i class="lni lni-magnifier"></i> About</a><br>
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
    
    <?php
        $total_result = mysqli_query($conn, "SELECT * FROM accounts WHERE Account_Status = 'Registered'");
        $total = mysqli_num_rows($total_result);
        $active_result = mysqli_query($conn, "SELECT * FROM accounts WHERE Account_Status = 'Registered' AND Status = 'Active'");
        $active = mysqli_num_rows($active_result);
        $inactive_result = mysqli_query($conn, "SELECT * FROM accounts WHERE Account_Status = 'Registered' AND Status = 'Inactive'");
        $inactive = mysqli_num_rows($inactive_result);
        $apercent = null;
        $ipercent = null;
        $epercent = null;
        if($active == 0){
            $apercent = 0;
            $epercent = 0;
            $ipercent = 360;
        }else if ($active > 0){
            $ipercent = ($total - $active);
            if($ipercent == 0){
                $ipercent = 0;
            }else{
                $ipercent = 360 * ($ipercent / $total);
            }
            $epercent = round(100 * ($active / $total));
            $apercent = 360 * ($active / $total); 
        }
    ?>


    <div class="container">
        <div class="row p-2"><h3 style="color:white">Dashboard</h3></div>
        <div class="row text-center">
            <div class="col-3"><div class="p-2 df"><p>Total</p><div class="activep" style="background: conic-gradient(#C80036 0deg 261deg);"><div class="circle"><p><?php echo$total ?></p></div></div></div></div>
            <div class="col-3"><div class="p-2 df"><p>Active</p><div class="activep" style="background: conic-gradient(#C80036 0deg <?php echo$apercent ?>deg,#00000013 0deg);"><div class="circle"><p><?php echo$active ?></p></div></div></div></div>
            <div class="col-3"><div class="p-2 df"><p>Inactive</p><div class="activep" style="background: conic-gradient(#C80036 0deg <?php echo$ipercent ?>deg,#00000013 0deg);"><div class="circle"><p><?php echo$inactive ?></p></div></div></div></div>
            <div class="col-3"><div class="p-2 df"><p>Active Percentage</p><div class="activep" style="background: conic-gradient(#C80036 0deg <?php echo$apercent ?>deg,#00000013 0deg);"><div class="circle"><p><?php echo$epercent ?>%</p></div></div></div></div>
        </div>
        <?php
            $projt_result = mysqli_query($conn, "SELECT * FROM project");
            $projtnum = mysqli_num_rows($projt_result);
            $projf_result = mysqli_query($conn, "SELECT * FROM task WHERE Status = 'Finished' AND Project_ID > 0");
            $projfnum = mysqli_num_rows($projf_result);
            $projp_result = mysqli_query($conn, "SELECT * FROM task WHERE (Status = 'Pending' OR Status = 'Ongoing') AND Project_ID > 0");
            $projpnum = mysqli_num_rows($projp_result);

            $pper = null;
            if($projfnum == 0){
                $pper = 0;
            }
            else{
                $pper = round(100 * ($projfnum / $projtnum));
            }
        ?>
        <div class="row">
            <div class="col-6"><div class="p-2 mt-4 ds"><h4>Project</h4>
                <div class="row text-center mt-4">
                    <div class="col-3"><div class="dsip"><p>Total</p>       <p><?php echo$projtnum ?></p></div></div>    
                    <div class="col-3"><div class="dsip"><p>Finished</p>    <p><?php echo$projfnum ?></p></div></div>
                    <div class="col-3"><div class="dsip"><p>Pending</p>     <p><?php echo$projpnum ?></p></div></div>
                    <div class="col-3"><div class="dsip border-secondary"><p>Finished %</p>  <p><?php echo$pper ?>%</p></div></div>
                </div>
            </div></div>

            <?php 
                $taskt_result = mysqli_query($conn, "SELECT * FROM task");
                $tasktnum = mysqli_num_rows($taskt_result);
                $taskf_result = mysqli_query($conn, "SELECT * FROM task WHERE Status = 'Finished'");
                $taskfnum = mysqli_num_rows($taskf_result);
                $taskp_result = mysqli_query($conn, "SELECT * FROM task WHERE Status = 'Pending' OR Status = 'Ongoing'");
                $taskpnum = mysqli_num_rows($taskp_result);

                $tper = null;
            if($taskfnum == 0){
                $tper = 0;
            }
            else{
                $tper = round(100 * ($taskfnum / $tasktnum));
            }
            ?>
            <div class="col-6"><div class="p-2 mt-4 ds"><h4>Task</h4>
                <div class="row text-center mt-4">
                    <div class="col-3"><div class="dsip"><p>Total</p>       <p><?php echo$tasktnum ?></p></div></div>
                    <div class="col-3"><div class="dsip"><p>Finished</p>    <p><?php echo$taskfnum ?></p></div></div>
                    <div class="col-3"><div class="dsip"><p>Pending</p>     <p><?php echo$taskpnum ?></p></div></div>
                    <div class="col-3"><div class="dsip border-secondary"><p>Finished %</p>  <p><?php echo$tper ?>%</p></div></div>
                </div>
            </div></div>
        </div>
        <?php 
            $totalAcc_result = mysqli_query($conn, "SELECT * FROM accounts");
            $totalAcc = mysqli_num_rows($totalAcc_result);
            $registered_result = mysqli_query($conn, "SELECT * FROM accounts WHERE Account_Status = 'Registered'");
            $registered = mysqli_num_rows($registered_result);
            $notreg = $totalAcc -  $registered;
            $reset_result = mysqli_query($conn, "SELECT * FROM password_reset");
            $reset = mysqli_num_rows($reset_result);
            $archive_result = mysqli_query($conn, "SELECT * FROM archive");
            $archive = mysqli_num_rows($archive_result);
        ?>
        <div class="row mt-4">
            <div class="col"><div class="p-2 dt"><p>Total Accounts</p>   <p class="text-center"><?php echo$totalAcc ?></p>      </div></div>
            <div class="col"><div class="p-2 dt"><p>Registered</p>       <p class="text-center"><?php echo$registered ?></p>      </div></div>
            <div class="col"><div class="p-2 dt"><p>Not Registered</p>   <p class="text-center"><?php echo$notreg ?></p>       </div></div>
            <div class="col"><div class="p-2 dt"><p>Reset Request</p>    <p class="text-center"><?php echo$reset ?></p>       </div></div>
            <div class="col"><div class="p-2 dt"><p>Deleted Accounts</p> <p class="text-center"><?php echo$archive ?></p>       </div></div>
        </div>
    </div>
    
    <script src="js/function.js"></script>
</body>
</html>