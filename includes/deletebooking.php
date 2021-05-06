
<?php

include('connection.php');

if (isset($_GET['bid'])) {
    $id = $_GET['bid'];
    $sql = "delete from booking WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        header('Location: ../viewbooking.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}