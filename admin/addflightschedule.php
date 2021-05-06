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
                <li class="active" ><a><i class="fa fa-clock-o"></i>Flights Schedule</a>
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
                    <h2>Add Flight Schedule</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Add Flight Schedule</li>
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

                        <form action="includes/addschedule.php" method="post" onsubmit="return flightValidator()">
                        <!-- Details -->
                        <div class="my-profile">

                            <label>Departure<span style="color: red; font-size: 22px" > *</span></label>
                            <input id="departure" required name="departure" type="text">

                            <label>Arrival<span style="color: red; font-size: 22px" > *</span></label>
                            <input id="arrival" required name="arrival" type="text">

                            <label>Departure Date<span style="color: red; font-size: 22px" > *</span></label>
                            <input required name="date" type="date">

                            <label>Return Date<span style="color: red; font-size: 22px" > *</span></label>
                            <input required name="returndate" type="date">

                            <label>Time<span style="color: red; font-size: 22px" > *</span></label>
                            <input required name="time" type="time">

                            <label>Fair<span style="color: red; font-size: 22px" > *</span></label>
                            <input required name="fair" type="number">

                            <label>Total Seats<span style="color: red; font-size: 22px" > *</span></label>
                            <input required name="seats" value="44" type="number">

                            <label>Airline<span style="color: red; font-size: 22px" > *</span></label>
                            <input id="company" required name="company" type="text">

                        </div>

                        <button name="addschedule" type="submit" class="button margin-top-15">Add Schedule</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->

<script>
    function flightValidator() {
        var departure = document.getElementById('departure').value;
        var arrival = document.getElementById('arrival').value;
        var airline = document.getElementById('company').value;

        var letters = /^[a-zA-Z ]+$/;
        if(!departure.match(letters))
        {
            alert("Departure field should have only alphabet");
            return false;
        }

        if(!arrival.match(letters))
        {
            alert("Arrival field should have only alphabet");
            return false;
        }

        if(!airline.match(letters))
        {
            alert("Company name should have only alphabet");
            return false;
        }
    }
</script>