<?php
ob_start();
require_once("connection.php");

if (isset($_POST["sendmsg"])) {
    $to = $_POST['to_id'];
    $from = $_POST['from_id'];
    $msg = $_POST['msg'];

    $date = date("y:m:d h:i:sa");

    $sql = "INSERT INTO `messages` VALUES ('','$from', '$to','$from','$msg','$date')";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

    header("location: ../conversation.php?to=$to");
    ob_end_flush();
}