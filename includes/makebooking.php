<?php
ob_start();
require_once("connection.php");

if (isset($_POST["bookingplace"])) {
    $userid = $_POST['userid'];
    $placeid = $_POST['placeid'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $total = $_POST['qtyInput'];


    $sql = "INSERT INTO `bookingplace` VALUES ('','$placeid', '$userid','$date','$time','$total',0)";
    if (mysqli_query($conn, $sql)) {
        echo "<script >alert('Your Booking Has Been Made');document.location='https://127.0.0.1/Tourism/detail.php?id=$placeid'</script>";
        ob_end_flush();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

if (isset($_POST["flightbooking"])) {
    $userid = $_POST['userid'];
    $flightid = $_POST['flightid'];
    $seat = $_POST['seats'];

    $sql = "INSERT INTO `bookingflight` VALUES ('','$flightid', '$userid',0,'$seat')";
    if (mysqli_query($conn, $sql)) {
        echo "<script >alert('Your Booking Has Been Made');document.location='https://127.0.0.1/Tourism/index.php'</script>";
        ob_end_flush();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

