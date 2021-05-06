<?php

session_start();
$userid=$_SESSION["id"];
$username=$_SESSION["name"];
require_once("includes/connection.php");

$data=explode(',',$_GET['q']);
//print_r($data);

$senderid=$data[1];


$sql = "SELECT * from messages where (to_id='$data[0]' and sender_id='$data[1]') or (sender_id='$data[0]' and to_id='$data[1]' ) order by time";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $to=$row["to_id"];
        $from=$row["from"];
        $sender=$row["sender_id"];

        if($senderid==$sender){
        ?>
        <div class="message-bubble me">
            <div class="message-avatar"><img src="images/dashboard-avatar.jpg" alt="" /></div>
            <div class="message-text"><p><?php echo $row["message"];?></p></div>
        </div>
        <?php
        }
        if($senderid!=$sender){ ?>
           <div class="message-bubble">
                <div class="message-avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
                <div class="message-text"><p><?php echo $row["message"];?></p></div>
           </div>
            <?php
        }
    }
}


?>