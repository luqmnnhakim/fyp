<?php
session_start(); // Start session to use session variables
include('database/connection.php');

if(isset($_POST['login'])) {
    $usrname = $_POST['username'];
    $pswd = $_POST['password'];

    if(empty($usrname) || empty($pswd)) {
        header('location:login.php?empty=yes');
     }
      else {
        $checkusr = "SELECT * FROM admin_info WHERE adusername='$usrname' and adpassword='$pswd'";
        $resultusr = $con->query($checkusr);
        $row = $resultusr->fetch_assoc();

        if($resultusr->num_rows > 0) { // User exists
            $_SESSION['user']=$row['adusername'];
            if($row['usercat'] == 'admin') {
                header('location:admin.php');
            } elseif($row['usercat'] == 'staff') {
                header('location:staff.php');
            }
        } else {
            // User not found
            header('location:login.php?invalid=yes');
        }
    }
}
?>
