<?php
    include("connection.php");
    session_start();

    $Employee_ID = "";

    if(isset($_SESSION["idedit"])){
        $Employee_ID = $_SESSION["idedit"];
    }

    $info_result = mysqli_query($conn, "SELECT * FROM info WHERE Employee_ID = '$Employee_ID'");
    $ifetch = mysqli_fetch_assoc($info_result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/employee.css">
</head>

<body>

    <!-- CONTENT -->
    <div class="container light-style flex-grow-1 container-p-y forall mt-3">
        <div class="row">
            <div class="col-auto"><form method="post"><a href="Manage.php" class="btn btn-danger">CLOSE</a></form></div>
        </div>
        <br>  
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Info</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <form method="post" enctype="multipart/form-data">
                                <div class="card-body media align-items-center">
                                    <img src="<?php echo$ifetch['picture']?>" width="100" height="100">
                                    <div class="media-body ml-4">
                                        <label class="btn btn-primary">
                                            Change Profile Picture
                                            <input type="file" class="account-settings-fileinput" name="image">
                                        </label> &nbsp;
                                        <input type="submit" class="btn btn-outline-dark" name="change" value="Change">
                                    </div>
                                </div>
                            </form>
                            <?php 
                                if(isset($_POST["change"])){
                                    if(isset($_FILES["image"])){
                                        $image = $_FILES['image']['name'];
                                        mysqli_query($conn,"UPDATE info SET picture = 'profiles/$image' WHERE Employee_ID = '$Employee_ID'");
                                    }
                                }
                            ?>
                            <hr class="border-dark m-0">
                            <div class="card-body">
                                <form method="post">
                                    <div class="form-group">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control mb-1" value="<?php echo$ifetch['Firstname']?>" name="firstname" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" value="<?php echo$ifetch['Lastname']?>" name="lastname" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Position</label>
                                        <input type="text" class="form-control" value="<?php echo$ifetch['Position']?>" name="position" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary align-items-end" name="submit1">Save Changes</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <form method="post">
                                    <div class="form-group">
                                        <label class="form-label">Current password</label>
                                        <input type="password" class="form-control" name="currentpassword">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">New password</label>
                                        <input type="password" class="form-control" name="newpassword"> 
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Repeat new password</label>
                                        <input type="password" class="form-control" name="repassword">
                                    </div>
                                    <button type="submit" class="btn btn-danger align-items-end" name="changepass">Change Password</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body pb-2">
                                <form method="post">
                                    <div class="form-group">
                                        <label class="form-label">Bio</label>
                                        <textarea class="form-control" rows="5" name="bio"><?php echo$ifetch['Bio']?></textarea>
                                    </div>
                                    <h6 class="mb-4">Contacts</h6>
                                    <div class="form-group">
                                        <label class="form-label">Contact No.</label>
                                        <input type="text" class="form-control" value="<?php echo$ifetch['Contact']?>" name="contact">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" value="<?php echo$ifetch['Email']?>" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" value="<?php echo$ifetch['Address']?>" name="address">
                                    </div>
                                    <h6 class="mb-4">Status</h6>
                                    <div class="form-group">
                                        <label class="form-label">Type of Employment</label>
                                        <input type="text" class="form-control" value="<?php echo$ifetch['Type_of_Employment']?>" name="toe">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Working Days</label>
                                        <input type="text" class="form-control" value="<?php echo$ifetch['Working_Days']?>" name="wd">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Working Hours</label>
                                        <input type="text" class="form-control" value="<?php echo$ifetch['Working_Hours']?>" name="wh">
                                    </div>
                                    <h6 class="mb-4">Personal</h6>
                                    <div class="form-group">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="text" class="form-control" value="<?php echo$ifetch['Birthday']?>" name="dob">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Gender</label>
                                        <input type="text" class="form-control" value="<?php echo$ifetch['Gender']?>" name="gender">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Country</label>
                                        <input type="text" class="form-control" value="<?php echo$ifetch['Country']?>" name="country">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Main Language</label>
                                        <input type="text" class="form-control" value="<?php echo$ifetch['Language']?>" name="language">
                                    </div>
                                    <button type="submit" class="btn btn-info align-items-end" name="submit2">Save Changes</button>
                            </form>
                            </div>
                            <hr class="border-light m-0">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/function.js"></script>
</body>
</html>

<?php
    if(isset($_POST["submit1"])){
        $newfname = $_POST["firstname"];
        $newlname = $_POST["lastname"];
        $newpos = $_POST["position"];

        mysqli_query($conn, "UPDATE info SET Firstname = '$newfname', Lastname = '$newlname', Position = '$newpos' WHERE Employee_ID = '$Employee_ID'");
    }
?>

<?php
    if(isset($_POST["submit2"])){
        $newbio = $_POST["bio"];
        $newcontact = $_POST["contact"];
        $newemail = $_POST["email"];
        $newaddress = $_POST["address"];
        $newtoe = $_POST["toe"];
        $newwd = $_POST["wd"];
        $newwh= $_POST["wh"];
        $newdob = $_POST["dob"];
        $newgender = $_POST["gender"];
        $newcountry = $_POST["country"];
        $newlanguage = $_POST["language"];

        mysqli_query($conn, "UPDATE info SET 
        Bio = '$newbio',
        Contact = '$newcontact',
        Email = '$newemail',
        Address = '$newaddress',
        Type_of_Employment = '$newtoe',
        Working_Days = '$newwd',
        Working_Hours = '$newwh',
        Birthday = '$newdob',
        Gender = '$newgender',
        Country = '$newcountry',
        Language = '$newlanguage'
        WHERE Employee_ID = '$Employee_ID'
        ");
    }
?>




<?php 
    $acc_result = mysqli_query($conn, "SELECT * FROM accounts WHERE Employee_ID='$Employee_ID'");
    $fetch = mysqli_fetch_assoc($acc_result);

    if(isset($_POST["changepass"])){
        if(empty($_POST["currentpassword"])){
            echo"<p style='position:absolute;top:65%;left:20%;transform:translate(-50%,-50%);padding:20px;color:white;border-radius: 10px;font-weight:bold;border: 1px solid;'>Enter the Current Password</p>";
        }else if(empty($_POST["newpassword"])){
            echo"<p style='position:absolute;top:65%;left:20%;transform:translate(-50%,-50%);padding:20px;color:white;border-radius: 10px;font-weight:bold;border: 1px solid;'>Enter New Password</p>";
        }else if(empty($_POST["repassword"])){
            echo"<p style='position:absolute;top:65%;left:20%;transform:translate(-50%,-50%);padding:20px;color:white   ;border-radius: 10px;font-weight:bold;border: 1px solid;'>Re-Enter New Password</p>";
        }else{
            $currentpassword = $_POST["currentpassword"];
            $newpassword = $_POST["newpassword"];
            $repassword = $_POST["repassword"];
            
            if(password_verify($currentpassword,$fetch['Password'])){
                if($newpassword == $repassword){
                    $change = password_hash($newpassword,PASSWORD_DEFAULT);
                    mysqli_query($conn, "UPDATE accounts SET Password='$change' WHERE Employee_ID='$Employee_ID'");
                }else{
                    echo"<p style='position:absolute;top:65%;left:20%;transform:translate(-50%,-50%);padding:20px;color:red;border-radius: 10px;font-weight:bold;border: 1px solid;'>Password not match!</p>";
                }
            }else{
                echo"<p style='position:absolute;top:65%;left:20%;transform:translate(-50%,-50%);padding:20px;color:red;border-radius: 10px;font-weight:bold;border: 1px solid;'>Wrong Password!</p>";
            }
        }
    }
?>