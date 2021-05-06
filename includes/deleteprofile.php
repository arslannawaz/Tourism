<?php

include('connection.php');


if(isset($_POST['deleteprofile'])) {

        $id = $_POST['userid'];

        $sql = "delete from users WHERE id = '$id' or email='$id' ";
        if (mysqli_query($conn, $sql)) {
            $sql1 = "delete from bookingflight WHERE userid = '$id'";
            mysqli_query($conn, $sql1);

            $sql2 = "delete from bookingplace WHERE userid = '$id'";
            mysqli_query($conn, $sql2);

            $sql3 = "delete from profile WHERE user_id = '$id'";
            mysqli_query($conn, $sql3);

            $sql4= "delete from reviews WHERE user_id = '$id'";
            mysqli_query($conn, $sql4);

            $sql5= "delete from reviews WHERE user_id = '$id'";
            mysqli_query($conn, $sql5);

            $sql6= "delete from messages WHERE sender_id = '$id' or to_id='$id'";
            mysqli_query($conn, $sql6);

            echo "<script >alert('Your Account Has Been Deleted Successfully');document.location='https://127.0.0.1/Tourism/logout.php'</script>";
            ob_end_flush();

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


}