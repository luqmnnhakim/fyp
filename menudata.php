<?php
include('database/connection.php');
if($_SESSION['user']!=''){
    //execute command at this page

$sqldisplay="SELECT * FROM menu_info";
$resultdisplay=$con->query($sqldisplay);

if($resultdisplay->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Data</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class=body-menudata>

    <div class="menu-data-container">
        <h2 class=h2-menudata>Menu Data</h2>
        <table class="table-menudata">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Price (RM)</th>
                    <th></th>
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
                    <td><?= $value['mentype']; ?></td>
                    <td><?= $value['menname']; ?></td>
                    <td><?= $value['menprice']; ?></td>
                    <td></td>
                    <td>
    <button class="edit-btn" onclick="window.location.href='editmenu.php?cid=<?= $value['menuid']; ?>';">Edit</button>
    <button class="remove-btn" onclick="if(confirm('Are you sure you want to delete?')) { window.location.href='removemenu.php?cid=<?= $value['menuid']; ?>'; }">Remove</button>

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