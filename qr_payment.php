<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    // Retrieve the amount and table number from the URL parameters
    $tableNumber = isset($_GET['table']) ? intval($_GET['table']) : 1;
    $amount = isset($_GET['amount']) ? $_GET['amount'] : '0.00';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Payment - Aida Station</title>
    <link rel="stylesheet" href="">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center; /* Center text */
        }
        .qr-code {
            margin: auto;
        }
        .button {
            display: inline-block;
            padding: 8px 15px; /* Increased padding for a larger button */
            font-size: 14px; /* Slightly larger font size */
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            text-decoration: none; /* No underline */
            border-radius: 5px; /* More rounded corners */
            margin-top: 20px; /* Space above the button */
            border: none; /* Remove default border */
            cursor: pointer; /* Pointer cursor */
            min-width: 100px; /* Minimum width for better appearance */
            max-width: 160px; /* Maximum width to prevent it from being too wide */
            text-align: center; /* Center the text */
        }
        .button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>
<body>
    <h1>Table Number: <?php echo htmlspecialchars($tableNumber); ?></h1>
    <h4>Total: RM<?php echo htmlspecialchars($amount); ?></h4>

    <!-- QR Code Image -->
    <div class="qr-code">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=https://toyyibpay.com/Aida-Station-Payment?amount=<?php echo urlencode($amount); ?>" alt="QR Code">
        <p>Scan to Pay</p>
    </div>

    <!-- Back button -->
    <a href="payment.php?table=<?php echo htmlspecialchars($tableNumber); ?>" class="button">Back</a>
</body>
</html>
<?php
} else {
    header('Location: login.php');
}
?>
