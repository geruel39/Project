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
<body>
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
        <a href="Help.html" class="animated-link"><i class="lni lni-help"></i> Help</a><br>
        <a href="About2.html" class="animated-link"><i class="lni lni-magnifier"></i> About</a><br>
        <form method="post">
            <button class="btn btn-link" style="text-decoration: none;" type="submit" name="out"><a href="LogIn.php"><i class="lni lni-exit"></i> Logout</a></button>
        </form><br> 
    </div>
    <?php

        if(isset($_POST["out"])){
            session_destroy();
            header("Location: LogIn.php");
        }
    ?>
    <div class="container">
        <form method="post">
            <div class="row mt-2 mb-2 ontop">
                <div class="col-1"><h2 style="color: white;">Task</h2></div>
                <div class="col-auto"><button class="btn btn-outline-light" type="submit" name="find"><i class="lni lni-magnifier"></i></button></div>
                <div class="col-auto"><input type="text" class="form-control btn-outline-light" placeholder="Search" name="search"></div>
                <div class="col-auto"><select name="order" class="btn btn-outline-light"><option value="DESC">Newest to Oldest</option><option value="ASC">Oldest to Newest</option></select></div>
                <div class="col-auto"><select name="status" class="btn btn-outline-light"><option value="">All</option><option value="Pending">Pending</option><option value="Ongoing">Ongoing</option><option value="Finished">Finished</option></select></div>
            </div>
        </form>
        <div class='row'>
        <?php
        session_start();
        if (isset($_POST['firstname'])) {
            $_SESSION['firstname'] = $_POST['firstname'];
        }

        $type = $_SESSION['firstname'];
        $status = "";
        $order = "DESC";

        if(isset($_POST["find"])){
            $type = $_POST["search"];
            $order = $_POST["order"];
            $status = $_POST["status"];
        }
        
        $search = "SELECT * FROM task INNER JOIN info ON task.Employee_ID=info.Employee_ID WHERE (Firstname LIKE '%$type%' OR Lastname LIKE '%$type%' OR Task_Title LIKE '%$type%') AND Status LIKE '%$status%' ORDER BY Task_ID $order";
        $task_result = mysqli_query($conn, $search);

        while($task = mysqli_fetch_assoc($task_result)){

            $info_result = mysqli_query($conn, "SELECT picture,Firstname,Lastname FROM info WHERE Employee_ID='$task[Employee_ID]'");
            $info = mysqli_fetch_assoc($info_result);

            $color = "black";
            if($task['Status'] == "Pending"){
                $color = "red";
            }else if($task['Status'] == "Ongoing"){
                $color = "yellow";
            }
            else if($task['Status'] == "Missing"){
                $color = "black";
            }else{
                $color = "green";
            }

            echo"
                <div class='col-4'>
                    <div class='container taskbox'>
                        <div class='row stop'>
                            <div class='col-1'><img src='{$info['picture']}' width='35' height='35'></div>
                            <div class='col-7 m-1' >{$info['Firstname']} {$info['Lastname']}</div>
                            <div class='col-3'>{$task['Employee_ID']}</div>
                        </div>
                        <div class='row smid'>
                            <div class='col'>Status: <span style='color: {$color}'>{$task['Status']}</span></div>
                            <div class='col text-end'>{$task['Type']}</div>
                        </div><br>
                        <div class='row'>
                            <h5>{$task['Task_Title']}</h5>
                        </div>
                        <div class='row'>
                            <p>{$task['Task_Description']}</p>
                        </div>
                        <div class='row'>
                            <div class='col text-end'>Due: 06/02/24</div>
                        </div>
                    </div>
                </div>";
        }
        ?>
        </div>
        <div class="linebreak"></div>
        <div class="row">
            <h2 style="color: white;">Project</h2>
        </div>
        <div class="row">
        <?php

        $project_result = mysqli_query($conn ,"SELECT * FROM project ORDER BY Project_ID DESC");

        while($proj = mysqli_fetch_assoc($project_result)){

        $names_result = mysqli_query($conn, "SELECT task.Employee_ID,info.picture,info.Firstname,info.Lastname FROM task INNER JOIN info ON task.Employee_ID=info.Employee_ID WHERE Project_ID = '$proj[Project_ID]'");

        $percent = 0;
        if($proj['Finished'] == 0 ){
            $percent = 0;
        }else{
            $percent = 100 * ($proj['Finished'] / $proj['Number_of_Employee']);
        }

        echo"
            <div class='col-4'>
                <div class='container projbox'>
                    <div class='row ptop'>
                        <div class='row'>Employee Names:</div>";
                        while($names = mysqli_fetch_assoc($names_result)){
                        echo"<div class='row ms-1' style='color:gold'>{$names['Firstname']} {$names['Lastname']}</div>";
                        }
                echo"</div>
                    <div class='row pmid'>
                        <div class='col'>Progress: {$percent}%</div>
                        <div class='col text-end'>Project Number: <span style='color:darkred'>{$proj['Project_ID']}</span></div>
                    </div>
                    <div class='row mt-2'>
                        <h5>{$proj['Project_Title']}</h5>
                    </div>
                    <div class='row'>
                        <p>{$proj['Project_Description']}</p>
                    </div>
                    <div class='row'>
                        <div class='col text-end'>Due: 06/02/24</div>
                    </div>
                </div>
            </div>";
        }
        ?>
        </div>
    </div>
    <script src="js/function.js"></script>
</body>
</html>