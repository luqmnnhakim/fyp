<?php
session_start();
include('database/connection.php');

$id=$_GET['cid'];

$cmddel="DELETE FROM sales WHERE salesid='$id'";
$resultdel=$con->query($cmddel);

header('location:adminsales.php');


?>