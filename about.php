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

                                    if($d_password==$pass  && $status==1) {
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

                                <form action="includes/register.php" method="post" class="register" onsubmit="return registerValidator()" >

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

</div>

<div class="container">

    <!-- Blog Posts -->
    <div class="blog-page">
        <br><br>
        <div class="row">


            <!-- Post Content -->
            <div class="col-lg-12 col-md-12 padding-right-30">


                <!-- Blog Post -->
                <div class="blog-post single-post">

                    <!-- Img -->
                    <img class="post-img" src="images/dublin.jpg" alt="">


                    <!-- Content -->
                    <div class="post-content">

                        <h3>The Greatest Street Arts In Dublin</h3>


                        <p>Situated on a bay on the east coast, at the mouth of the River Liffey, it lies within the province of Leinster. It is bordered on the south by the Dublin Mountains, a part of the Wicklow Mountains range. It has an urban area population of 1,173,179,[7] while the population of the Dublin Region (formerly County Dublin) as of 2016 was 1,347,359. The population of the Greater Dublin Area was 1,904,806 per the 2016 census</p>

                        <div class="post-quote">
                            <span class="icon"></span>
                            <blockquote>
                                Dublin is a historical and contemporary centre for education, the arts, administration and industry. As of 2018 the city was listed by the Globalization and World Cities Research Network (GaWC) as a global city, with a ranking of "Alpha −", which places it amongst the top thirty cities in the world.
                            </blockquote>
                        </div>

                        <p>There is archaeological debate regarding precisely where Dublin was established by the Gaels in or before the 7th century AD.[16] Later expanded as a Viking settlement, the Kingdom of Dublin, the city became Ireland's principal settlement following the Norman invasion.[16] The city expanded rapidly from the 17th century and was briefly the second largest city in the British Empire before the Acts of Union in 1800. Following the partition of Ireland in 1922, Dublin became the capital of the Irish Free State, later renamed Ireland.</p>
                        <p>Dublin celebrated its 'official' millennium in 1988, meaning the Irish government recognised 988 as the year in which the city was settled and that this first settlement would later become the city of Dublin</p>


                        <div class="clearfix"></div>

                    </div>
                </div>
                <!-- Blog Post / End -->

            </div>
            <!-- Content / End -->


        </div>
        <!-- Sidebar / End -->


    </div>
</div>

<?php
include 'footer.php';
?>
<!-- Wrapper / End -->


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


<!-- Leaflet // Docs: https://leafletjs.com/ -->
<script src="scripts/leaflet.min.js"></script>
<script src="scripts/leaflet-markercluster.min.js"></script>
<script src="scripts/leaflet-gesture-handling.min.js"></script>
<script src="scripts/leaflet-listeo.js"></script>
<script src="scripts/leaflet-autocomplete.js"></script>
<script src="scripts/leaflet-control-geocoder.js"></script>


</body>
</html>

