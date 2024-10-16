<?php
//how to connect to mysql
$hostname="localhost";
$username="root";
$password="";

//command to connect to mysql
$con=mysqli_connect($hostname,$username,$password);

/*if($con){
   echo "successfully connected to the MYSQL server";
}
else{
    echo "cannot connect to the MYSQL";
}
?>
*/