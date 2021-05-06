<?php
ob_start();
require_once("connection.php");

if (isset($_POST["register"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql11 = "SELECT * from users where email='$email'";
    $result11 = $conn->query($sql11);
    if ($result11->num_rows > 0) {
        header("location: ../index.php?message='Email already exists'");
    }
    else {

        $sql = "INSERT INTO `users` VALUES('','$name', '$email','$pass',0,1)";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";

            $sql1 = "SELECT * from users ORDER BY id DESC LIMIT 1";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
                    $d_id = $row["id"];
                    $d_name = $row['name'];
                    $d_email = $row['email'];
                }
            }
            session_start();
            $_SESSION['id'] = $d_id;
            $_SESSION['name'] = $d_name;
            $_SESSION['email'] = $d_email;
            header("location: ../editprofile.php");
            ob_end_flush();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

}