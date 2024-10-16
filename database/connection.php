<?php
session_start();
//create connection to the database
$hostname="localhost";
$username="root";
$password="";
$dbname="fyp";

$con=mysqli_connect($hostname,$username,$password,$dbname);

if($con){
   // echo "successfully connected to the the FYP database";
}
else{
    echo "cannot connect to the database";
}
?>