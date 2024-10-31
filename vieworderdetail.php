<?php
include('database/connection.php');

$tableNumber = 0; // Initialize tableNumber to avoid undefined variable notice
if (isset($_GET['table'])) {
    $tableNumber = intval($_GET['table']);
    
    // Fetch all orders for the selected table
    $sql = "SELECT * FROM staff WHERE ortable = $tableNumber ORDER BY ordate DESC";
    $result = $con->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_orders'])) {
    if (!empty($_POST['order_ids'])) {
        $orderIds = implode(',', array_map('intval', $_POST['order_ids']));
        // Delete the selected orders
        $deleteSql = "DELETE FROM staff WHERE orid IN ($orderIds)";
        $con->query($deleteSql);
        header("Location: vieworderdetail.php?table=$tableNumber"); // Redirect to the same page to see the updated list
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - Table <?= htmlspecialchars($tableNumber); ?></title>
    <link rel="stylesheet" href="css/vieworderdetail.css">
</head>
<body>
    <div class="container">
        <h1>All Orders for Table <?= htmlspecialchars($tableNumber); ?></h1>

        <form method="POST" action="">
            <?php if ($result && $result->num_rows > 0): ?>
                <ul>
                    <?php while ($order = $result->fetch_assoc()): ?>
                        <li>
                            <input type="checkbox" name="order_ids[]" value="<?= htmlspecialchars($order['orid']); ?>">
                            <strong>Order Name:</strong> <?= htmlspecialchars($order['orname']); ?><br>
                            <strong>Date:</strong> <?= htmlspecialchars($order['ordate']); ?><br>
                            <strong>Order ID:</strong> <?= htmlspecialchars($order['orid']); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <button type="submit" name="cancel_orders" class="btnCancel-order">Cancel</button>
            <?php else: ?>
                <p>No orders found for this table.</p>
            <?php endif; ?>
        </form>

        <a href="orderdetail.php" class="btnBack-order">Back</a>
    </div>
</body>
</html>
