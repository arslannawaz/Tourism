<?php
ob_start();
require_once("connection.php");

session_start();
$userid=$_SESSION["id"];
$username=$_SESSION["name"];

if(isset($_POST["addschedule"])){
    $departure = $_POST['departure'];
    $arrival = $_POST['arrival'];
    $date = $_POST['date'];
    $returndate = $_POST['returndate'];
    $time = $_POST['time'];
    $seats = $_POST['seats'];
    $fair = $_POST['fair'];
    $company = $_POST['company'];


    $sql = "INSERT INTO `flight_schedule` VALUES('','$departure', '$arrival','$date','$time','$seats','$company','$fair','$returndate')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    header("location: ../viewschedule.php");
    ob_end_flush();
}


if(isset($_POST["addplace"])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $category = $_POST['category'];
    $des = $_POST['description'];
    $loc = $_POST['iframe'];


    $status = 0;
    $target_dir = "images/files/";
    if (!empty($_FILES)) {
        $target_file = $target_dir . time().basename($_FILES["file"]["name"]);
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . time(). $_FILES['file']['name'])) {
            $status = 1;
        }
    }
    if ($status == 1) {
        $sql = "INSERT INTO `attractive_points` VALUES('','$name', '$address','$category','$target_file','$des','$loc')";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        header("location: ../viewplace.php");
        ob_end_flush();
    }
}


if(isset($_POST["editplace"])){
    $name = $_POST['name'];
    $placeid = $_POST['placeid'];
    $address = $_POST['address'];
    $category = $_POST['category'];
    $des = $_POST['description'];
    $loc = $_POST['iframe'];


    if(!isset($_POST['iframe'])) {
        $sql = "update attractive_points set name='$name', address='$address', category='$category', description='$des' where id='$placeid' ";
    }
    else{
        $sql = "update attractive_points set name='$name', address='$address', category='$category', description='$des', location='$loc' where id='$placeid' ";
    }
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        header("location: ../viewplace.php");
        ob_end_flush();
}

if(isset($_POST['changeplacepic'])) {

    $pid= $_POST['placeid'];

    $target_dir = "images/files/";
    if (!empty($_FILES)) {
        $target_file = $target_dir . time().basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . time(). $_FILES['file']['name']);
    }

    $sql = "update attractive_points set pic='$target_file' WHERE id = '$pid'";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        session_start();
        $_SESSION["name"]=$name;
        header('Location: ../viewplace.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

if(isset($_POST["editflightschedule"])){
    $departure = $_POST['departure'];
    $arrival = $_POST['arrival'];
    $date = $_POST['date'];
    $returndate = $_POST['returndate'];
    $time = $_POST['time'];
    $seats = $_POST['seats'];
    $fair = $_POST['fair'];
    $company = $_POST['company'];
    $fid = $_POST['flightid'];


    $sql = "update flight_schedule set departure='$departure', arrival='$arrival', date='$date', time='$time', seats='$seats', company_name='$company', fair='$fair', return_date='$returndate' where id='$fid' ";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    header("location: ../viewschedule.php");
    ob_end_flush();
}