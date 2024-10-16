<?php
session_start();
include('database/connection.php');

$id=$_GET['cid'];

$cmddel="DELETE FROM menu_info WHERE menuid='$id'";
$resultdel=$con->query($cmddel);

header('location:menudata.php');


?>