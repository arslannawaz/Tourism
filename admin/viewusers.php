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
                <li class="active" ><a href="viewusers.php"><i class="fa fa-calendar-check-o"></i>Users</a></li>
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
                    <h2>View Users</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>View Users</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4>Users</h4>
                    <ul>

                        <?php
                        $sql = "SELECT * from users order by name";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $name = $row["name"];
                                $email= $row["email"];
                                $id= $row['id'];
                                $status=$row['status'];
                                if($id!=8) {
                                    ?>

                                    <li>
                                        <div class="list-box-listing">
                                            <div class="list-box-listing-img"><a href="#"><img
                                                            src="images/listing-item-02.jpg" alt=""></a></div>
                                            <div class="list-box-listing-content">
                                                <div class="inner">
                                                    <h3><?php echo $name; ?> </h3>
                                                    <h5><?php echo $email; ?> </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttons-to-right">
                                            <?php if($status==1){ ?>
                                            <a href="includes/blockuser.php?id=<?php echo $id; ?>" class="button green">Block</a>
                                            <?php }
                                            else{?>
                                            <a href="includes/unblockuser.php?id=<?php echo $id; ?>" class="button green">Unblock</a>
                                            <?php }
                                            ?>
                                        </div>
                                    </li>

                                    <?php
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
