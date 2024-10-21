<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    // Retrieve the table number from the URL parameter, default to 1 if not set
    $tableNumber = isset($_GET['table']) ? intval($_GET['table']) : 1;

    // Prepare the SQL query to fetch orders for the specific table number
    $sql = "SELECT orid, ortable, orname, totalprice, ordate FROM staff WHERE ortable = $tableNumber ORDER BY ordate DESC";
    $result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aida Station - Table <?php echo htmlspecialchars($tableNumber); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>WELCOME TO AIDA STATION</h1>
            <div class="date-time">
                <span id="table-number">Nombor Meja: <?php echo htmlspecialchars($tableNumber); ?></span>
            </div>
        </header>

        <div class="main-content">
            <div class="sidebar">
                <h2>RESIT PESANAN</h2>
                <p>------------------------------------------------------------------------------------------</p>
                <div class="order-list" id="order-list">
                    <?php
                    // Check if there are any results
                    if ($result->num_rows > 0) {
                        // Loop through each row and display the order details
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='order-item'>";
                            echo "<p><strong>ID Pesanan:</strong> " . htmlspecialchars($row['orid']) . "</p>";
                            echo "<p><strong>Nama:</strong> " . htmlspecialchars($row['orname']) . "</p>";
                            echo "<p><strong>Jumlah Harga:</strong> RM" . htmlspecialchars($row['totalprice']) . "</p>";
                            echo "<p><strong>Tarikh:</strong> " . htmlspecialchars($row['ordate']) . "</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Tiada Pesanan Yang Dibuat " . htmlspecialchars($tableNumber) . ".</p>";
                    }
                    ?>
                </div>

                <!-- Link to Payment Page -->
                <form method="GET" action="payment.php" style="display: inline;">
                    <input type="hidden" name="table" value="<?php echo htmlspecialchars($tableNumber); ?>">
                    <button type="submit" class="button">Bayar</button>
                </form>

                <!-- Back button -->
                <a href="cashier.php" class="button">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php
} else {
    header('Location: login.php');
}
?>
