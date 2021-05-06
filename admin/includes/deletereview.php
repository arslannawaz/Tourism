<?php

include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "delete from reviews WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        header('Location: ../approvereview.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}