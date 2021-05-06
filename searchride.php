<?php

session_start();
$userid=$_SESSION["id"];
$username=$_SESSION["name"];
require_once("includes/connection.php");

$data=explode(',',$_GET['q']);
?>


<!-- Listings -->
<div class="col-lg-12 col-md-12">
    <div class="dashboard-list-box margin-top-0">
        <h4>Finding Pal...</h4>
        <ul>
            <?php
            $sql = "SELECT * from profile where travelling_month like concat('%','$data[0]','%') && travelling_to like concat('%','$data[1]','%') && gender = '$data[2]' && age between '$data[3]' and '$data[4]' ";
           // $sql = "SELECT * from profile where travelling_to = 'dublin'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if($row["user_id"]!=$userid) {
                        $name = $row["name"];
                        $u_name = $row["username"];
                        $to_id = $row["user_id"];
                        $profileid = $row["id"];
                        $gender = $row["gender"];
                        $from = $row["travelling_from"];
                        $to = $row["travelling_to"];
                        $month = $row["travelling_month"];
                        $age = $row["age"];
                        $interest = $row["interest"];
                        $language = $row["language"];
                        $phone = $row["phone"];
                        $smoker = $row["smoker_box"];
                        $drink = $row["drinking_box"];
                        $about = $row["about"];
                        $pic=$row['pic'];

                        ?>

                        <li>
                            <div class="list-box-listing">
                                <div class="list-box-listing-img"><a href="#"><img src="includes/<?php echo $pic ?>" alt=""></a>
                                </div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3><?php echo $name; ?>  </h3>
                                        <span>Username: <?php echo $u_name; ?></span><br>
                                        <span>Age: <?php echo $age; ?></span><br>
                                        <span>Interest: <?php echo $interest; ?></span><br>
                                        <span>Language: <?php echo $language; ?></span><br>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a href="userprofile.php?userprofile=<?php echo $to_id; ?>" class="button gray"><i class=""></i>View Profile</a>
<!--                                <a href="conversation.php?to=--><?php //echo $to_id; ?><!--" class="button gray"><i class=""></i>Send Message</a>-->
                            </div>
                        </li>

                        <?php
                    }
                }
            }
            ?>

        </ul>
    </div>
</div>
