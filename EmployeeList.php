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
        <a href="Help.html"><i class="lni lni-help"></i> Help</a><br>
        <a href="About2.html"><i class="lni lni-magnifier"></i> About</a><br>
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
        <div class="row p-2">
            <h3 style="color: #fff;">Employee List</h3>
        </div>
        <form method="post">
          <div class="row">
              <div class="col-auto"><button class="btn btn-light" name="sort"><i class="lni lni-magnifier"></i></button></div>
              <div class="col-auto"><input type="text" class="form-control" name="type"></div>
          </div>
        </form><br>
        <div class="row listtable">
            <table class="table-hover text-center">
                <thead>
                  <tr>
                    <th scope="col">Profile</th>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Status</th>
                    <th scope="col">Search</th>
                  </tr>
                </thead>
                <?php
                $type = "";
                if(isset($_POST["sort"])){
                  $type = $_POST["type"];
                }

                $result = mysqli_query($conn, "SELECT * FROM info WHERE (Firstname LIKE '%$type%' OR Lastname LIKE '%$type%' OR Employee_ID LIKE '%$type%')");
                while($row = mysqli_fetch_assoc($result)){


                  $status = mysqli_query($conn, "SELECT * FROM accounts WHERE Employee_ID = '$row[Employee_ID]'");
                  $show = mysqli_fetch_assoc($status);
                  echo"
                    <tbody>
                      <tr>
                        <th><img src='{$row['picture']}' style='width: 30px;height: 30px;border-radius: 100%; border: 1px solid;'></th>
                        <th>{$row['Employee_ID']}</th>
                        <td>{$row['Firstname']} {$row['Lastname']}</td>
                        <td>{$row['Position']}</td>
                        <td>{$show['Status']}</td>
                        <td>
                            <form method='post' action='Look.php'>
                                <input type='hidden' name='infoid' value='{$row['Employee_ID']}'>
                                <button type='submit' class='btn btn-link' name='check' style='color:black'>Info</button>
                            </form>
                        </td>
                      </tr>
                    </tbody>";
                }
                ?>
              </table>
        </div>
    </div>
    
    <script src="js/function.js"></script>
</body>
</html>