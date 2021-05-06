<?php
ob_start();
require_once("connection.php");

if(isset($_POST['addreview'])) {
    $placeid = $_POST['placeid'];
    $userid = $_POST['userid'];
    $review = $_POST["review"];
    $sql1 = "SELECT * from profile where user_id= '$userid'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        // output data of each row
        while ($row = $result1->fetch_assoc()) {
            $name = $row["name"];
        }
    }

    $sql = "INSERT INTO `reviews` VALUES('','$placeid','$name','$review',0,'place','$userid')";
    if (mysqli_query($conn, $sql)) {
        echo "<script >alert('Your Review Has Been Submitted');document.location='https://127.0.0.1/Tourism/detail.php?id=$placeid'</script>";
        ob_end_flush();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

if(isset($_POST['addanonreview'])) {
    $placeid = $_POST['placeid'];
    $userid = $_POST['userid'];
    $review = $_POST["review"];
    $name='Anonymous';

    $sql = "INSERT INTO `reviews` VALUES('','$placeid','$name','$review',0,'place','$userid')";
    if (mysqli_query($conn, $sql)) {
        echo "<script >alert('Your Review Has Been Submitted');document.location='https://127.0.0.1/Tourism/detail.php?id=$placeid'</script>";
        ob_end_flush();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}


if(isset($_POST['adddublinreview'])) {

    $userid = $_POST['userid'];
    $review = $_POST["review"];
    $sql1 = "SELECT * from profile where user_id= '$userid'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        // output data of each row
        while ($row = $result1->fetch_assoc()) {
            $name = $row["name"];
        }
    }

    $sql = "INSERT INTO `reviews` VALUES('',0,'$name','$review',0,'dublin','$userid')";
    if (mysqli_query($conn, $sql)) {
        echo "<script >alert('Your Review Has Been Submitted');document.location='https://127.0.0.1/Tourism/index.php'</script>";
        ob_end_flush();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}


if(isset($_POST['addanondublinreview'])) {

    $userid = $_POST['userid'];
    $review = $_POST["review"];
    $name='Anonymous';
    $sql = "INSERT INTO `reviews` VALUES('',0,'$name','$review',0,'dublin','$userid')";
    if (mysqli_query($conn, $sql)) {
        echo "<script >alert('Your Review Has Been Submitted');document.location='https://127.0.0.1/Tourism/index.php'</script>";
        ob_end_flush();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}