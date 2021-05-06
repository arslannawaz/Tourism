

<?php
include ('connection.php');

if(isset($_POST['editprofile'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $uid= $_POST['userid'];

    $sql = "update users set name='$name', email='$email' , password='$pass'  WHERE id = '$uid'";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        session_start();
        $_SESSION["name"]=$name;
        header('Location: ../editprofile.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}


if(isset($_POST['editcargo'])) {

    $cid = $_POST['cargoid'];
    $location = $_POST['location'];


    $sql = "update cargo set currentlocation='$location' WHERE id = '$cid'";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        session_start();
        $_SESSION["name"]=$name;
        header('Location: ../viewusers.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}
