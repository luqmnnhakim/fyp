<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    // Retrieve the table number from the URL parameter, default to 1 if not set
    $tableNumber = isset($_GET['table']) ? intval($_GET['table']) : 1;

    // Prepare the SQL query to fetch orders for the specific table number
    $sql = "SELECT orname, totalprice FROM staff WHERE ortable = $tableNumber ORDER BY orname"; // Order by name for grouping
    $result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aida Station - Table <?php echo htmlspecialchars($tableNumber); ?></title>
    <link rel="stylesheet" href="">
    <style>
        body {
            display: grid;
            font-family: 'Courier New', Courier, monospace; /* Use a monospaced font for a receipt look */
            margin: 0; /* Remove default margin */
            padding: 20px; /* Add padding to the body */
        }

        .receipt {
            border: 1px solid #000;
            padding: 20px;
            width: 300px; /* Set width for the receipt */
            margin: 50px auto; /* Center the receipt and add margin at the top */
            text-align: left; /* Align text to the left */
            background-color: #fff; /* White background for the receipt */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 1px solid #000; /* Add a line under the header */
            padding-bottom: 10px; /* Space between header and orders */
        }

        .order-item {
            border-bottom: 1px dashed #000; /* Use dashed line for order items */
            padding: 5px 0; /* Padding for the order items */
        }

        .total {
            font-weight: bold;
            font-size: 18px; /* Increase font size for total */
            margin-top: 10px;
            text-align: right; /* Align total to the right */
        }

        .button-container {
            display: flex; /* Use flexbox to center buttons */
            justify-content: center; /* Center buttons horizontally */
            margin-top: 20px; /* Space above buttons */
        }

        .button {
            display: inline-block; /* Allows width to be set */
            width: 150px; /* Set a specific width for both buttons */
            padding: 10px; /* Set consistent padding */
            text-align: center; /* Center text */
            background-color: #4CAF50; /* Background color */
            color: white; /* Text color */
            border: none; /* No border */
            cursor: pointer; /* Pointer cursor on hover */
            border-radius: 5px; /* Rounded corners */
            text-decoration: none; /* Remove underline from links */
            margin: 0 10px; /* Space between buttons */
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }

        .button:hover {
            background-color: #45a049; /* Darker shade on hover */
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1>AIDA STATION</h1>
            <h3>Table: <?php echo htmlspecialchars($tableNumber); ?></h3>
            <p><?php echo date('Y-m-d H:i:s'); ?></p>
        </div>

        <div class="order-summary" id="order-summary">
            <?php
            if ($result->num_rows > 0) {
                $totalPrice = 0;
                $orderCounts = []; // Array to store order counts

                // Count each order
                while ($row = $result->fetch_assoc()) {
                    $orderName = htmlspecialchars($row['orname']);
                    $price = $row['totalprice'];

                    // Count the orders
                    if (isset($orderCounts[$orderName])) {
                        $orderCounts[$orderName]['count']++;
                    } else {
                        $orderCounts[$orderName] = ['count' => 1, 'price' => $price];
                    }
                }

                // Display orders with counts
                foreach ($orderCounts as $orderName => $details) {
                    echo "<div class='order-item'>";
                    echo "<strong></strong> " . $orderName . ($details['count'] > 1 ? " x" . $details['count'] : "") . "<br>";
                    echo "</div>";
                    $totalPrice += $details['price'] * $details['count']; // Update total price
                }

                echo "<div class='total'>Total : RM" . number_format($totalPrice, 2) . "</div>";
            } else {
                echo "<p>No Orders Made for Table " . htmlspecialchars($tableNumber) . ".</p>";
            }
            ?>
        </div>

        <div class="button-container">
        <!-- Payment button linking to qr_payment.php -->
        <form method="GET" action="qr_payment.php">
            <input type="hidden" name="table" value="<?php echo htmlspecialchars($tableNumber); ?>">
            <input type="hidden" name="amount" value="<?php echo number_format($totalPrice, 2, '.', ''); ?>">
            <button type="submit" class="button">Payment</button>
        </form>

        <!-- Back button -->
        <a href="cashier.php" class="button">Back</a>
    </div>
    </div>
</body>
</html>
<?php
} else {
    header('Location: login.php');
}
?>