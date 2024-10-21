<?php
include('database/connection.php');
if($_SESSION['user']!=''){
    //execute command at this page

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Staff Panel</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
    <div style="display: flex; align-items: center; justify-content: space-between;">
    <img src="images/logo.png" alt="" class="imglogo" width="100px" height="100px">
     <!-- Display the username -->
</div>
<h1>Welcome, <?php echo $_SESSION['user'];?></h1>
 <!-- Display the username -->
        <nav>
            <ul>
                <li><a href="staff.php">Menu</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="main-content">
        <div class="card">
            <h2>Order Details</h2>
            <img src="images/order.png" alt="Order Details" class="card-img">
            <br>
            <a href="kitchen.php"><button class="action-btn">Lihat Pesanan</button></a>
        </div>
        <div class="card">
            <h2>Manage Tables</h2>
            <img src="images/table.png" alt="Manage Tables" class="card-img">
            <a href="cashier.php"><button class="action-btn">Urus Meja</button></a>
        </div>
        <div class="card">
            <h2>Update Menu</h2>
            <img src="images/update.png" alt="Update Menu" class="card-img">
            <p></p>
            <a href="updateorder.php"><button class="action-btn">Kemaskini Pesanan</button></a>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 AIDA STATION. All rights reserved.</p>
    </footer>
</body>
</html>
<?php
}
else{
    header('location:login.php');
}
?>
