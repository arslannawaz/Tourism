<?php

require_once("includes/connection.php");

$data=explode(',',$_GET['q']);






$sql = "SELECT * from flight_schedule where departure like concat('$data[0]','%') and arrival like concat('$data[1]','%') and (date = '$data[2]' and return_date = '$data[3]' ) ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$departure = $row["departure"];
$arrival = $row["arrival"];
$date = $row["date"];
$returndate = $row["return_date"];
$time = $row["time"];
$seat = $row["seats"];
$fare = $row["fair"];
$id = $row['id'];
$airline=$row['company_name'];

?>

<div class="container">
    <div class="row">



        <div class="col-md-12">

            <div class="row">

                 <div class="col-lg-12 col-md-12">
                            <div class="listing-item-container list-layout">
                                <a href="bookingflight.php?id=<?php echo $id;?>" class="listing-item">
                                    <!-- Image -->
                                    <div class="listing-item-image">
                                        <img src="images/listing-item-01.jpg" alt="">
                                    </div>
                                    <!-- Content -->
                                    <div class="listing-item-content">

                                        <div class="listing-item-inner">
                                            <h3><?php echo $departure; ?> to <?php echo $arrival;?></h3>
                                            <span>Airline: <?php echo $airline; ?></span><br>
                                            <span>Time: <?php echo $time; ?></span><br>
                                            <span>Flight Date: <?php echo $date; ?></span><br>
                                            <span>Return Date: <?php echo $returndate; ?></span><br>
                                            <span>Fare: <?php echo $fare; ?></span><br>
                                            <span>Seats Left: <?php echo $seat; ?></span><br>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else{
                ?>
                    <div class="col-lg-12 col-md-12">
                        <div class="listing-item-container list-layout">
                            <a href="#" class="listing-item">
                                <!-- Content -->
                                <div class="listing-item-content">
                                    <div class="listing-item-inner">
                                        <h3>No Flight</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                }
                ?>
                <!-- Listing Item / End -->

            </div>

        </div>

    </div>
</div>
