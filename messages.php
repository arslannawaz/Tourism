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
                <li ><a><i class="fa fa-clock-o"></i>Booking</a>
                    <ul>
                        <li><a href="booking.php">My Booking</a></li>
                        <li><a href="myflightbooking.php">Flight Booking</a></li>
                    </ul>
                </li>
                <li class="active"><a><i class="fa fa-clock-o"></i>Travel Pal</a>
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
                    <h2>Messages</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Messages</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <?php
        $toid=[];
        $sql = "SELECT * from messages where sender_id='$userid' or to_id='$userid' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
         $toid[] = $row['from'];
        }
        }
        $array=array_diff($toid,[$userid]);
        $pal  = array_unique($array, SORT_REGULAR);
        $pal_id =  array_values(array_filter($pal));
        //print_r($pal_id);
        ?>

        <div class="row">

                <!-- Listings -->
                <div class="col-lg-12 col-md-12">

                    <div class="messages-container margin-top-0">
                        <div class="messages-headline">
                            <h4>Inbox</h4>
                        </div>

                        <div class="messages-inbox">
                            <ul>

                                <?php
                                for($i=0;$i<count($pal_id);$i++) {
                                    $sql = "SELECT * from profile where user_id='$pal_id[$i]' ";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ?>

                                            <li class="unread">
                                                <a href="conversation.php?to=<?php echo $row["user_id"] ?>">
                                                    <div class="message-avatar"><img src="includes/<?php echo $row['pic']; ?>" alt=""/></div>

                                                    <div class="message-by">
                                                        <div class="message-by-headline">
                                                            <h5><?php echo $row["name"];?></h5>
                                                        </div>
                                                    </div>
                                                </a>
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

    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->
