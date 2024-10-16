<?php
include('database/connection.php');
if($_SESSION['user']!=''){
    //execute command at this page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
    <link rel="stylesheet" href="css/order.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Update Order</h1>
        </header>

        <section class="main-content">
            <form action="updateorder.php" method="POST" class="update-order-form">
                <label for="order-id">Order ID:</label>
                <input type="text" id="order-id" name="order_id" required>

                <label for="table-number">Table Number:</label>
                <input type="text" id="table-number" name="table_number" required>

                <label for="order-items">Order Items:</label>
                <textarea id="order-items" name="order_items" rows="4" required></textarea>

                <label for="total-price">Total Price (RM):</label>
                <input type="number" id="total-price" name="total_price" required step="0.01">

                <label for="notes">Additional Notes:</label>
                <textarea id="notes" name="notes" rows="3"></textarea>

                <button type="submit" class="action-btn">Update Order</button>
            </form>
            <br>
            <a href="staff.php" class="btnLink">
                <button class="action-btn">BACK</button>
            </a>
        </section>
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