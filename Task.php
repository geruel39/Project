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
            <div class="col-auto"><h3 style="color: white;">Task</h3></div>
        </div>
        <br>
        <div class="row">
            <form method="post">
              <div class="row">
                <div class="col-auto">
                  <select name="status" class="btn btn-success">
                    <option value="">All</option>
                    <option value="Pending">Pending</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Finished">Finished</option>
                  </select>
                </div>
                <div class="col"><button class="btn btn-success" type="submit" name="sort">Sort</i></button></div>
              </div>
            </form>
            <?php
              $status = "";

              if(isset($_POST["sort"])){
                $status = $_POST["status"];
              }
            ?>
            <div class="col-md-12">
                <div class="card">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true" style="color: #000;">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="task-tab" data-bs-toggle="tab" data-bs-target="#task" type="button" role="tab" aria-controls="task" aria-selected="false" style="color: #000;">Task</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="project-tab" data-bs-toggle="tab" data-bs-target="#project" type="button" role="tab" aria-controls="project" aria-selected="false" style="color: #000;">Project</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-3" id="myTabContent">
                        <!--ALL-->
                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                          <?php
                        
                          $all_task = mysqli_query($conn, "SELECT * FROM task WHERE Employee_ID = '$Employee_ID' AND Status LIKE '%$status%'");

                          while($row = mysqli_fetch_assoc($all_task)){

                            $color = "dark";
                            if($row['Status'] == "Pending"){
                              $color = "danger";
                            }else if ($row['Status'] == "Ongoing"){
                              $color = "warning";
                            }else if ($row['Status'] == "Finished"){
                              $color = "primary";
                            }else{
                              $color = "dark";
                            }
                            
                          echo"
                            <div class='card-body'>
                              <div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show' role='alert'>
                                  <div class='row'>
                                    <div class='col-auto'><h3 style='color: #E6FF94;'>{$row['Task_Title']}</h3></div>
                                    <div class='col'><form method='post'><button class='btn btn-{$color}' name='{$row['Task_ID']}'>{$row['Status']}</button></form></div>
                                  </div>
                                  <p style='color: #E6FF94;'>{$row['Task_Description']}</p>
                                  <hr>
                                  <div class='row'>
                                    <div class='col-md-6' style='color: aliceblue;'><p>{$row['Start']}</p></div>
                                    <div class='col-md-6' style='text-align: right; color: aliceblue;'><p>Due: {$row['Due']}</p></div>
                                  </div>
                                  <button type='''button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>
                            </div>";

                            if(isset($_POST["$row[Task_ID]"])){

                              echo"<div style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color: white;padding:40px;box-shadow: 0px 0px 5px black'>
                                  <h6>Task Status Updated!</h6>
                                      <form method='post' action='Task.php' class='text-center'>
                                          <button type='submit' class='btn btn-success' name='yes'>Ok</button>
                                      </form>
                                  </div>";
                            }

                              if($row['Status'] == "Pending"){
                                mysqli_query($conn, "UPDATE task SET Status = 'Pending' WHERE Task_ID = '$row[Task_ID]'");
                              }
                              else if($row['Status'] == "Ongoing"){
                                mysqli_query($conn, "UPDATE task SET Status = 'Ongoing' WHERE Task_ID = '$row[Task_ID]'");
                              }
                              else if($row['Status'] == "Finished"){
                                mysqli_query($conn, "UPDATE task SET Status = 'Finished' WHERE Task_ID = '$row[Task_ID]'");
                              }
                              else{
                                echo"";
                              }

                          }
                          ?>
                        </div>
                        <!--TASK-->
                        <div class="tab-pane fade" id="task" role="tabpanel" aria-labelledby="task-tab">
                        <?php
                          $task = mysqli_query($conn, "SELECT * FROM task WHERE Employee_ID = '$Employee_ID' AND Project_ID = 0 AND Status LIKE '%$status%'");

                          while($row = mysqli_fetch_assoc($task)){

                            $color = "dark";
                            if($row['Status'] == "Pending"){
                              $color = "danger";
                            }else if ($row['Status'] == "Ongoing"){
                              $color = "warning";
                            }else if ($row['Status'] == "Finished"){
                              $color = "primary";
                            }else{
                              $color = "dark";
                            }


                          echo"
                            <div class='card-body'>
                              <div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show' role='alert'>
                                  <div class='row'>
                                    <div class='col-auto'><h3 style='color: #E6FF94;'>{$row['Task_Title']}</h3></div>
                                    <div class='col'><form method='post'><button class='btn btn-{$color}' name='{$row['Task_ID']}'>{$row['Status']}</button></form></div>
                                  </div>
                                  <p style='color: #E6FF94;'>{$row['Task_Description']}</p>
                                  <hr>
                                  <div class='row'>
                                    <div class='col-md-6' style='color: aliceblue;'><p>{$row['Start']}</p></div>
                                    <div class='col-md-6' style='text-align: right; color: aliceblue;'><p>Due: {$row['Due']}</p></div>
                                  </div>
                                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>
                            </div>";

                            if(isset($_POST["$row[Task_ID]"])){
                              if($row['Status'] == "Pending"){
                                mysqli_query($conn, "UPDATE task SET Status = 'Ongoing' WHERE Task_ID = '$row[Task_ID]'");
                              }
                              else if($row['Status'] == "Ongoing"){
                                mysqli_query($conn, "UPDATE task SET Status = 'Finished' WHERE Task_ID = '$row[Task_ID]'");
                              }
                              else if($row['Status'] == "Finished"){
                                mysqli_query($conn, "UPDATE task SET Status = 'Pending' WHERE Task_ID = '$row[Task_ID]'");
                              }
                            }
                          }
                          ?>
                        </div>
                        <!--PROJECT-->
                        <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="project-tab">
                        <?php
                          $project = mysqli_query($conn, "SELECT * FROM task WHERE Employee_ID = '$Employee_ID' AND Project_ID > 0 AND Status LIKE '%$status%'");

                          while($row = mysqli_fetch_assoc($project)){

                            $color = "dark";
                            if($row['Status'] == "Pending"){
                              $color = "danger";
                            }else if ($row['Status'] == "Ongoing"){
                              $color = "warning";
                            }else if ($row['Status'] == "Finished"){
                              $color = "primary";
                            }else{
                              $color = "dark";
                            }

                          echo"
                            <div class='card-body'>
                              <div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show' role='alert'>
                                  <div class='row'>
                                    <div class='col-auto'><h3 style='color: #E6FF94;'>{$row['Task_Title']}</h3></div>
                                    <div class='col'><form method='post'><button class='btn btn-{$color}' name='{$row['Task_ID']}'>{$row['Status']}</button></form></div>
                                  </div>
                                  <p style='color: #E6FF94;'>{$row['Task_Description']}</p>
                                  <hr>
                                  <div class='row'>
                                    <div class='col-md-6' style='color: aliceblue;'><p>{$row['Start']}</p></div>
                                    <div class='col-md-6' style='text-align: right; color: aliceblue;'><p>Due: {$row['Due']}</p></div>
                                  </div>
                                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>
                            </div>";

                            if(isset($_POST["$row[Task_ID]"])){
                              if($row['Status'] == "Pending"){
                                mysqli_query($conn, "UPDATE task SET Status = 'Ongoing' WHERE Task_ID = '$row[Task_ID]'");
                              }
                              else if($row['Status'] == "Ongoing"){
                                mysqli_query($conn, "UPDATE task SET Status = 'Finished' WHERE Task_ID = '$row[Task_ID]'");
                              }
                              else if($row['Status'] == "Finished"){
                                mysqli_query($conn, "UPDATE task SET Status = 'Pending' WHERE Task_ID = '$row[Task_ID]'");
                              }
                            }
                          }
                          ?>
                        </div>
                      </div>
                </div>
            </div>
          
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="js/function.js"></script>
</body>
</html>
