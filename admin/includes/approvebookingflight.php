<?php

include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "update bookingflight set status=1 WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql2 = "SELECT * from bookingflight where id='$id'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $seat = $row["seat"];
            $flightid = $row["flightid"];
        }
    }

    $sql2 = "SELECT * from flight_schedule where id='$flightid'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $seats = $row["seats"];
        }
    }

    $updatedseats=0;
    $updatedseats=$seats-$seat;

    $sql1 = "update flight_schedule set seats='$updatedseats' WHERE id = '$flightid'";
    if (mysqli_query($conn, $sql1)) {
        echo "New record created successfully";
        header('Location: ../flightbooking.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}