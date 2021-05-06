<?php
ob_start();
session_start();
include('includes/connection.php');
include ('includes/app.php');

if(!$_SESSION["id"]){
    header("location: index.php");
}
else{
    $userid=$_SESSION["id"];
    $username=$_SESSION["name"];
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

            <ul data-submenu-title="Main">
                <li><a href="companydashboard.php"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
                <li ><a href="viewusers.php"><i class="fa fa-calendar-check-o"></i> Users</a></li>
                <li ><a href="bookingplace.php"><i class="sl sl-icon-settings"></i>Dublin Booking</a></li>
                <li ><a href="flightbooking.php"><i class="sl sl-icon-settings"></i>Flight Booking</a></li>
                <li ><a href="approvereview.php"><i class="fa fa-calendar-check-o"></i>Approve Reviews</a></li>
                <li><a><i class="fa fa-clock-o"></i>Attractive Places</a>
                    <ul>
                        <li><a href="addplace.php">Add Place</a></li>
                        <li><a href="viewplace.php">View Place</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-clock-o"></i>Flights Schedule</a>
                    <ul>
                        <li><a href="addflightschedule.php">Add Schedule</a></li>
                        <li><a href="viewschedule.php">View Schedule</a></li>
                    </ul>
                </li>
            </ul>


            <ul data-submenu-title="Account">
                <li  class="active" ><a href="editprofile.php"><i class="sl sl-icon-user"></i> My Profile</a></li>
                <li><a href="index.php"><i class="sl sl-icon-power"></i>Logout</a></li>
            </ul>

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
                    <h2>Edit Profile</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Edit Profile</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Profile -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <div class="dashboard-list-box-static">

                        <form action="includes/editprofile.php" method="post">
                            <!-- Details -->
                            <div class="my-profile">

                                <input name="userid" hidden value="<?php echo $userid; ?>" >

                                <label>Name</label>
                                <input name="name" type="text" value="<?php echo $username; ?>" >

                                <?php

                                $sql = "SELECT * from users where id= '$userid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $d_email=$row["email"];
                                    $d_pass=$row["password"];
                                    }
                                }
                                ?>

                                <label>Email</label>
                                <input name="email" type="text" value="<?php echo $d_email;?>" >

                                <label>Password</label>
                                <input name="pass" type="text" value="<?php echo $d_pass;?>" >

                            </div>

                            <button name="editprofile" type="submit" class="button margin-top-15">Make Changes</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->
