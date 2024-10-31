<?php

include('database/connection.php'); // Connect to the database

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    header('Location: menu.php'); // Redirect to menu if cart is empty
    exit();
}

// Calculate the total price
$totalPrice = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}

// Check if the table number is set
$tableNumber = isset($_GET['table_number']) ? intval($_GET['table_number']) : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="css/receipt.css"> <!-- Link to CSS file -->
    <style>
        body {
            font-family: 'Courier New', Courier, monospace; /* Monospaced font for a receipt-like appearance */
            display: flex; /* Enable flexbox */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            min-height: 100vh; /* Full viewport height */
            margin: 0; /* Remove default margin */
            padding: 20px; /* Added padding */
            background-color: #f9f9f9; /* Light background color */
        }
        .receipt {
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff; /* White background for a clean look */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 400px; /* Set a maximum width for the receipt */
            width: 100%; /* Allow the receipt to take full width up to max-width */
            padding: 20px; /* Padding inside the receipt */
        }
        h1 {
            text-align: center;
            color: #000; /* Black color for a classic receipt header */
            margin-bottom: 15px; /* Increased margin */
            font-size: 2em; /* Increased font size for title */
            font-weight: normal; /* Normal weight for a classic look */
        }
        h2 {
            text-align: center;
            margin: 10px 0; /* Increased margin */
            font-size: 1.5em; /* Slightly larger font size */
            color: #000;
        }
        h3 {
            margin-top: 20px; /* Increased top margin */
            font-size: 1.2em; /* Larger font size */
            color: #000;
            text-decoration: underline; /* Underline for section titles */
        }
        .cart-items {
            border-top: 1px solid #000; /* Black border for separation */
            margin-top: 15px; /* Increased margin */
            padding-top: 10px; /* Balanced padding */
        }
        .cart-item {
            margin-bottom: 10px; /* Balanced margin for items */
            padding: 8px 0; /* Increased padding for items */
            border-bottom: 1px dashed #ccc; /* Dashed line for item separation */
            display: flex; /* Flex layout for item details */
            justify-content: space-between; /* Space between item name and price */
            font-size: 1.1em; /* Slightly larger font size for items */
        }
        .total {
            font-weight: bold;
            font-size: 1.5em; /* Increased total font size */
            margin-top: 20px; /* Increased margin */
            text-align: right; /* Align total to the right */
            color: #d9534f; /* Red color for total to make it stand out */
        }
        .order-button {
            display: inline-block;
            padding: 10px 16px; /* Increased padding */
            background-color: #28a745; /* Green background */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px; /* Slightly larger font size for the button */
            text-align: center;
            text-decoration: none;
            margin-top: 20px; /* Increased spacing above the button */
            transition: background-color 0.3s, transform 0.2s;
        }
        .order-button:hover {
            background-color: #218838;
            transform: scale(1.02);
        }
        .order-button:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h1>Receipt</h1>
        <h2>Table Number: <?php echo htmlspecialchars($tableNumber); ?></h2>

        <h3>Your Order:</h3>
        <div class="cart-items">
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="cart-item">
                    <?php echo htmlspecialchars($item['name']); ?> 
                    <span>RM<?php echo htmlspecialchars($item['price']); ?> x <?php echo htmlspecialchars($item['quantity']); ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="total">Total: RM<?php echo number_format($totalPrice, 2); ?></div>

        <form method="POST" action="checkout.php">
            <input type="hidden" name="table_number" value="<?php echo $tableNumber; ?>">
            <button type="submit" name="checkout" class="order-button">Order Now</button>
        </form>

        <br>
    </div>
</body>
</html>
