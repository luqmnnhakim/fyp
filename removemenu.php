<?php
session_start();
include('database/connection.php');

$id=$_GET['cid'];

$cmddel="DELETE FROM menu WHERE id='$id'";
$resultdel=$con->query($cmddel);

header('location:menudata.php');


?>