<?php

require_once("includes/connection.php");

$data=explode(',',$_GET['q']);


?>

<div class="row fs-listings">

    <!-- Listing Item -->

    <?php
    $sql = "SELECT * from attractive_points where name like concat('%','$data[0]','%') &&  category='$data[1]' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row["name"];
            $address= $row["address"];
            $category = $row["category"];
            $file = $row["pic"];
            $id= $row['id'];
            ?>


                <!-- Listing Item -->
                <div class="col-lg-12 col-md-12">
                    <div class="listing-item-container list-layout" data-marker-id="5">
                        <a href="detail.php?id=<?php echo $id?>" class="listing-item">
                            <!-- Image -->
                            <div class="listing-item-image">
                                <img src="<?php echo 'admin/includes/'.$file?>" alt="">
                            </div>


                            <div class="listing-item-content">
                                <div class="listing-badge now-open">Now Open</div>

                                <div class="listing-item-inner">
                                    <h3 style="color:#000;"><?php echo $name; ?> </h3>
                                    <span>Address: <?php echo $address?></span><br>
                                </div>
                            </div>

                        </a>
                    </div>
                </div>
                <!-- Listing Item / End -->
            <?php
        }
    }
    ?>

    <!-- Listing Item / End -->
    <div class="clearfix"></div>

</div>
