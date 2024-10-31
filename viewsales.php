<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    // Get the sales ID from the URL parameter
    $salesId = intval($_GET['cid']);

    // Fetch the sales date from the 'sales' table
    $sqlSalesDate = "SELECT salesdate FROM sales WHERE salesid = $salesId";
    $resultSalesDate = $con->query($sqlSalesDate);
    $salesDate = '';
    if ($resultSalesDate->num_rows > 0) {
        $salesData = $resultSalesDate->fetch_assoc();
        $salesDate = date('Y-m-d', strtotime($salesData['salesdate'])); // Format date to 'YYYY-MM-DD'
    }

    // Fetch all settled orders for the specific date
    $sqlOrders = "SELECT * FROM settled_orders WHERE DATE(ordate) = '$salesDate'";
    $resultOrders = $con->query($sqlOrders);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - <?= htmlspecialchars($salesDate); ?></title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="body-sales">
    <div class="sales-container">
        <h2 class="h2-sales">Orders for <?= htmlspecialchars($salesDate); ?></h2>
        <table class="table-sales">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Table</th>
                    <th>Order Name</th>
                    <th>Total Price</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultOrders->num_rows > 0) {
                    while ($order = $resultOrders->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($order['orid']); ?></td>
                            <td><?= htmlspecialchars($order['ortable']); ?></td>
                            <td><?= htmlspecialchars($order['orname']); ?></td>
                            <td>RM<?= htmlspecialchars($order['totalprice']); ?></td>
                            <td><?= date('Y-m-d', strtotime($order['ordate'])); ?></td> <!-- Format date for ordates -->
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No orders found for this date.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="sales.php" class="btnLink">
            <button class="btnBack-order">Back</button>
        </a>
    </div>
</body>
</html>
<?php
} else {
    header('location:login.php');
}
?>
