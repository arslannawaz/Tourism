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

if($_GET['id']){
  $placeid=$_GET['id'];
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
                <li class="active" ><a><i class="fa fa-clock-o"></i>Attractive Places</a>
                    <ul>
                        <li><a href="addplace.php">Add Place</a></li>
                        <li><a href="viewplace.php">View Place</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-clock-o"></i>Flights Schedule</a>
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
                    <h2>Edit Place</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Edit Place</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <?php
        $sql = "SELECT * from attractive_points where id = '$placeid'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            $name = $row["name"];
            $address= $row["address"];
            $category = $row["category"];
            $file = $row["pic"];
            $id= $row['id'];
            $des= $row['description'];
            $loc= $row['location'];
            }
        }
        ?>

        <div class="row">

            <!-- Profile -->
            <div class="col-lg-6 col-md-6">
                <div class="dashboard-list-box margin-top-0">
                    <div class="dashboard-list-box-static">

                        <form enctype="multipart/form-data" action="includes/addschedule.php" method="post" onsubmit="return placeValidator()">
                            <!-- Details -->
                            <div class="my-profile">

                                <input hidden name="placeid" value="<?php echo $id ?>">

                                <label>Name<span style="color: red; font-size: 22px" > *</span></label>
                                <input id="name"  name="name" type="text" value="<?php echo $name ?>">

                                <label>Address<span style="color: red; font-size: 22px" > *</span></label>
                                <input id="address" name="address" type="text" value="<?php echo $address ?>" >

                                <label>Category</label>
                                <select name="category">
                                    <option  value='<?php echo $category?>'><?php echo $category?></option>;
                                    <?php if($category!='Bars') { ?>
                                    <option  value='Bars'>Bars</option>;
                                   <?php } ?>
                                    <?php if($category!='Historical') { ?>
                                        <option value="Historical">Historical Place</option>
                                    <?php } ?>

                                    <?php if($category!='Restaurants') { ?>
                                        <option value="Restaurants">Restaurants</option>
                                    <?php } ?>

                                    <?php if($category!='Hotel') { ?>
                                        <option value="Hotel">Hotel</option>
                                    <?php } ?>

                                    <?php if($category!='Attractive Spots') { ?>
                                        <option value="Attractive Spots">Attractive Spots</option>
                                    <?php } ?>
                                </select>

                                <label>Description<span style="color: red; font-size: 22px" > *</span></label>
                                <input name="description" value="<?php echo $des ?>">

                                <label>Add Location Iframe<span style="color: red; font-size: 22px" > *</span></label>
                                <textarea name="iframe"></textarea>

                            </div>
                            <button name="editplace" type="submit" class="button margin-top-15">Update</button>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="dashboard-list-box margin-top-0">
                    <div class="dashboard-list-box-static">
                        <!-- Details -->
                        <form enctype="multipart/form-data" action="includes/addschedule.php" method="post">
                            <div class="edit-profile-photo">
                                <img src="<?php echo 'includes/'.$file?>" alt="">

                                <div class="change-photo-btn">
                                    <div class="photoUpload">
                                        <span><i class="fa fa-upload"></i>Change Picture</span>
                                        <input name="placeid" hidden value="<?php echo $placeid; ?>" >
                                        <input required name="file" type="file" class="upload" />
                                    </div>
                                </div>

                            </div>
                            <button name="changeplacepic" type="submit" class="button margin-top-15">Change Picture</button>
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
    function placeValidator() {
        var name = document.getElementById('name').value;
        var letters = /^[a-zA-Z ]+$/;
        if(!name.match(letters))
        {
            alert("Name should be only alphabet");
            return false;
        }
    }
</script>
