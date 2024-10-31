<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    // Prepare the SQL query to fetch all settled orders
    $sqlRecent = "SELECT * FROM settled_orders ORDER BY ortable, orname"; // Order by table and name
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
                    $ordersByTable = [];
                    
                    // Loop through each settled order and group by table
                    while ($data = $resultRecent->fetch_assoc()) {
                        $table = $data['ortable'];
                        $orderName = htmlspecialchars($data['orname']);
                        $totalPrice = htmlspecialchars($data['totalprice']);
                        $orderDate = htmlspecialchars($data['ordate']);

                        // Grouping orders by table number
                        if (!isset($ordersByTable[$table])) {
                            $ordersByTable[$table] = [
                                'orders' => [],
                                'totalPrice' => 0,
                                'date' => $orderDate // Assuming the date is the same for all orders in the group
                            ];
                        }
                        if (isset($ordersByTable[$table]['orders'][$orderName])) {
                            $ordersByTable[$table]['orders'][$orderName]++;
                        } else {
                            $ordersByTable[$table]['orders'][$orderName] = 1;
                        }
                        $ordersByTable[$table]['totalPrice'] += $totalPrice; // Aggregate total price
                    }

                    // Display grouped orders
                    foreach ($ordersByTable as $table => $orderDetails) {
                        echo "<div class='order-card'>";
                        echo "<p>Meja: $table</p>";
                        echo "<p>Jumlah Harga: RM" . number_format($orderDetails['totalPrice'], 2) . "</p>";
                        echo "<p>Tarikh Pesanan: " . date('Y-m-d', strtotime($orderDetails['date'])) . "</p><br>"; // Added <br> after the date
                        echo "<ul>";
                        foreach ($orderDetails['orders'] as $orderName => $count) {
                            echo "<li>" . $orderName . ($count > 1 ? " x$count" : "") . "</li>";
                        }
                        echo "</ul>";
                        echo "<br>";
                        echo "</div>";
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
