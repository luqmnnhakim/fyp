<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    // Prepare the SQL query to fetch all settled orders
    $sql = "SELECT * FROM settled_orders ORDER BY ordate DESC";
    $result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settled Orders</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Settled Orders</h1>
        </header>

        <div class="main-content">
            <div class="order-list" id="order-list">
                <?php
                // Check if there are any results
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='order-item'>";
                        echo "<p><strong>Order ID:</strong> " . htmlspecialchars($row['orid']) . "</p>";
                        echo "<p><strong>Table:</strong> " . htmlspecialchars($row['ortable']) . "</p>";
                        echo "<p><strong>Name:</strong> " . htmlspecialchars($row['orname']) . "</p>";
                        echo "<p><strong>Total Price:</strong> RM" . htmlspecialchars($row['totalprice']) . "</p>";
                        echo "<p><strong>Date:</strong> " . htmlspecialchars($row['ordate']) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No settled orders found.</p>";
                }
                ?>
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