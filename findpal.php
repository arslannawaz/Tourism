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
                    <h2>Find Pal</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Find Pal</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>



            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-4">
                        <div class="main-search-input-item location">
                            <div id="autocomplete-container">
                                <select onchange="dothis()" id="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="main-search-input-item location">
                            <div id="autocomplete-container">
                                <input onchange="dothis()" id="month" type="month" placeholder="Month of Travel">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="main-search-input-item location">
                            <div id="autocomplete-container">
                                <input onkeyup="dothis()" id="arrival" type="text" placeholder="Travelling to">
                            </div>
                            <a href="#"><i class="fa fa-map-marker"></i></a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="main-search-input-item location">
                            <div id="autocomplete-container">
                                <input onkeyup="dothis()" id="age" type="text" value="18" placeholder="From Age">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="main-search-input-item location">
                            <div id="autocomplete-container">
                                <input onkeyup="dothis()" id="age2" type="text" value="30" placeholder="To Age">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Listings -->

            <div class="row" id="hide" >

            </div>





    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->
<script src="https://momentjs.com/downloads/moment.min.js"></script>

<script>

    window.setTimeout(function(){
        dothis();
    }, 1000);

    function  dothis() {
        var str = new  Array();

        var aa= document.getElementById("month").value;
        var aaa=aa.split('-');
        var months = [ "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December" ];
        var monthIndex = moment().month(aaa[1]-1).format("M");
        var selectedMonthName = months[monthIndex-1];

        var b= document.getElementById("arrival").value;
        var cc = document.getElementById("gender");
        var c = cc.options[cc.selectedIndex].value;
        var d= document.getElementById("age").value;
        var e= document.getElementById("age2").value;


        str.push(selectedMonthName);
        str.push(b);
        str.push(c);
        str.push(d);
        str.push(e);

        var xhttp;
        if (!str) {
            document.getElementById("hide").innerHTML = "";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("hide").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "searchride.php?q="+str,  true);
        xhttp.send();
    }
</script>