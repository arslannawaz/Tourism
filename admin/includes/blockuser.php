<?php

include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "update users set status=0 WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header('Location: ../viewusers.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}