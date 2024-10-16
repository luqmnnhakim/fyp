<?php
include('mysqlconn.php');

if($con){
    //display connection status
    echo "successfully connected to the MYSQL server";
    //create database
    $sqldb="CREATE DATABASE fyp";
    $resultdb=$con->query($sqldb); //command to execute sql statement

    if($resultdb){
        echo "<br>Done cretae the fyp database";
    }
    else{
        echo "cannot create";
    }

}
else{
    echo "cannot connect to the MYSQL";
}
?>