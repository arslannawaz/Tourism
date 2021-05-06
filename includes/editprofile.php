

<?php
include ('connection.php');

if(isset($_POST['editprofile'])) {

    $name = $_POST['name'];
    $uid= $_POST['userid'];
    $gender=$_POST["gender"];
    $from=$_POST["from"];
    $to=$_POST["to"];
    $month=$_POST["month"];
    $age=$_POST["age"];
    $interest=$_POST["interest"];
    $language=$_POST["language"];
    $phone=$_POST["phone"];
    $smoker=$_POST["smoker"];
    $drink=$_POST["drink"];
    $about=$_POST["about"];

    $sql = "update profile set gender='$gender', travelling_from='$from', travelling_to='$to',travelling_month='$month',age='$age',interest='$interest', language='$language',phone='$phone',smoker_box='$smoker',drinking_box='$drink',about='$about' WHERE user_id = '$uid'";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        session_start();
        $_SESSION["name"]=$name;
        header('Location: ../editprofile.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}


if(isset($_POST['addprofile'])) {

    $name = $_POST['name'];
    $uid= $_POST['userid'];
    $gender=$_POST["gender"];
    $from=$_POST["from"];
    $to=$_POST["to"];
    $monthnumber=explode("-",$_POST["month"]);
    $age=$_POST["age"];
    $interest=$_POST["interest"];
    $language=$_POST["language"];
    $phone=$_POST["phone"];
    $smoker=$_POST["smoker"];
    $drink=$_POST["drink"];
    $about=$_POST["about"];

    $u_name = $name.time();

    $month = date("F", mktime(0, 0, 0, $monthnumber[1], 10));

    $target_dir = "images/";
    if (!empty($_FILES)) {
        $target_file = $target_dir . time().basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . time(). $_FILES['file']['name']);
    }

    $sqlup = "update users set profile=1 WHERE id = '$uid' or email='$uid' ";
    mysqli_query($conn, $sqlup);

    $sql = "INSERT INTO `profile` VALUES('','$uid','$name', '$gender','$from','$to','$month','$age','$interest','$language','$phone','$smoker','$drink','$about','$target_file','$u_name')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        session_start();
        $_SESSION["name"]=$name;
        header('Location: ../editprofile.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}



if(isset($_POST['changepic'])) {

    $uid= $_POST['userid'];

    $target_dir = "images/";
    if (!empty($_FILES)) {
        $target_file = $target_dir . time().basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . time(). $_FILES['file']['name']);
    }

    $sql = "update profile set pic='$target_file' WHERE user_id = '$uid'";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        session_start();
        $_SESSION["name"]=$name;
        header('Location: ../editprofile.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}