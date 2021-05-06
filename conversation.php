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

if($_GET["to"]){
    $to_id=$_GET["to"];
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

        <div class="row">

            <!-- Listings -->
            <div class="col-lg-12 col-md-12">

            <?php
            $sql = "SELECT * from profile where user_id= '$to_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $to_name=$row["name"];
                    $pic=$row['pic'];
                }
            }
            ?>

                <?php
                $date=null;
                $msg=null;
                $sql = "SELECT * from messages where to_id='$to_id' and sender_id='$userid' order by id desc limit 1";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $date=$row["time"];
                        $msg=$row["message"];
                        $toid=$row['to_id'];
                    }
                }
                ?>

                <div class="messages-container margin-top-0">
                    <div class="messages-headline">
                        <h4><?php echo $to_name?></h4>
                    </div>

                    <div class="messages-container-inner">

                        <!-- Messages -->
                        <div class="messages-inbox">
                            <ul>
                                <li class="active-message">
                                    <a href="conversation.php?to=<?php echo $to_id?>">
                                        <div class="message-avatar"><img src="includes/<?php echo $pic; ?>" alt="" /></div>

                                        <div class="message-by">
                                            <div class="message-by-headline">
                                                <h5><?php echo $to_name?></h5>
                                                <span><?php echo $date?></span>
                                            </div>
                                            <p><?php echo $msg?></p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Messages / End -->

                        <!-- Message Content -->
                        <div class="message-content">

                            <input hidden id="to" value="<?php echo $to_id?>" >
                            <input hidden id="from" value="<?php echo $userid?>" >

                            <span id="hide"></span>


                            <!-- Reply Area -->
                            <div class="clearfix"></div>
                            <div class="message-reply">
                                <form action="includes/sendtext.php" method="post">
                                <input required type="text" id="msg" name="msg" placeholder="Your Message">
                                <input hidden name="to_id" id="to_id" value="<?php echo $to_id?>" >
                                <input hidden name="from_id" id="from_id" value="<?php echo $userid?>" >
                                <button name="sendmsg" class="button">Send Message</button>
                                </form>
                            </div>

                            <div id="hide"></div>

                        </div>
                        <!-- Message Content -->

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- Content / End -->


</div>
<!-- Dashboard / End -->

<script>

    window.setTimeout(function(){
        getText();
    }, 1000);

    function  getText() {
        var str = new  Array();
        var a= document.getElementById("to").value;
        var b= document.getElementById("from").value;

        str.push(a);
        str.push(b);

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
        xhttp.open("GET", "gettext.php?q="+str,  true);
        xhttp.send();
    }
</script>