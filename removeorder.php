<?php
session_start();
include('database/connection.php');

$id=$_GET['cid'];

$cmddel="DELETE FROM staff WHERE orid='$id'";
$resultdel=$con->query($cmddel);

header('location:kitchen.php');


?>