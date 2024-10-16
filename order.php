<?php
include('database/connection.php');
if($_SESSION['user']!=''){
    //execute command at this page

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
                <span id="table-number">Table Number: <?php echo htmlspecialchars($tableNumber); ?></span>
            </div>
        </header>

        <div class="main-content">
            <div class="sidebar">
                <h2>RECEIPT ORDER</h2>
                <p>------------------------------------------------------------------------------------------</p>
                <div class="order-list" id="order-list">
                    <?php
                    // Check if there are any results
                    if ($result->num_rows > 0) {
                        // Loop through each row and display the order details
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='order-item'>";
                            echo "<p><strong>Order ID:</strong> " . htmlspecialchars($row['orid']) . "</p>";
                            echo "<p><strong>Name:</strong> " . htmlspecialchars($row['orname']) . "</p>";
                            echo "<p><strong>Total Price:</strong> RM" . htmlspecialchars($row['totalprice']) . "</p>";
                            echo "<p><strong>Date:</strong> " . htmlspecialchars($row['ordate']) . "</p>";
                            echo "</div>";
                        }
                    } else {
                        // Display a message if no orders are found for the table
                        echo "<p>No orders found for Table " . htmlspecialchars($tableNumber) . ".</p>";
                    }
                    ?>
                </div>

                <!-- Buttons for Back and Payment -->
                <div class="buttons">
                    <a href="cashier.php" class="button">Back</a>
                    <a href="payment.php?table=<?php echo htmlspecialchars($tableNumber); ?>" class="button">Payment</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
</html>
<?php
}
else{
    header('location:login.php');
}
?>