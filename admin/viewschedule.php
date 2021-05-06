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
                <li class="active"><a><i class="fa fa-clock-o"></i>Flights Schedule</a>
                    <ul>
                        <li><a href="addflightschedule.php">Add Schedule</a></li>
                        <li><a href="viewschedule.php">View Schedule</a></li>
                    </ul>
                </li>
            </ul>


            <ul data-submenu-title="Account">
                <li><a href="editprofile.php"><i class="sl sl-icon-user"></i> My Profile</a></li>
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
                    <h2>View Schedule</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>View Schedule</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">


            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4>Flight Schedule</h4>
                    <ul>

                    <?php
                    $sql = "SELECT * from flight_schedule order by id desc";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $departure = $row["departure"];
                            $arrival= $row["arrival"];
                            $date = $row["date"];
                            $retdate = $row["return_date"];
                            $time = $row["time"];
                            $id= $row['id'];
                            ?>

                            <li>
                                <div class="list-box-listing">
                                    <div class="list-box-listing-img"><a href="#"><img src="images/listing-item-02.jpg" alt=""></a></div>
                                    <div class="list-box-listing-content">
                                        <div class="inner">
                                            <h3><?php echo $departure; ?> to <?php echo $arrival;?>  </h3>
                                            <span>Flight Date: <?php echo $date; ?></span>&nbsp;&nbsp;&nbsp;<span><?php echo $time; ?></span><br>
                                            <span>Return Date: <?php echo $retdate; ?></span>&nbsp;&nbsp;&nbsp;

                                        </div>
                                    </div>
                                </div>
                                <div class="buttons-to-right">
                                    <a href="editschedule.php?id=<?php echo $id; ?>" class="button gray">Edit</a>
                                    <a href="includes/deleteschedule.php?id=<?php echo $id; ?>" class="button gray"><i class="sl sl-icon-close"></i> Delete</a>
                                </div>
                            </li>

                            <?php
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
