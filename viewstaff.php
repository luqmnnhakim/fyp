<?php
include('database/connection.php');
if($_SESSION['user']!=''){
    //execute command at this page


$id=$_GET['cid']; //variable from the URL
$cmddisplay="SELECT * FROM admin_info WHERE adid='$id'";
$resultdisplay=$con->query($cmddisplay);
$data=$resultdisplay->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Staff Details</title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
    <h1>Staff Details</h1>
    <table class="staff-details-table">
        <tr>
            <th>Name</th>
            <td data-label="Name"><?= htmlspecialchars($data['adname']); ?></td>
        </tr>
        <tr>
            <th>IC No</th>
            <td data-label="IC No"><?= htmlspecialchars($data['adic']); ?></td>
        </tr>
        <tr>
            <th>Gender</th>
            <td data-label="Gender"><?= htmlspecialchars($data['adgender']); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td data-label="Email"><?= htmlspecialchars($data['ademail']); ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td data-label="Address"><?= htmlspecialchars($data['address']); ?></td>
        </tr>
    </table>

    <div class="action-buttons-container">
        <a href="staffinfo.php" class="back-button">Back</a>
        <a href="editstaff.php?cid=<?= htmlspecialchars($data['adid']); ?>" class="edit-button">Edit</a>
    </div>

    <?php
        @$editstatus=$_GET['edit'];
        if($editstatus=='yes')
        {
            ?>
    <script>
        alert("Data has been updated into the competitors table");
    </script>
    <?php
        }
        ?>
</body>
</html>
<?php
}
else{
    header('location:login.php');
}
?>