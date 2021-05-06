
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
    $flightid = $_GET['id'];
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
    $sql = "SELECT * from flight_schedule where id='$flightid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $departure = $row["departure"];
            $arrival = $row["arrival"];
            $date = $row["date"];
            $time = $row["time"];
            $seat = $row["seats"];
            $fare = $row["fair"];
            $id = $row['id'];
            $airline=$row['company_name'];
        }
    }
    ?>

</div>

<!-- Container -->
<div class="container">
    <br><br>
    <div class="row">

        <!-- Content
        ================================================== -->
        <div class="col-lg-8 col-md-8 padding-right-30">

            <h3 class="margin-top-0 margin-bottom-30">Personal Details</h3>

            <div class="row">

                <form action="includes/makebooking.php" method="post" onsubmit="return bookingValidator()" >
                <input hidden name="flightid" value="<?php echo $flightid?>" >
                <input hidden name="userid" value="<?php echo $userid?>" >

                    <div class="col-md-6">
                    <label>First Name<span style="color: red; font-size: 22px" > *</span></label>
                    <input id="first" required name="firstname" type="text" value="">
                </div>

                <div class="col-md-6">
                    <label>Last Name<span style="color: red; font-size: 22px" > *</span></label>
                    <input id="last" required name="lastname" type="text" value="">
                </div>

                <div class="col-md-6">
                    <div class="input-with-icon medium-icons">
                        <label>E-Mail Address<span style="color: red; font-size: 22px" > *</span></label>
                        <input required name="email" type="email" value="">
                        <i class="im im-icon-Mail"></i>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-with-icon medium-icons">
                        <label>Total Tickets<span style="color: red; font-size: 22px" > *</span></label>
                        <input required name="seats" type="number" value="">
                    </div>
                </div>

                    <?php
                    if(isset($userid)) { ?>
                    <button name="flightbooking" class="button booking-confirmation-btn margin-top-40 margin-bottom-65">Book Now</button>
                    <?php
                    }
                    ?>

                </form>

                <?php
                if(!isset($userid)) { ?>
                    <button onclick="alert('You need to login first!!')" class="button book-now fullwidth margin-top-5">Book Now</button>
                    <?php
                }
                ?>


            </div>
        </div>


        <!-- Sidebar
        ================================================== -->
        <div class="col-lg-4 col-md-4 margin-top-0 margin-bottom-60">

            <!-- Booking Summary -->
            <div class="listing-item-container compact order-summary-widget">
                <div class="listing-item">
                    <img src="images/listing-item-04.jpg" alt="">

                    <div class="listing-item-content">
                        <h3><?php echo $airline ?></h3>
                        <span><?php echo $departure; ?> to <?php echo $arrival;?></span>
                    </div>
                </div>
            </div>
            <div class="boxed-widget opening-hours summary margin-top-0">
                <h3><i class="fa fa-calendar-check-o"></i> Booking Summary</h3>
                <ul>
                    <li>Date <span><?php echo $date; ?></span></li>
                    <li>Time <span><?php echo $time; ?></span></li>
                    <li class="total-costs">Total Cost <span>$<?php echo $fare; ?></span></li>
                </ul>

            </div>
            <!-- Booking Summary / End -->

        </div>

    </div>
</div>
<!-- Container / End -->


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

