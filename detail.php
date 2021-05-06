<?php
ob_start();


include('config.php');

$facebook_output = '';
$facebook_helper = $facebook->getRedirectLoginHelper();
$facebook_permissions = ['email']; // Optional permissions
$facebook_login_url = $facebook_helper->getLoginUrl('https://127.0.0.1/Tourism/panel.php', $facebook_permissions);
// Render Facebook login button
$facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"><img alt="facebook" src="images/facebook.png" /></a></div>';

$login_button = '';
if(!isset($_SESSION['access_token']))
{
    //Create a URL to obtain user authorization
    $login_button = '<a href="'.$google_client->createAuthUrl().'"><img alt="google" src="images/signingoogle.png"></a>';
}

if (isset($_GET['id'])) {
    $placeid = $_GET['id'];
}

if (isset($_SESSION["id"])) {
    $userid = $_SESSION["id"];
    $username = $_SESSION["name"];
}

?>
<!DOCTYPE html>
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Travel Dublin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main-color.css" id="colors">

</head>

<body>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header Container
    ================================================== -->
    <header id="header-container">

        <!-- Header -->
        <div id="header">
            <div class="container">

                <!-- Left Side Content -->
                <div class="left-side">

                    <!-- Logo -->
                    <div id="logo">
                        <a href="index.php"><h4>Travel Dublin</h4></a>
                    </div>

                    <!-- Mobile Navigation -->
                    <div class="mmenu-trigger">
                        <button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
                        </button>
                    </div>

                    <!-- Main Navigation -->
                    <nav id="navigation" class="style-1">
                        <ul id="responsive">
                            <li><a  href="about.php">About Dublin</a></li>
                            <?php
                            if(isset($userid)) { ?>
                                <li><a href="findpal.php">Travel Pal</a></li>
                                <?php
                            }
                            else{?>
                                <li><a onclick="alert('You need to login first!!')" href="#">Travel Pal</a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </nav>
                    <div class="clearfix"></div>
                    <!-- Main Navigation / End -->

                </div>
                <!-- Left Side Content / End -->

                <?php
                if(isset($userid)){
                    ?>
                    <div class="right-side">
                        <div class="header-widget">
                            <div class="user-menu">
                                <div class="user-name"><?php echo $username;?></div>
                                <ul>
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li><a href="logout.php"><i class="sl sl-icon-power"></i>Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                else{
                ?>

                <!-- Right Side Content / End -->
                <div class="right-side">
                    <div class="header-widget">
                        <a href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i>Sign In</a>
                    </div>
                </div>

                <?php
                }
                ?>
                <!-- Right Side Content / End -->
                <!-- Sign In Popup -->
                <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

                    <div class="small-dialog-header">
                        <h3>Sign In</h3>
                    </div>

                    <!--Tabs -->
                    <div class="sign-in-form style-1">

                        <ul class="tabs-nav">
                            <li class=""><a href="#tab1">Log In</a></li>
                            <li><a href="#tab2">Register</a></li>
                        </ul>

                        <div class="tabs-container alt">

                            <!-- Login -->
                            <div class="tab-content" id="tab1" style="display: none;">
                                <form method="post" class="login">

                                    <p class="form-row form-row-wide">
                                        <label for="username">Email:<span style="color: red; font-size: 22px" > *</span>
                                            <i class="im im-icon-Male"></i>
                                            <input required type="email" class="input-text" name="email" id="username" value="" />
                                        </label>
                                    </p>

                                    <p class="form-row form-row-wide">
                                        <label for="password">Password:<span style="color: red; font-size: 22px" > *</span>
                                            <i class="im im-icon-Lock-2"></i>
                                            <input required minlength="6" class="input-text" type="password" name="password" id="password"/>
                                        </label>

                                    </p>

                                    <div class="form-row">
                                        <input type="submit" class="button border margin-top-5" name="login" value="Login" />
                                    </div>
                                </form>
                                <?php
                                echo '<div class="button border margin-top-5">'.$login_button . '</div>';
                                echo $facebook_login_url;
                                ?>

                                <?php
                                include('includes/connection.php');
                                if(isset($_POST["login"])){
                                    $email=$_POST['email'];
                                    $pass=$_POST['password'];

                                    $d_email='';
                                    $d_password='';
                                    $d_id;
                                    $d_name='';
                                    $status='';
                                    $sql = "SELECT * from users" . " where email= '$email'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            $d_email=$row["email"];
                                            $d_password=$row["password"];
                                            $d_id=$row["id"];
                                            $d_name=$row["name"];
                                            $status=$row["status"];

                                        }
                                    } else {
                                        //echo "0 results";
                                    }

                                    if($d_password==$pass && $status==1) {
                                        session_start();
                                        $_SESSION['id']=$d_id;
                                        $_SESSION['name']=$d_name;
                                        $_SESSION['email']=$d_email;
                                        header("location: dashboard.php");
                                    }
                                    else{
                                        echo '<script language="javascript">';
                                        echo 'alert("Incorrect Credentials!")';
                                        echo '</script>';
                                        echo "<h4 style='color:red;'>Incorrect Credentials!</h4>";
                                    }
                                }
                                ?>

                            </div>

                            <!-- Register -->
                            <div class="tab-content" id="tab2" style="display: none;">

                                <form action="includes/register.php" method="post" class="register" onsubmit="return registerValidator()">

                                    <p class="form-row form-row-wide">
                                        <label for="username2">Name:<span style="color: red; font-size: 22px" > *</span>
                                            <i class="im im-icon-Male"></i>
                                            <input required type="text" class="input-text" name="name" id="username2" value="" />
                                        </label>
                                    </p>

                                    <p class="form-row form-row-wide">
                                        <label for="email2">Email Address:<span style="color: red; font-size: 22px" > *</span>
                                            <i class="im im-icon-Mail"></i>
                                            <input required type="email" class="input-text" name="email" id="email2" value="" />
                                        </label>
                                    </p>

                                    <p class="form-row form-row-wide">
                                        <label for="password1">Password:<span style="color: red; font-size: 22px" > *</span>
                                            <i class="im im-icon-Lock-2"></i>
                                            <input required minlength="6" class="input-text" type="password" name="password" id="password1"/>
                                        </label>
                                    </p>

                                    <input type="submit" class="button border fw margin-top-10" name="register" value="Register" />
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Sign In Popup / End -->

            </div>
        </div>
        <!-- Header / End -->

    </header>

    <div class="clearfix"></div>
    <!-- Header Container / End -->

    <!-- Content
    ================================================== -->

    <?php
    $sql = "SELECT * from attractive_points where id='$placeid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $name = $row["name"];
    $address= $row["address"];
    $category = $row["category"];
    $file = $row["pic"];
    $id= $row['id'];
        $des=$row['description'];
        $loc=$row['location'];
        }
    }
    ?>


    <div class="container">
        <div class="row sticky-wrapper">
            <div class="col-lg-8 col-md-8 padding-right-30">

                <!-- Titlebar -->
                <div id="titlebar" class="listing-titlebar">
                    <div class="listing-titlebar-title">
                        <h2><?php echo $name ?> <span class="listing-tag"><?php echo $category ?></span></h2>
                        <span>
						<a href="#listing-location" class="listing-address">
							<i class="fa fa-map-marker"></i>
							<?php echo $address ?>
						</a>
					</span>
                    </div>
                </div>

                <!-- Listing Nav -->
                <div id="listing-nav" class="listing-nav-container">
                    <ul class="listing-nav">
                        <li><a href="#listing-overview" class="active">Overview</a></li>
                        <li><a href="#listing-reviews">Reviews</a></li>
                    </ul>
                </div>

                <!-- Overview -->
                <div id="listing-overview" class="listing-section">

                    <!-- Description -->

                    <p>
                        <?php echo $des; ?>
                    </p>

                    <div class="clearfix"></div>
                </div>

                <!-- Location -->
                <div id="listing-location" class="listing-section">
                    <h3 class="listing-desc-headline margin-top-60 margin-bottom-30">Location</h3>

                    <div id="singleListingMap-container">
                        <?php echo $loc;?>
                    </div>
                </div>

                <!-- Reviews -->
                <div id="listing-reviews" class="listing-section">
                    <h3 class="listing-desc-headline margin-top-75 margin-bottom-20">Reviews</h3>

                    <div class="clearfix"></div>

                    <!-- Reviews -->
                    <section class="comments listing-reviews">
                        <ul>
                            <?php
                            $sql = "SELECT * from reviews where place_id='$placeid' and status=1 && type='place'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $name = $row["name"];
                                $review=$row['detail'];
                                $uid=$row['user_id'];

                                if($name!='Anonymous'){
                                $sql1 = "SELECT * from profile where user_id= '$uid'";
                                $result1 = $conn->query($sql1);
                                if ($result1->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result1->fetch_assoc()) {
                                        $pic = 'includes/' . $row["pic"];
                                    }
                                }
                                }
                                else{
                                    $pic = 'images/happy-client-01.jpg';
                                }
                                        ?>
                                        <li>
                                            <div class="avatar"><img src="<?php echo $pic; ?>" alt=""/></div>
                                            <div class="comment-content">
                                                <div class="comment-by"><?php echo $name; ?><i class="tip"
                                                                                               data-tip-content="Person who left this review actually was a customer"></i>
                                                </div>
                                                <p><?php echo $review; ?></p>
                                            </div>
                                        </li>
                                        <?php
                                }
                            }
                            else{
                            ?>
                                <li>
                                    <div class="comment-content">
                                        <div class="comment-by">No Review Found</div
                                        <p></p>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </section>
                </div>

                <?php
                if(isset($userid)){
                $sql = "SELECT * from reviews where  user_id='$userid' && place_id='$placeid' && type='place'";
                $result = $conn->query($sql);
                if (!$result->num_rows > 0) {

                ?>

                <div id="add-review" class="add-review-box">

                    <!-- Add Review -->
                    <h3 class="listing-desc-headline margin-bottom-10">Add Review</h3>
                    <!-- Review Comment -->
                    <form method="post" action="includes/addreview.php" id="add-comment" class="add-comment">
                        <input name="placeid" hidden value="<?php echo $id; ?>" >
                        <input name="userid" hidden value="<?php echo $userid; ?>" >
                            <div>
                                <label>Review:<span style="color: red; font-size: 22px" > *</span></label>
                                <textarea name="review" required cols="40" rows="1"></textarea>
                            </div>
                        <button class="button" name="addreview">Submit Review</button>
                        <button class="button" name="addanonreview">Submit Review as Anonymous</button>

                        <div class="clearfix"></div>
                    </form>

                </div>

                <?php
                    }
                }
                ?>


            </div>


            <!-- Sidebar
            ================================================== -->
            <div class="col-lg-4 col-md-4 margin-top-75 sticky">

                <!-- Book Now -->
                <div id="booking-widget-anchor" class="boxed-widget booking-widget margin-top-35">
                    <h3><i class="fa fa-calendar-check-o "></i> Booking</h3>
                    <div class="row with-forms  margin-top-0">

                        <form method="post" action="includes/makebooking.php">

                        <input name="placeid" hidden value="<?php echo $id; ?>" >
                        <input name="userid" hidden value="<?php echo $userid; ?>" >

                        <div class="col-lg-12">
                            <input required type="text" name="date" id="date-picker" placeholder="Date" readonly="readonly">
                        </div>

                        <!-- Panel Dropdown -->
                        <div class="col-lg-12">
                            <div class="panel-dropdown time-slots-dropdown">
                                <input required name="time" type="time">
                            </div>
                        </div>
                        <!-- Panel Dropdown / End -->

                        <!-- Panel Dropdown -->
                        <div class="col-lg-12">
                            <div class="panel-dropdown">
                                <a href="#">Guests <span class="qtyTotal" >1</span></a>
                                <div class="panel-dropdown-content">
                                    <div class="qtyButtons">
                                        <input required type="text" name="qtyInput" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Panel Dropdown / End -->
                            <?php
                            if(isset($userid)) { ?>
                                <button  name="bookingplace" class="button book-now fullwidth margin-top-5">Request To Book</button>
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                    <?php
                    if(!isset($userid)) { ?>
                    <button onclick="alert('You need to login first!!')" class="button book-now fullwidth margin-top-5">Request To Book</button>
                    <?php
                    }
                    ?>
                    <!-- Book Now -->
                </div>
                <!-- Book Now / End -->
            </div>
            <!-- Sidebar / End -->
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->


<!-- Scripts
================================================== -->
<script type="text/javascript" src="scripts/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery-migrate-3.1.0.min.js"></script>
<script type="text/javascript" src="scripts/mmenu.min.js"></script>
<script type="text/javascript" src="scripts/chosen.min.js"></script>
<script type="text/javascript" src="scripts/slick.min.js"></script>
<script type="text/javascript" src="scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="scripts/waypoints.min.js"></script>
<script type="text/javascript" src="scripts/counterup.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="scripts/tooltips.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script src="js/validation.js" ></script>

<!-- Maps -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script type="text/javascript" src="scripts/infobox.min.js"></script>
<script type="text/javascript" src="scripts/markerclusterer.js"></script>
<script type="text/javascript" src="scripts/maps.js"></script>

<!-- Booking Widget - Quantity Buttons -->
<script src="scripts/quantityButtons.js"></script>

<!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
<script src="scripts/moment.min.js"></script>
<script src="scripts/daterangepicker.js"></script>
<script>
    // Calendar Init
    $(function() {
        $('#date-picker').daterangepicker({
            "opens": "left",
            singleDatePicker: true,

            // Disabling Date Ranges
            isInvalidDate: function(date) {
                // Disabling Date Range
                var disabled_start = moment('09/02/2018', 'MM/DD/YYYY');
                var disabled_end = moment('09/06/2018', 'MM/DD/YYYY');
                return date.isAfter(disabled_start) && date.isBefore(disabled_end);

                // Disabling Single Day
                // if (date.format('MM/DD/YYYY') == '08/08/2018') {
                //     return true;
                // }
            }
        });
    });

    // Calendar animation
    $('#date-picker').on('showCalendar.daterangepicker', function(ev, picker) {
        $('.daterangepicker').addClass('calendar-animated');
    });
    $('#date-picker').on('show.daterangepicker', function(ev, picker) {
        $('.daterangepicker').addClass('calendar-visible');
        $('.daterangepicker').removeClass('calendar-hidden');
    });
    $('#date-picker').on('hide.daterangepicker', function(ev, picker) {
        $('.daterangepicker').removeClass('calendar-visible');
        $('.daterangepicker').addClass('calendar-hidden');
    });
</script>


<!-- Replacing dropdown placeholder with selected time slot -->
<script>
    $(".time-slot").each(function() {
        var timeSlot = $(this);
        $(this).find('input').on('change',function() {
            var timeSlotVal = timeSlot.find('strong').text();

            $('.panel-dropdown.time-slots-dropdown a').html(timeSlotVal);
            $('.panel-dropdown').removeClass('active');
        });
    });
</script>


</body>
</html>

