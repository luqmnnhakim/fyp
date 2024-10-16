<?php
include('database/connection.php');
if($_SESSION['user']!=''){
    //execute command at this page

$sqldisplay="SELECT * FROM sales";
$resultdisplay=$con->query($sqldisplay);

if($resultdisplay->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="body-sales">

    <div class="sales-container">
        <h2 class="h2-sales">Sale Records</h2>
        <table class="table-sales">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Total Sale</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            $count = 1;
            while($value=$resultdisplay->fetch_assoc()) {
            ?>
            <tbody>
                <tr>
                    <td><?= $count; ?></td>
                    <td><?= $value['salesdate']; ?></td>
                    <td><?= $value['salestotal']; ?></td>
                    <td>
                    <div class="button-container">
        <button class="view-btnSales" onclick="window.location.href='viewsales.php?cid=<?= $value['salesid']; ?>';">View</button>
        <button class="remove-btnSales" onclick="if(confirm('Are you sure you want to delete?')) { window.location.href='removesales.php?cid=<?= $value['salesid']; ?>'; }">Remove</button>

    </div

</td>

                </tr>
                <!-- More rows can be added here -->
            </tbody>
    <?php
    $count++;
       }
}   else{
    echo "No record found in the table";
}
?>
        </table>
    </div>

</body>
</html>
<?php
}
else{
    header('location:login.php');
}
?>