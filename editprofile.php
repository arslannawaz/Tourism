<?php
ob_start();

include('includes/connection.php');
include('config.php');
include ('includes/app.php');


if(isset($_GET["code"]))
{
    //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if(!isset($token['error']))
    {
        //Set the access token used for requests
        $google_client->setAccessToken($token['access_token']);
        //Store "access_token" value in $_SESSION variable for future use.
        $_SESSION['access_token'] = $token['access_token'];
        //Create Object of Google Service OAuth 2 class
        $google_service = new Google_Service_Oauth2($google_client);
        //Get user profile data from google
        $data = $google_service->userinfo->get();
        //Below you can find Get profile data and store into $_SESSION variable
        if(!empty($data['given_name']))
        {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if(!empty($data['family_name']))
        {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if(!empty($data['email']))
        {
            $_SESSION['user_email_address'] = $data['email'];
        }

        if(!empty($data['gender']))
        {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if(!empty($data['picture']))
        {
            $_SESSION['user_image'] = $data['picture'];
        }
    }

    if(!$_SESSION["user_email_address"]){
        header("location: index.php");
    }
    else{
        $_SESSION["id"]=$_SESSION["user_email_address"];
        $_SESSION["name"]=$_SESSION["user_first_name"];
        $userid=$_SESSION["id"];
        $username=$_SESSION["name"];
        $useremail=$_SESSION['user_email_address'];

        $sql = "SELECT * from users where email='$useremail'";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result) > 0)
        {
            $userid=$_SESSION["id"];
        }
        else
        {
            $sql1 = "INSERT INTO `users` VALUES('','$username', '$useremail','auth from google',0,1)";
            mysqli_query($conn, $sql1);
            $userid=$_SESSION["id"];
        }

    }
}
else {
    if (!$_SESSION["id"]) {
        header("location: index.php");
    } else {
        $userid = $_SESSION["id"];
        $username = $_SESSION["name"];
    }

}

?>


<!-- Dashboard -->
<div id="dashboard">

    <!-- Navigation
    ================================================== -->

    <!-- Responsive Navigation Trigger -->

    <a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>

    <div class="dashboard-nav">
        <div class="dashboard-nav-inner">

            <?php
            $sql = "SELECT * from users where id= '$userid' or email='$userid' ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $profile=$row["profile"];
                }
            }
            if($profile==1){
            ?>
            <ul data-submenu-title="Main">
                <li ><a href="index.php"><i class="sl sl-icon-settings"></i>Home</a></li>
                <li ><a href="dashboard.php"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
                <li ><a><i class="fa fa-clock-o"></i>Booking</a>
                    <ul>
                        <li><a href="booking.php">My Booking</a></li>
                        <li><a href="myflightbooking.php">Flight Booking</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-clock-o"></i>Travel Pal</a>
                    <ul>
                        <li><a href="findpal.php">Find Pal</a></li>
                        <li><a href="messages.php">Messages</a></li>
                    </ul>
                </li>
            </ul>

            <ul data-submenu-title="Account">
                <li class="active" ><a href="editprofile.php"><i class="sl sl-icon-user"></i>My Profile</a></li>
            </ul>
            <?php
            }
            ?>

        </div>
    </div>

    <!-- Navigation / End -->


    <!-- Content
    ================================================== -->
    <div class="dashboard-content">

        <!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>My Profile</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>My Profile</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">

            <?php
            if($profile==0){
            ?>
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <div class="dashboard-list-box-static">

                        <form enctype="multipart/form-data" action="includes/editprofile.php" method="post" onsubmit="return profileValidator()">
                            <!-- Details -->
                            <div class="my-profile">

                                <input name="userid" hidden value="<?php echo $userid; ?>" >

                                <label>Name<span style="color: red; font-size: 22px" > *</span></label>
                                <input required id="name" name="name" type="text" value="<?php echo $username; ?>" >

                                <label>Gender</label>
                                <select name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>

                                <label>Travelling From<span style="color: red; font-size: 22px" > *</span></label>
                                <input id="from" required name="from" type="text"  >

                                <label>Travelling To<span style="color: red; font-size: 22px" > *</span></label>
                                <input id="to" required name="to" type="text" >

                                <label>Travelling Month<span style="color: red; font-size: 22px" > *</span></label>
                                <input required name="month" type="month"  >

                                <label>Age<span style="color: red; font-size: 22px" > *</span></label>
                                <input required name="age" type="number" >

                                <label>Interest<span style="color: red; font-size: 22px" > *</span></label>
                                <input required name="interest" type="text"  >

                                <label>Languages<span style="color: red; font-size: 22px" > *</span></label>
                                <input required name="language" type="text"  >

                                <label>Phone</label>
                                <input  name="phone" type="text"  >

                                <label>Smoker-Box</label>
                                <select name="smoker">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>

                                <label>Drinking-Box</label>
                                <select name="drink">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>

                                <label>About Me</label>
                                <textarea name="about" ></textarea>

                                <label>Add Picture<span style="color: red; font-size: 22px" > *</span></label>
                                <input required name="file" type="file" >

                            </div>

                            <button name="addprofile" type="submit" class="button margin-top-15">Add Profile</button>
                        </form>

                    </div>
                </div>
            </div>

            <?php
            }
            else{
            ?>
            <!-- Profile -->
            <div class="col-lg-6 col-md-6">
                <div class="dashboard-list-box margin-top-0">
                    <div class="dashboard-list-box-static">
                        <form action="includes/editprofile.php" method="post" onsubmit="return profileValidator()">
                            <!-- Details -->
                            <div class="my-profile">

                                <input name="userid" hidden value="<?php echo $userid; ?>" >

                                <label>Name</label>
                                <input required id="name" name="name" type="text" value="<?php echo $username; ?>" >

                                <?php

                                $sql = "SELECT * from profile where user_id= '$userid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $name=$row["name"];
                                    $u_name=$row["username"];
                                    $gender=$row["gender"];
                                    $from=$row["travelling_from"];
                                    $to=$row["travelling_to"];
                                    $month=$row["travelling_month"];
                                    $age=$row["age"];
                                    $interest=$row["interest"];
                                    $language=$row["language"];
                                    $phone=$row["phone"];
                                    $smoker=$row["smoker_box"];
                                    $drink=$row["drinking_box"];
                                    $about=$row["about"];
                                    $pic=$row['pic'];
                                    }
                                }
                                ?>
                                <label>Username</label>
                                <input disabled type="text" value="<?php echo $u_name;?>" >

                                <label>Gender</label>
                                <input name="gender" type="text" value="<?php echo $gender;?>" >

                                <label>Travelling From</label>
                                <input id="from" name="from" type="text" value="<?php echo $from;?>" >

                                <label>Travelling To</label>
                                <input id="to" name="to" type="text" value="<?php echo $to;?>" >

                                <label>Travelling Month</label>
                                <input name="month" type="text" value="<?php echo $month;?>" >

                                <label>Age</label>
                                <input name="age" type="text" value="<?php echo $age;?>" >

                                <label>Interest</label>
                                <input name="interest" type="text" value="<?php echo $interest;?>" >

                                <label>Languages</label>
                                <input name="language" type="text" value="<?php echo $language;?>" >

                                <label>Phone</label>
                                <input  name="phone" type="text" value="<?php echo $phone;?>" >

                                <label>Smoker-Box</label>
                                <input name="smoker" type="text" value="<?php echo $smoker;?>" >

                                <label>Drinking-Box</label>
                                <input name="drink" type="text" value="<?php echo $drink;?>" >

                                <label>About Me</label>
                                <input name="about" type="text" value="<?php echo $about;?>" >
                            </div>
                            <button name="editprofile" type="submit" class="button margin-top-15">Make Changes</button>
                    </form>

                    </div>
                </div>
            </div>

                <div class="col-lg-6 col-md-6">
                    <div class="dashboard-list-box margin-top-0">
                        <div class="dashboard-list-box-static">
                             <!-- Details -->
                            <form enctype="multipart/form-data" action="includes/editprofile.php" method="post">
                            <div class="edit-profile-photo">
                                <img src="<?php echo 'includes/'.$pic?>" alt="">

                                <div class="change-photo-btn">
                                    <div class="photoUpload">
                                        <span><i class="fa fa-upload"></i>Change Picture</span>
                                        <input name="userid" hidden value="<?php echo $userid; ?>" >
                                        <input required name="file" type="file" class="upload" />
                                    </div>
                                </div>

                            </div>
                            <button name="changepic" type="submit" class="button margin-top-15">Change Picture</button>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="col-lg-6 col-md-6">
                    <br><br><br>
                    <div class="dashboard-list-box margin-top-0">
                        <div class="dashboard-list-box-static">
                            <form action="includes/deleteprofile.php" method="post">
                                <!-- Details -->
                                <div class="my-profile">
                                    <input name="userid" hidden value="<?php echo $userid; ?>" >
                                    <input style="width: 20px" name="sure" required type="checkbox" >

                                </div>
                                <button name="deleteprofile" type="submit" class="button margin-top-15">Delete Account</button>
                            </form>

                        </div>
                    </div>
                </div>


            <?php
            }
            ?>

        </div>

    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->


<script src="js/validation.js" ></script>