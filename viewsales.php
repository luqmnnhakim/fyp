<?php
session_start();
include('database/connection.php');

$id = $_GET['cid']; // Variable from the URL
$cmddisplay = "SELECT * FROM sales_info WHERE foodid='$id'";
$resultdisplay = $con->query($cmddisplay);
$data = $resultdisplay->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <h1>Sales Record</h1>
    <table class="table-sales">
        <tr>
            <td class="label">Food</td>
            <td class="data"><?= $data['foodname']; ?></td>
        </tr>
        <tr>
            <td class="label">Drink</td>
            <td class="data"><?= $data['drinkname']; ?></td>
        </tr>
        <tr>
            <td class="label">Price</td>
            <td class="data"><?= $data['totalprice']; ?></td>
        </tr>
    </table>
</body>
</html>
