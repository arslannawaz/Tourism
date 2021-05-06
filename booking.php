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
                <li ><a href="index.php"><i class="sl sl-icon-settings"></i>Home</a></li>
                <li ><a href="dashboard.php"><i class="sl sl-icon-settings"></i> Dashboard</a></li>

                <li class="active" ><a><i class="fa fa-clock-o"></i>Booking</a>
                    <ul>
                        <li><a href="booking.php">My Booking</a></li>
                        <li><a href="myflightbooking.php">Flight Booking</a></li>
                    </ul>
                </li>

                <li ><a><i class="fa fa-clock-o"></i>Travel Pal</a>
                    <ul>
                        <li><a href="findpal.php">Find Pal</a></li>
                        <li><a href="messages.php">Messages</a></li>
                    </ul>
                </li>
            </ul>


            <ul data-submenu-title="Account">
                <li ><a href="editprofile.php"><i class="sl sl-icon-user"></i>My Profile</a></li>
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
                    <h2>Booking</h2>
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
                        $sql = "SELECT * from bookingplace where userid='$userid' order by id desc";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $date = $row["date"];
                                $time= $row["time"];
                                $placeid = $row["placeid"];
                                $statuss = $row['status'];

                                $status='Not Approved Yet';
                                if($statuss==1){
                                    $status='Approved';
                                }
                                else if($statuss==2){
                                    $status='Rejected';
                                }

                                $sql1 = "SELECT * from attractive_points where id='$placeid'";
                                $result1 = $conn->query($sql1);
                                if ($result1->num_rows > 0) {
                                    while ($row = $result1->fetch_assoc()) {
                                        $place_name = $row["name"];
                                        ?>

                                        <li>
                                            <div class="list-box-listing">
                                                <div class="list-box-listing-content">
                                                    <div class="inner">
                                                        <h3><?php echo $place_name; ?> </h3>
                                                        <h5>Date: <?php echo $date; ?> </h5>
                                                        <h5>Time: <?php echo $time; ?> </h5>
                                                        <h5>Booking: <?php echo $status; ?> </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="buttons-to-right">
                                                <a href="includes/approvereview.php?id=<?php /*echo $reviewid; */?>" class="button green">Approve</a>
                                                <a href="includes/deletereview.php?id=<?php /*echo $reviewid; */?>" class="button gray"><i class="sl sl-icon-close"></i> Delete</a>
                                            </div>-->
                                        </li>

                                        <?php
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
