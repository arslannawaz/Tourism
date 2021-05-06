<?php
ob_start();
//session_start();

include('config.php');

$facebook_output = '';
$facebook_helper = $facebook->getRedirectLoginHelper();
$facebook_permissions = ['email']; // Optional permissions
$facebook_login_url = $facebook_helper->getLoginUrl('https://127.0.0.1/Tourism/myprofile.php', $facebook_permissions);
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

if(isset($_GET['message'])){
    echo "<script >alert('User already exists with this Email Address');document.location='https://127.0.0.1/Tourism/index.php'</script>";
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
                                        <label for="username">Email: <span style="color: red; font-size: 22px" > *</span>
                                            <i class="im im-icon-Male"></i>
                                            <input required type="email" class="input-text" name="email" id="username" value="" />
                                        </label>
                                    </p>

                                    <p class="form-row form-row-wide">
                                        <label for="password">Password: <span style="color: red; font-size: 22px" > *</span>
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
                                            header("location: editprofile.php");
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

    <?php
    $departures=[];
    $sql = "SELECT * from flight_schedule";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $departures[] = $row["departure"];
        }
    }
    $departuress  = array_unique($departures, SORT_REGULAR);
    $departure =  array_values(array_filter($departuress));
    ?>

    <!-- Banner
    ================================================== -->
    <div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="classicslider1" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">

        <!-- 5.0.7 auto mode -->
        <div id="rev_slider_4_1" class="rev_slider home fullwidthabanner" style="display:none;" data-version="5.0.7">
            <ul>
                <li data-index="rs-2" data-transition="fade" data-slotamount="default"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="800" data-fsslotamount="7" data-saveperformance="off">

                    <!-- Background -->
                    <img src="images/dublin.jpg"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="112" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0">

                </li>

                <!-- Slide  -->
                <li data-index="rs-1" data-transition="fade" data-slotamount="default"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="800" data-fsslotamount="7" data-saveperformance="off">

                    <!-- Background -->
                    <img src="images/Chapteronesign.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="100" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0">


                </li>

                <!-- Slide  -->


                <li data-index="rs-2" data-transition="fade" data-slotamount="default"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="800" data-fsslotamount="7" data-saveperformance="off">

                    <!-- Background -->
                    <img src="images/dubincastle.jpg"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="112" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0">

                </li>



            </ul>
            <div class="tp-static-layers"></div>

        </div>
    </div>


    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3 class="headline centered margin-top-75">
                    Browse Dublin
                </h3>
            </div>

        </div>
    </div>



    <!-- Category Boxes -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="categories-boxes-container margin-top-5 margin-bottom-30 centered-content" >

                    <!-- Box -->
                    <a href="bars.php?category=bars" class="category-small-box">
                        <i class="im im-icon-Hotel"></i>
                        <h4>Bars</h4>
                    </a>
                    <a href="bars.php?category=historical" class="category-small-box">
                        <i class="im im-icon-City-Hall"></i>
                        <h4>Historical</h4>
                    </a>
                    <a href="bars.php?category=Restaurants" class="category-small-box">
                        <i class="im im-icon-City-Hall"></i>
                        <h4>Restaurants</h4>
                    </a>
                    <a href="bars.php?category=Hotel" class="category-small-box">
                        <i class="im im-icon-City-Hall"></i>
                        <h4>Hotel</h4>
                    </a>
                    <a href="bars.php?category=Attractive Spots" class="category-small-box">
                        <i class="im im-icon-City-Hall"></i>
                        <h4>Attractive Spots</h4>
                    </a>


                </div>
            </div>
        </div>
    </div>

    <div class="main-search-container dark-overlay">
        <div class="main-search-inner">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Check Flight Details</h2>
                        <h4></h4>


                        <div class="main-search-input">

                            <div class="main-search-input-item location">
                                <div id="autocomplete-container">
                                    <select onchange="dothis()" id="departure">
                                        <?php
                                        for($i=0;$i<count($departure);$i++) {?>
                                            <option value="<?php echo $departure[$i] ?>" ><?php echo $departure[$i] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>

                            <div class="main-search-input-item location">
                                <div id="autocomplete-container">
                                    <input disabled onkeyup="dothis()"  name="arrival" id="arrival" value="Dublin" type="text" placeholder="Arrival">
                                </div>
                            </div>


                            <div class="main-search-input-item">
                                <div id="autocomplete-container">
                                    <input onchange="dothis()" placeholder="From" name="date"  id="date" type="date" >
                                </div>
                            </div>

                            <div class="main-search-input-item">
                                <div id="autocomplete-container">
                                    <input onchange="dothis()"  name="returndate"  id="returndate" type="date">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- Video -->
        <div class="video-container">
            <video poster="images/main-search-video-poster.jpg" loop autoplay muted>
                <source src="images/main-search-video.mp4" type="video/mp4">
            </video>
        </div>

    </div>

    <!-- Content
        ================================================== -->
    <br><br><br>
    <div id="hide">

    </div>

    <!-- Category Boxes / End -->

    <section class="fullwidth padding-top-75 padding-bottom-30" data-background-color="#fff">
        <!-- Info Section -->
        <div class="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h3 class="headline centered headline-extra-spacing">
                        <strong class="headline-with-separator">What Our Users Say</strong>
                        <span class="margin-top-25">We collect reviews from our users so you can get an honest opinion of what an experience with our website are really like!</span>
                    </h3>
                </div>
            </div>

        </div>
        <!-- Info Section / End -->

        <!-- Categories Carousel -->
        <div class="fullwidth-carousel-container margin-top-20 no-dots">
            <div class="testimonial-carousel testimonials">

                <?php
                      $sql = "SELECT * from reviews where  status=1 && type='dublin'";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                             $name = $row["name"];
                             $review=$row['detail'];
                             $uid=$row['user_id'];
                ?>
                <!-- Item -->
                <div class="fw-carousel-review">
                    <div class="testimonial-box">
                        <div class="testimonial"><?php echo $review?></div>
                    </div>

                </div>
                <?php
                     }
                }
            ?>
            </div>
        </div>
        <!-- Categories Carousel / End -->
    </section>

<div class="container">
    <?php
    if(isset($userid)){

    $sql = "SELECT * from reviews where  user_id='$userid' && type='dublin'";
    $result = $conn->query($sql);
    if (!$result->num_rows > 0) {
    ?>

        <div id="add-review" class="add-review-box">

            <!-- Add Review -->
            <h3 class="listing-desc-headline margin-bottom-10">Add Review</h3>
            <!-- Review Comment -->
            <form method="post" action="includes/addreview.php" id="add-comment" class="add-comment">
                <input name="userid" hidden value="<?php echo $userid; ?>" >
                <div>
                    <label>Review:<span style="color: red; font-size: 22px" > *</span></label>
                    <textarea name="review" required cols="40" rows="1"></textarea>
                </div>
                <button class="button" name="adddublinreview">Submit Review</button>
                <button class="button" name="addanondublinreview">Submit Review as Anonymous</button>
                <div class="clearfix"></div>
            </form>

        </div>

        <?php
        }
    }
    ?>
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
<script src="js/validation.js" ></script>

<script>
    
    function  dothis() {
        var str = new  Array();
        var aa = document.getElementById("departure");
        var a = aa.options[aa.selectedIndex].value;
        var b= document.getElementById("arrival").value;
        var c= document.getElementById("date").value;
        var d= document.getElementById("returndate").value;

        str.push(a);
        str.push(b);
        str.push(c);
        str.push(d);
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
            xhttp.open("GET", "search.php?q="+str,  true);
            xhttp.send();
    }

    
</script>

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


<!-- REVOLUTION SLIDER SCRIPT -->
<script type="text/javascript" src="scripts/themepunch.tools.min.js"></script>
<script type="text/javascript" src="scripts/themepunch.revolution.min.js"></script>

<script type="text/javascript">
    var tpj=jQuery;
    var revapi4;
    tpj(document).ready(function() {
        if(tpj("#rev_slider_4_1").revolution == undefined){
            revslider_showDoubleJqueryError("#rev_slider_4_1");
        }else{
            revapi4 = tpj("#rev_slider_4_1").show().revolution({
                sliderType:"standard",
                jsFileLocation:"scripts/",
                sliderLayout:"auto",
                dottedOverlay:"none",
                delay:9000,
                navigation: {
                    keyboardNavigation:"off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation:"off",
                    onHoverStop:"on",
                    touch:{
                        touchenabled:"on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    }
                    ,
                    arrows: {
                        style:"zeus",
                        enable:true,
                        hide_onmobile:true,
                        hide_under:600,
                        hide_onleave:true,
                        hide_delay:200,
                        hide_delay_mobile:1200,
                        tmp:'<div class="tp-title-wrap"></div>',
                        left: {
                            h_align:"left",
                            v_align:"center",
                            h_offset:40,
                            v_offset:0
                        },
                        right: {
                            h_align:"right",
                            v_align:"center",
                            h_offset:40,
                            v_offset:0
                        }
                    }
                    ,
                    bullets: {
                        enable:false,
                        hide_onmobile:true,
                        hide_under:600,
                        style:"hermes",
                        hide_onleave:true,
                        hide_delay:200,
                        hide_delay_mobile:1200,
                        direction:"horizontal",
                        h_align:"center",
                        v_align:"bottom",
                        h_offset:0,
                        v_offset:32,
                        space:5,
                        tmp:''
                    }
                },
                viewPort: {
                    enable:true,
                    outof:"pause",
                    visible_area:"80%"
                },
                responsiveLevels:[1200,992,768,480],
                visibilityLevels:[1200,992,768,480],
                gridwidth:[1180,1024,778,480],
                gridheight:[640,500,400,300],
                lazyType:"none",
                parallax: {
                    type:"mouse",
                    origo:"slidercenter",
                    speed:2000,
                    levels:[2,3,4,5,6,7,12,16,10,25,47,48,49,50,51,55],
                    type:"mouse",
                },
                shadow:0,
                spinner:"off",
                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,
                shuffle:"off",
                autoHeight:"off",
                hideThumbsOnMobile:"off",
                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                debugMode:false,
                fallbacks: {
                    simplifyAll:"off",
                    nextSlideOnWindowFocus:"off",
                    disableFocusListener:false,
                }
            });
        }
    });	/*ready*/
</script>


<!-- SLIDER REVOLUTION 5.0 EXTENSIONS
	(Load Extensions only on Local File Systems !
	The following part can be removed on Server for On Demand Loading) -->
<script type="text/javascript" src="scripts/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.video.min.js"></script>


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
