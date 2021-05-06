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
    <a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i>Dashboard Navigation</a>

    <div class="dashboard-nav">
        <div class="dashboard-nav-inner">

            <ul data-submenu-title="Main">
                <li class="active"><a href="companydashboard.php"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
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
                <li><a href="editprofile.php"><i class="sl sl-icon-user"></i>My Profile</a></li>
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
                    <?php
                    $totalbus=0;
                    $sql = "SELECT * from flight_schedule";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        $totalbus = mysqli_num_rows($result);
                    }

                    ?>
                    <div class="dashboard-stat-content"><h4><?php echo $totalbus; ?></h4> <span>Active Flights</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Map2"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-2">
                    <?php
                    $totaluser=0;
                    $sql = "SELECT * from users";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        $totaluser = mysqli_num_rows($result);
                    }

                    ?>
                    <div class="dashboard-stat-content"><h4><?php echo $totalbus-1; ?></h4> <span>Total Users</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Line-Chart"></i></div>
                </div>
            </div>


            <!-- Item -->
            <?php
            $totalrev=0;
            $sql = "SELECT * from reviews where status=1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                $totalrev = mysqli_num_rows($result);
            }

            ?>
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-3">
                    <div class="dashboard-stat-content"><h4><?php echo $totalrev;?></h4> <span>Total Reviews</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Add-UserStar"></i></div>
                </div>
            </div>

            <!-- Item -->
            <?php
            $totalbus=0;
            $sql = "SELECT * from attractive_points";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                $totalplaces = mysqli_num_rows($result);
            }

            ?>
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-4">
                    <div class="dashboard-stat-content"><h4><?php echo $totalplaces; ?></h4> <span>Total Places</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Heart"></i></div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->
