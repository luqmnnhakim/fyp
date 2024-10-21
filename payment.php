<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    // Retrieve the table number from the URL parameter
    $tableNumber = isset($_GET['table']) ? intval($_GET['table']) : 1;

    // Handle payment processing if the user confirmed
    if (isset($_POST['confirm_payment'])) {
        // Move current orders to 'settled_orders' table
        $sqlInsert = "INSERT INTO settled_orders (orid, ortable, orname, totalprice, ordate)
                      SELECT staff.orid, staff.ortable, staff.orname, staff.totalprice, staff.ordate 
                      FROM staff 
                      WHERE staff.ortable = $tableNumber";

        if ($con->query($sqlInsert) === TRUE) {
            // Calculate total sale for the current table's orders
            $sqlTotalSale = "SELECT SUM(totalprice) AS total FROM staff WHERE ortable = $tableNumber";
            $totalResult = $con->query($sqlTotalSale);
            $totalSale = 0;

            if ($totalResult->num_rows > 0) {
                $totalRow = $totalResult->fetch_assoc();
                $totalSale = $totalRow['total'];
            }

            // Insert total sale into 'sales' table
            // Use INSERT ... ON DUPLICATE KEY UPDATE to add to the existing record for that date
            $sqlInsertSales = "INSERT INTO sales (salesdate, salestotal) VALUES (CURDATE(), $totalSale)
                               ON DUPLICATE KEY UPDATE salestotal = salestotal + $totalSale";

            if ($con->query($sqlInsertSales) === TRUE) {
                // Clear the current orders from 'staff' table
                $sqlClear = "DELETE FROM staff WHERE ortable = $tableNumber";
                if ($con->query($sqlClear) === TRUE) {
                    // Redirect to staff.php after successful payment processing
                    header("Location: staff.php");
                    exit();
                } else {
                    echo "Error clearing orders: " . $con->error;
                }
            } else {
                echo "Error inserting sales record: " . $con->error;
            }
        } else {
            echo "Error settling orders: " . $con->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Table <?php echo htmlspecialchars($tableNumber); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Payment for Table <?php echo htmlspecialchars($tableNumber); ?></h1>
        </header>

        <div class="main-content">
            <h2>Confirm Payment</h2>
            <form method="POST" action="">
                <input type="hidden" name="confirm_payment" value="1">
                <p>Adakah Bayaran Telah Dibuat? <?php echo htmlspecialchars($tableNumber); ?>?</p>
                <button type="submit" class="button">Ya, Teruskan Pembayaran</button>
            </form>
            <a href="order.php?table=<?php echo htmlspecialchars($tableNumber); ?>" class="button">Kembali</a>
        </div>
    </div>
</body>
</html>
<?php
} else {
    header('Location: login.php');
}
?>
