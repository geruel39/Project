<?php
    include("connection.php");
    session_start();
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
        <a href="Help.html" class="animated-link"><i class="lni lni-help"></i> Help</a><br>
        <a href="About2.html" class="animated-link"><i class="lni lni-magnifier"></i> About</a><br>
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
    <div class="container">
        <div class="row p-2">
            <h3 style="color: white;">Employee Task</h3>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="container">
                    <div class="row text-center tasktypea">
                        <div class="col-5 tasktype mx-2"><a href="EmployeeTask.php">Task</a></div>
                        <div class="col-5"><a href="EmployeeTask2.php">Project</a></div>
                    </div>
                    <div class="row">
                        <div class="board">
                        <form method="post">
                                <label class="form-label">Task Title</label>
                                <input type="text" class="form-control" placeholder="Title" name="tasktitle" required>
                                <label class="form-label"><br>Description</label>
                                <textarea class="form-control" rows="8" placeholder="..." name="taskdes" required></textarea><br>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6" id="adding-block">
                                            <label>Employee</label>
                                            <button type="button" class="btn btn-outline-light ms-4" id="add">+</button>
                                            <input type="text" class="id-input form-control mt-2" name="id-1" value="TMZ" maxlength="9" required>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-auto">Due Date: <input type="date" name="due" required></div>
                                        <div class="col text-end"><button class="btn btn-primary" type="submit" name="assign">Assign</button></div>
                                    </div>
                                </div>
                        </form>
<?php
    if(isset($_POST["assign"])){

        $tcount = mysqli_query($conn , "SELECT MAX(Task_ID) FROM task");
        $tgetcount = mysqli_fetch_assoc($tcount);

        $tasktitle = $_POST["tasktitle"];
        $taskdes = $_POST["taskdes"];
        $taskid = $tgetcount['MAX(Task_ID)'];
        $due = $_POST["due"];
        $start = date('Y-m-d');
        $num = 0;
                                        
        if(empty($_POST["tasktitle"])){
            echo"<p style='color:red'>No Title...</p>";
        }else if(empty($_POST["taskdes"])){
            echo"<p style='color:red'>No Description...</p>";
        }else{
            $conn->begin_transaction();

            try {
                                            
                foreach ($_POST as $key => $value) {
                    if (strpos($key, 'id-') !== false) {
                        $id = $conn->real_escape_string($value);
                        $taskid++;
                        $num++;
                                                        
                        $sql = "INSERT INTO task (Task_ID, Task_Title, Task_Description, Status, Type, Start, Due, Employee_ID, Project_ID) VALUES ('$taskid', '$tasktitle', '$taskdes', 'Pending', 'Task', '$start', '$due', '$id', 'None')";
                                            
                        if ($conn->query($sql) !== TRUE) {
                            // If an insert fails, throw an exception
                            throw new Exception("Insert failed: " . $conn->error);
                        }
                    }
                }
                                            
                // If all inserts were successful, commit the transaction
                $conn->commit();
                echo "<p style='color:lightgreen'>Assign task successfully</p>";
            } catch (Exception $e) {
                // If any insert fails, roll back the transaction
                $conn->rollback();
                echo "<p style='color:red'>Failed</p>";
                }
        }
                                                
    }
?>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 tasklist mt-2">
                <h3 class="text-center">Employee Task List</h3>
                <table class="text-center">
                    <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Employee</th>
                        <th>Position</th>
                        <th>Pending</th>
                        <th><i class="lni lni-keyword-research"></i></th>
                    </tr>
                    </thead>
                    <?php
                    $emp_res = mysqli_query($conn , "SELECT * FROM info");

                    while($info = mysqli_fetch_assoc($emp_res)){

                    $count_result = mysqli_query($conn , "SELECT COUNT(Employee_ID) FROM task WHERE Employee_ID='$info[Employee_ID]'");
                    $count = mysqli_fetch_assoc($count_result);

                    $firstname = htmlspecialchars($info['Firstname']);
                    
                    
                    echo"
                    <tr>
                        <td><img src='{$info['picture']}'></td>
                        <td><span>{$info['Firstname']} {$info['Lastname']}</span> <p>{$info['Employee_ID']}</p></td>
                        <td>{$info['Position']}</td>
                        <td>{$count['COUNT(Employee_ID)']}</td>
                        <td>
                            <form method='post' action='AllTask.php'>
                                <input type='hidden' name='firstname' value='$firstname'>
                                <button type='submit' class='btn btn-info' name='show' style='color:black'>Show Task</button>
                            </form>
                        </td>
                    </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <script src="function.js"></script>
</body>
</html>