<?php
include('database/connection.php');
if ($_SESSION['user'] != '') {
    // Prepare the SQL query to fetch all settled orders
    $sqlRecent = "SELECT * FROM settled_orders ORDER BY ordate DESC";
    $resultRecent = $con->query($sqlRecent);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aida Station - Recent Orders</title>
    <link rel="stylesheet" href="css/orderdetail.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>RECENT ORDERS</h1>
        </header>

        <div class="main-content">
            <div class="orders-container">
                <?php
                // Check if there are any settled orders
                if ($resultRecent->num_rows > 0) {
                    // Loop through each settled order and display the order card
                    while ($data = $resultRecent->fetch_assoc()) {
                        ?>
                        <div class="order-card">
                            <p>Meja: <?= htmlspecialchars($data['ortable']); ?></p>
                            <p>Nama Pesanan: <?= htmlspecialchars($data['orname']); ?></p>
                            <p>Jumlah Harga: RM<?= htmlspecialchars($data['totalprice']); ?></p>
                            <br>
                            <p>Tarikh Pesanan: <?= htmlspecialchars($data['ordate']); ?></p>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No recent orders found.</p>";
                }
                ?>
            </div>
        </div>

        <div class="buttons">
            <a href="orderdetail.php" class="btnLink">
                <button class="btnBack-order">BACK</button>
            </a>
        </div>
    </div>
</body>
</html>
<?php
} else {
    header('location:login.php');
}
?>
