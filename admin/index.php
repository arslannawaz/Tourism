<?php
ob_start();
session_start();
session_destroy();
?>
<!DOCTYPE html>
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <title>Admin Panel</title>
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
                    <nav id="navigation" class="style-1"></nav>
                    <div class="clearfix"></div>
                    <!-- Main Navigation / End -->

                </div>
                <!-- Left Side Content / End -->


                <!-- Right Side Content / End -->
                <div class="right-side">
                    <div class="header-widget">
                        <a href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i>Sign In</a>
                    </div>
                </div>
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
                        </ul>

                        <div class="tabs-container alt">

                            <!-- Login -->
                            <div class="tab-content" id="tab1" style="display: none;">
                                <form method="post" action="index.php" class="login">

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
                                include('includes/connection.php');
                                if(isset($_POST["login"])){
                                    $email=$_POST['email'];
                                    $pass=$_POST['password'];
                                    $d_email='';
                                    $d_password='';
                                    $d_id;
                                    $d_name='';
                                    $sql = "SELECT * from users where email= '$email'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                               $d_email=$row["email"];
                                               $d_password=$row["password"];
                                               $d_id=$row["id"];
                                                $d_name=$row["name"];
                                        }
                                    } else {
                                        //echo "0 results";
                                    }

                                    if($d_password==$pass) {
                                            if($d_name=='Admin'){
                                                session_start();
                                                $_SESSION['id']=$d_id;
                                                $_SESSION['name']=$d_name;
                                                header("location: companydashboard.php");
                                            }
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

                                <form method="post" class="register" action="" >

                                    <p class="form-row form-row-wide">
                                        <label for="username2">Name:<span style="color: red; font-size: 22px" > *</span>
                                            <i class="im im-icon-Male"></i>
                                            <input type="text" class="input-text" name="name" id="username2" value="" />
                                        </label>
                                    </p>

                                    <p class="form-row form-row-wide">
                                        <label for="email2">Email Address:<span style="color: red; font-size: 22px" > *</span>
                                            <i class="im im-icon-Mail"></i>
                                            <input type="text" class="input-text" name="email" id="email2" value="" />
                                        </label>
                                    </p>

                                    <p class="form-row form-row-wide">
                                        <label for="password1">Password:<span style="color: red; font-size: 22px" > *</span>
                                            <i class="im im-icon-Lock-2"></i>
                                            <input class="input-text" type="password" name="password" id="password1"/>
                                        </label>
                                    </p>

                                    <p class="form-row form-row-wide">
                                        <label for="type">Company Name:
                                            <select class="input-text" name="company">
                                                <option value="Niazi Travel" >Niazi Travels</option>
                                                <option value="Bilal Travels">Bilal Travels</option>
                                                <option value="Daewoo">Daewoo</option
                                            </select>
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


    <!-- Banner
    ================================================== -->
    <div class="main-search-container dark-overlay">
        <div class="main-search-inner">
            <div class="container"></div>
        </div>

        <!-- Video -->
        <div class="video-container">
            <video poster="images/main-search-video-poster.jpg" loop autoplay muted>
                <source src="images/main-search-video.mp4" type="video/mp4">
            </video>
        </div>

    </div>

    <?php
    include 'footer.php';
    ?>

    <!-- Back To Top Button -->
    <div id="backtotop"><a href="#"></a></div>


</div>
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

<!-- Google Autocomplete -->
<script>
    function initAutocomplete() {
        var input = document.getElementById('autocomplete-input');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
        });

        if ($('.main-search-input-item')[0]) {
            setTimeout(function(){
                $(".pac-container").prependTo("#autocomplete-container");
            }, 300);
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete"></script>

<!-- Style Switcher
================================================== -->
<script src="scripts/switcher.js"></script>

<div id="style-switcher">
    <h2>Color Switcher <a href="#"><i class="sl sl-icon-settings"></i></a></h2>

    <div>
        <ul class="colors" id="color1">
            <li><a href="#" class="main" title="Main"></a></li>
            <li><a href="#" class="blue" title="Blue"></a></li>
            <li><a href="#" class="green" title="Green"></a></li>
            <li><a href="#" class="orange" title="Orange"></a></li>
            <li><a href="#" class="navy" title="Navy"></a></li>
            <li><a href="#" class="yellow" title="Yellow"></a></li>
            <li><a href="#" class="peach" title="Peach"></a></li>
            <li><a href="#" class="beige" title="Beige"></a></li>
            <li><a href="#" class="purple" title="Purple"></a></li>
            <li><a href="#" class="celadon" title="Celadon"></a></li>
            <li><a href="#" class="red" title="Red"></a></li>
            <li><a href="#" class="brown" title="Brown"></a></li>
            <li><a href="#" class="cherry" title="Cherry"></a></li>
            <li><a href="#" class="cyan" title="Cyan"></a></li>
            <li><a href="#" class="gray" title="Gray"></a></li>
            <li><a href="#" class="olive" title="Olive"></a></li>
        </ul>
    </div>

</div>
<!-- Style Switcher / End -->


</body>
</html>

