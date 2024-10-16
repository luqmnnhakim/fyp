<?php
session_start();
include('database/connection.php');

$id=$_GET['cid'];

$cmddel="DELETE FROM admin_info WHERE adid='$id'";
$resultdel=$con->query($cmddel);

header('location:staffinfo.php');


?>