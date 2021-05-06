<?php
ob_start();

session_start();
include('includes/connection.php');
include ('includes/app.php');

    if (!$_SESSION["id"]) {
        header("location: index.php");
    } else {
        $userid = $_SESSION["id"];
        $username = $_SESSION["name"];
    }

if($_GET["userprofile"]){
    $userprofileid=$_GET["userprofile"];
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

                <!-- Profile -->
                <div class="col-lg-6 col-md-6">
                    <div class="dashboard-list-box margin-top-0">
                        <div class="dashboard-list-box-static">
                                <!-- Details -->
                                <div class="my-profile">

                                    <?php

                                    $sql = "SELECT * from profile where user_id= '$userprofileid'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            $to_id=$row["user_id"];
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

                                    <label>Name</label>
                                    <input disabled name="name" type="text" value="<?php echo $name; ?>" >

                                    <label>Username</label>
                                    <input disabled type="text" value="<?php echo $u_name;?>" >

                                    <label>Gender</label>
                                    <input disabled name="gender" type="text" value="<?php echo $gender;?>" >

                                    <label>Travelling From</label>
                                    <input disabled name="from" type="text" value="<?php echo $from;?>" >

                                    <label>Travelling To</label>
                                    <input disabled name="to" type="text" value="<?php echo $to;?>" >

                                    <label>Travelling Month</label>
                                    <input disabled name="month" type="text" value="<?php echo $month;?>" >

                                    <label>Age</label>
                                    <input disabled name="age" type="text" value="<?php echo $age;?>" >

                                    <label>Interest</label>
                                    <input disabled name="interest" type="text" value="<?php echo $interest;?>" >

                                    <label>Languages</label>
                                    <input disabled name="language" type="text" value="<?php echo $language;?>" >

                                    <label>Phone</label>
                                    <input disabled name="phone" type="text" value="<?php echo $phone;?>" >

                                    <label>Smoker-Box</label>
                                    <input disabled name="smoker" type="text" value="<?php echo $smoker;?>" >

                                    <label>Drinking-Box</label>
                                    <input disabled name="drink" type="text" value="<?php echo $drink;?>" >

                                    <label>About Me</label>
                                    <input disabled name="about" type="text" value="<?php echo $about;?>" >
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="dashboard-list-box margin-top-0">
                        <div class="dashboard-list-box-static">
                            <!-- Details -->
                            <div class="edit-profile-photo">
                                <img src="<?php echo 'includes/'.$pic?>" alt="">
                            </div>
                            <a href="conversation.php?to=<?php echo $to_id; ?>" class="button gray"><i class=""></i>Send Message</a>

                        </div>
                    </div>
                </div>
        </div>

    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->
