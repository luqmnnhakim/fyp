<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    // Prepare the SQL query to fetch all orders
    $sqldisplay = "SELECT * FROM staff ORDER BY ortable";
    $resultdisplay = $con->query($sqldisplay);

    // Initialize an array to hold orders grouped by table
    $ordersByTable = [];

    // Check if there are any orders
    if ($resultdisplay->num_rows > 0) {
        // Loop through each order and group by table
        // Modify the grouping logic in your original while loop
while ($data = $resultdisplay->fetch_assoc()) {
    $tableNumber = $data['ortable'];

    if ($tableNumber > 0) {
        if (!isset($ordersByTable[$tableNumber])) {
            $ordersByTable[$tableNumber] = [
                'orders' => [],
                'date' => null,
                'orid' => [] // To store order IDs
            ];
        }

        $orderName = $data['orname'];
        if (!isset($ordersByTable[$tableNumber]['orders'][$orderName])) {
            $ordersByTable[$tableNumber]['orders'][$orderName] = 0;
        }
        $ordersByTable[$tableNumber]['orders'][$orderName] += 1;

        // Store the order ID
        if (!in_array($data['orid'], $ordersByTable[$tableNumber]['orid'])) {
            $ordersByTable[$tableNumber]['orid'][] = $data['orid'];
        }

        // Set the date if not already set
        if ($ordersByTable[$tableNumber]['date'] === null) {
            $ordersByTable[$tableNumber]['date'] = $data['ordate'];
        }
    }
}
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aida Station</title>
    <link rel="stylesheet" href="css/orderdetail.css?v=1.1">

</head>
<body>
    <div class="container">
        <header class="header">
            <h1>ORDER DETAILS</h1>
        </header>

        <div class="main-content">
            <div class="orders-container">
                <?php
                // Check if there are any grouped orders
                if (!empty($ordersByTable)) {
                    // Loop through each table and display the combined orders
                    foreach ($ordersByTable as $table => $data) {
                        ?>
                      <!-- Add this within the order-card div to include the 'View' button -->
<div class="order-card" onclick="selectOrder(<?= htmlspecialchars($ordersByTable[$table]['orid'][0]); ?>)">
    <p>Meja: <?= htmlspecialchars($table); ?></p>
    <p>Tarikh Pesanan: <?= date('Y-m-d', strtotime($data['date'])); ?></p>
    <p>Jumlah Pesanan: <?= count($data['orders']); ?></p><br>
   
    <!-- Add the View button with a link to view_order.php and pass the table number as a query parameter -->
    <a href="vieworderdetail.php?table=<?= htmlspecialchars($table); ?>" class="btnView-order">View</a>
</div>

                        <?php
                    }
                } else {
                    echo "<p>Tiada Sebarang Pesanan Yang Masuk.</p>";
                }
                ?>
            </div>
        </div>

        <div class="buttons">
            <a href="staff.php" class="btnLink">
                <button class="btnBack-order">BACK</button>
            </a>
            <a href="recent-order.php" class="btnLink">
                <button class="btnRecent-order">RECENT ORDER</button>
            </a>
        </div>

    </div>

    <script>
        let selectedOrderId = null;

        function selectOrder(orderId) {
    selectedOrderId = orderId;
    console.log("Selected Order ID: " + selectedOrderId); // Debugging line
    document.getElementById('removeLink').href = 'removeorder.php?cid=' + selectedOrderId;
}
    </script>

</body>
</html>
<?php
} else {
    header('location:login.php');
}
?>
