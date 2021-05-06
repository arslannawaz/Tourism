<?php
ob_start();
//session_start();

include('includes/connection.php');
include('config.php');
include ('includes/app.php');

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
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
            $sql1 = "INSERT INTO `users` VALUES('','$username', '$useremail','auth from google',0)";
            mysqli_query($conn, $sql1);
            $userid=$_SESSION["id"];
        }

    }
}
else{
    if(!$_SESSION["id"]){
        header("location: index.php");
    }
    else{
        $userid=$_SESSION["id"];
        $username=$_SESSION["name"];
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
                <li class="active"><a href="dashboard.php"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
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
                <li><a href="editprofile.php"><i class="sl sl-icon-user"></i>My Profile</a></li>
            </ul>

            <?php
            }
            else{
             header('location:editprofile.php');
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
                    <h2>Howdy, <?php echo $username; ?> !</h2>

                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Dashboard</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>



        <!-- Content -->
        <div class="row">

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-1">
                    <div class="dashboard-stat-content"><h4>6</h4> <span>Total Flights</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Map2"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-2">
                    <div class="dashboard-stat-content"><h4>7</h4> <span>Total Views</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Line-Chart"></i></div>
                </div>
            </div>


            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-3">
                    <div class="dashboard-stat-content"><h4>95</h4> <span>Total Reviews</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Add-UserStar"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-4">
                    <div class="dashboard-stat-content"><h4>12</h4> <span>Times Bookmarked</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Heart"></i></div>
                </div>
            </div>
        </div>



    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->
