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
        <div class="col-lg-4 col-sm-3  sideprofile"><img src="profiles/3.jpg"> <span>Geruel Alcaraz (ADMIN)</span></div>
        <div class="col-lg-1 col-sm-9  menu"><i class="lni lni-menu" id="drop"></i></div>
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

    <!-- CONTENT  -->

    <?php
        $notice = "";

        if(isset($_POST["add"])){
            if(empty($_POST["id"])){
                $notice = "<p style='color:gray;font-weight:700'>Employee ID already used!</p>";
            }else{
                
                $id = $_POST["id"];
                $result = mysqli_query($conn, "SELECT * FROM accounts WHERE Employee_ID = '$id'");
                $check = mysqli_num_rows($result);
                if($check > 0){
                    $notice = "<p style='color:red;font-weight:700'>Employee ID already used!</p>";
                }else{
                    mysqli_query($conn ,"INSERT INTO accounts (Employee_ID,Status,Account_Status) VALUES ('$id','Inactive','Not Registered') ");
                }
            }
        } 
    ?>

    <div class="container">
        <div class="row p-2" style="color: white;"><h3>Manage Accounts</h3></div><br>
        <div class="row frow">
            <div class="col-5 addacc">
                <div class="row"><b>Add Account</b></div>
                <form method="post">
                    <div class="row">
                        <div class="col"><input class="form-control form-control-lg" type="text" value="TMZ" maxlength="9" name="id"></div>
                    </div><?php echo$notice;?>
                    <div class="row"><button type="submit" class="btn btn-primary" name="add">Add</button></div>
                </form>
            </div>

            <div class="col-3 text-center listacc">
                <h5>Account List</h5>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                        </tr>
                    </thead>
            <?php
            
            $status_result = mysqli_query($conn, "SELECT * FROM accounts");

            while($row = mysqli_fetch_assoc($status_result)){
            echo"
                    <tbody>
                        <tr>
                            <td>{$row['Employee_ID']}</td>
                            <td>{$row['Account_Status']}</td>
                        </tr>
                    </tbody>";
            }
            ?>
                </table>
            </div>
            <div class="col-3 searchacc">
                <div class="row"><b>Search:</b></div>
                <form method="post">
                    <div class="row">
                        <div class="col-9"><input class="form-control form-control-sm" type="text" placeholder="Employee ID" maxlength="9" name="look"></div>
                        <div class="col"><button type="submit" class="btn btn-outline-info" name="find"><i class="lni lni-magnifier"></i></button></div>
                    </div>
                </form>
    
                <?php
                    if(isset($_POST["find"])){
                        if(empty($_POST["look"])){
                            echo"<span style='color:gold'>Input box is empty...</span>";
                        }else{
                            $looking = $_POST["look"];
                            $looking_result = mysqli_query($conn, "SELECT * FROM info WHERE Employee_ID = '$looking'");
                            $looks = mysqli_num_rows($looking_result);

                            if($looks == 0){
                                echo"<span style='color:gold'>No Result</span>";
                            }
                            else{
                ?>
                <br>
                <?php
                    $data = mysqli_fetch_assoc($looking_result);

                    echo"
                    <div class='row'>
                        <div class='col-8'><p><b>{$data['Firstname']} {$data['Lastname']}</b><br><small>{$data['Position']}</small></p></div>
                        <div class='col text-end'><form method='post' action='Look.php'>
                                                <input type='hidden' name='infoid' value='{$data['Employee_ID']}'>
                                                <button type='submit' class='btn btn-link' name='check'>Info</button>
                                                </form>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-7'><b>{$data['Employee_ID']}</b></div>
                        <div class='col text-end'><form method='post'>
                                                    <input type='hidden' name='employee_id' value='$data[Employee_ID]'>
                                                    <button type='submit' class='btn btn-danger' name='delete'>Delete</button>
                                                </form>
                        </div>
                    </div>";

                        }
                        
                    }
                }

                if(isset($_POST["delete"])){
                    $theid = $_POST["employee_id"];
                    $infores = mysqli_query($conn, "SELECT * FROM info WHERE Employee_ID = '$theid'");
                    $info = mysqli_fetch_assoc($infores);

                    mysqli_query($conn, "INSERT INTO archive (Employee_ID,Firstname,Lastname,Contact,Email,Address,Birthday,Gender,Country,Language) VALUES ('$info[Employee_ID]','$info[Firstname]','$info[Lastname]','$info[Contact]','$info[Email]','$info[Address]','$info[Birthday]','$info[Gender]','$info[Country]','$info[Country]')");
                    mysqli_query($conn, "DELETE FROM task WHERE Employee_ID = '$theid'");
                    mysqli_query($conn, "DELETE FROM info WHERE Employee_ID = '$theid'");
                    mysqli_query($conn, "DELETE FROM accounts WHERE Employee_ID = '$theid'");
                }
                

                ?>
            </div>
        </div><hr style="border: 1px solid white;">

        <?php
            $total_result = mysqli_query($conn,"SELECT * FROM accounts");
            $total = mysqli_num_rows($total_result);
            $reg_result = mysqli_query($conn,"SELECT * FROM accounts WHERE Account_Status = 'Registered'");
            $reg = mysqli_num_rows($reg_result);
            $not_result = mysqli_query($conn,"SELECT * FROM accounts WHERE Account_Status = 'Not Registered'");
            $not = mysqli_num_rows($not_result);
            $reset_result = mysqli_query($conn,"SELECT * FROM password_reset");
            $reset = mysqli_num_rows($reset_result);
            $delete_result = mysqli_query($conn,"SELECT * FROM archive");
            $delete = mysqli_num_rows($delete_result);
        ?>
        
        <div class="row lrow">
            <div class="col-2 border-primary p-2 mstats">   <p>Total Accounts</p>     <p class="text-center"><?php echo$total?></p>     </div>
            <div class="col-2 border-success  p-2 mstats">   <p>Registered</p>         <p class="text-center"><?php echo$reg?></p>     </div>
            <div class="col-2 border-warning  p-2 mstats">   <p>Not Registered</p>     <p class="text-center"><?php echo$not?></p>      </div>
            <div class="col-2 border-danger  p-2 mstats">    <p>Reset Request</p>       <p class="text-center"><?php echo$reset?></p>     <a href="reset.php">Show</a>    </div>
            <div class="col-2 border-secondary  p-2 mstats"> <p>Deleted Accounts</p> <p class="text-center"><?php echo$delete?></p>        <a href="archive.php">Show</a>    </div>
        </div>
    </div>
    
    <script src="js/function.js"></script>
</body>
</html>