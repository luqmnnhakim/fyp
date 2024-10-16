<?php
include('database/connection.php');

if (isset($_SESSION['user']) && $_SESSION['user'] != '') {
    // Execute command at this page
    
$id = $_GET['cid']; // Variable from the URL
$cmddisplay = "SELECT * FROM menu_info WHERE menuid='$id'";
$resultdisplay = $con->query($cmddisplay);
$data = $resultdisplay->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="body-menuform">
    <div class="form-containerform">
        <h2 class="h2-menuform">Edit Menu Item</h2>
        <form name="" method="post" action="editmenuprocess.php">
            <input type="hidden" name="menuid" value="<?= $data['menuid']; ?>"/> <br>
            <div class="form-groupform">
                <label for="type">Type</label>
                <select name="type">
                    <option value="Food" <?= $data['mentype'] == 'Food' ? 'selected' : ''; ?>>Food</option>
                    <option value="Drink" <?= $data['mentype'] == 'Drink' ? 'selected' : ''; ?>>Drink</option>
                    <option value="Set" <?= $data['mentype'] == 'Set' ? 'selected' : ''; ?>>Set</option>
                </select>
            </div>
            <div class="form-groupform">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Enter menu name" value="<?= $data['menname']; ?>">
            </div>
            <div class="form-groupform">
                <label for="price">Price</label>
                <input type="text" name="price" placeholder="Enter price" value="<?= $data['menprice']; ?>">
            </div>
            <div class="form-groupform">
                <button type="submit" name="edit">Edit Menu</button>
            </div>
        </form>
    </div>
    <?php
    @$error = $_GET['empty'];
    if ($error == 'yes') {
        ?>
        <script>
            alert("Please insert all required info");
            window.location = 'menuform.php';
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