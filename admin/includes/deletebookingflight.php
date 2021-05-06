<?php

include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "update bookingflight set status=2 WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header('Location: ../flightbooking.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}