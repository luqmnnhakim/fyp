<?php
include('database/connection.php');
if($_SESSION['user']!=''){
    //execute command at this page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class=body-menuform>

    <div class="form-containerform">
        <h2 class=h2-menuform>Add New Menu</h2>
        <form name="" method="post" action="menuformprocess.php">
            <div class="form-groupform">
                <label for="type">Type</label>
                <select name="type">
                    <option value="Food">Food</option>
                    <option value="Drink">Drink</option>
                    <option value="Set">Set</option>
                </select>
            </div>

            <div class="form-groupform">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Enter menu name">
            </div>

            <div class="form-groupform">
                <label for="price">Price</label>
                <input type="text" name="price" placeholder="Enter price">
            </div>

            <div class="form-groupform">
                <button type="submit" name="add">Add Menu</button>
            </div>
        </form>
    </div>
    <?php
        @$error=$_GET['empty'];
        if($error=='yes')
        {
            ?>
    <script>
        alert("Please enter all require info");
        window.location='menuform.php';
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