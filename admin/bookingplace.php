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
                <li ><a href="companydashboard.php"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
                <li><a href="viewusers.php"><i class="fa fa-calendar-check-o"></i>Users</a></li>
                <li class="active" ><a href="bookingplace.php"><i class="sl sl-icon-settings"></i>Dublin Booking</a></li>
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
                    <h2>Bookings</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Booking</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4>Booking</h4>
                    <ul>

                        <?php
                        $sql = "SELECT * from bookingplace  order by id desc";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $date = $row["date"];
                                $time = $row["time"];
                                $placeid = $row["placeid"];
                                $u_id = $row["userid"];
                                $statuss = $row['status'];
                                $totalbooking = $row['total'];
                                $bookingplaceid = $row['id'];

                                $status = 'Not Approved Yet';
                                if ($statuss == 1) {
                                    $status = 'Approved';
                                }

                                $sql1 = "SELECT * from attractive_points where id='$placeid'";
                                $result1 = $conn->query($sql1);
                                if ($result1->num_rows > 0) {
                                    while ($row = $result1->fetch_assoc()) {
                                        $place_name = $row["name"];

                                        $sql2 = "SELECT * from users where id='$u_id' or email='$u_id' ";
                                        $result2 = $conn->query($sql2);
                                        if ($result2->num_rows > 0) {
                                            while ($row = $result2->fetch_assoc()) {
                                                $u_name = $row["name"];
                                                ?>

                                                <li>
                                                    <div class="list-box-listing">
                                                        <div class="list-box-listing-content">
                                                            <div class="inner">
                                                                <h3><?php echo $place_name; ?> </h3>
                                                                <h5>Date: <?php echo $date; ?> </h5>
                                                                <h5>Time: <?php echo $time; ?> </h5>
                                                                <h5>Number of Guests: <?php echo $totalbooking; ?> </h5>
                                                                <h5>Client Name: <?php echo $u_name; ?> </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="buttons-to-right">
                                                        <?php if($statuss==0){?>
                                                        <a href="includes/approvebookingplace.php?id=<?php echo $bookingplaceid; ?>" class="button green">Approve</a>
                                                        <?php }
                                                        else if($statuss==1){?>
                                                            <a href="#" class="button green">Approved</a>
                                                        <?php } ?>
                                                        <?php if($statuss==0 || $status==1){?>
                                                        <a href="includes/deletebookingplace.php?id=<?php echo $bookingplaceid; ?>" class="button gray"><i class="sl sl-icon-close"></i>Reject</a>
                                                        <?php }
                                                        else if($statuss==2){?>
                                                            <a href="#" class="button green">Rejected</a>
                                                        <?php } ?>
                                                </div>
                                                </li>

                                                <?php
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        ?>


                    </ul>
                </div>
            </div>

        </div>

    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->
