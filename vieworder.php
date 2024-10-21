<?php
session_start();
include('db_connection.php');

// Function to remove item from order
if (isset($_POST['remove_item'])) {
    $itemToRemove = $_POST['item'];
    foreach ($_SESSION['order'] as $key => $item) {
        if ($item['name'] === $itemToRemove) {
            unset($_SESSION['order'][$key]); // Remove the item from session order
            echo "<script>alert('$itemToRemove removed from order!');</script>";
        }
    }
    $_SESSION['order'] = array_values($_SESSION['order']); // Re-index the array
}

// Function to accept and save the order to the database
if (isset($_POST['accept_order'])) {
    if (!empty($_SESSION['order'])) {
        $listorder = [];
        $totalprice = 0;
        
        // Build order list and calculate total price
        foreach ($_SESSION['order'] as $item) {
            $listorder[] = $item['name'];
            $totalprice += $item['price'];
        }
        
        // Prepare data for insertion
        $listorderStr = implode(', ', $listorder);
        $sql = "INSERT INTO incomingorder (listorder, totalprice) VALUES ('$listorderStr', '$totalprice')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Order accepted and saved!');</script>";
            $_SESSION['order'] = []; // Clear the order after saving
        } else {
            echo "<script>alert('Error saving order: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('No items in the order to save!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order</title>
    <style>
        /* Add your mobile-friendly styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .order-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .order-item img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
        .order-item form {
            display: inline;
        }
        .total-price {
            font-size: 18px;
            margin: 20px;
            text-align: right;
        }
        .order-actions {
            text-align: center;
            margin: 20px 0;
        }
        .order-actions button {
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            margin-right: 10px;
        }
        .back-home {
            text-align: center;
            margin: 20px 0;
        }
        .back-home a {
            padding: 10px 20px;
            background-color: blue;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h1 style="text-align:center;">Pesanan Anda</h1>

<?php if (!empty($_SESSION['order'])): ?>
    <?php foreach ($_SESSION['order'] as $item): ?>
        <div class="order-item">
            <img src="<?= 'img/' . strtolower(str_replace(' ', '', $item['name'])) . '.jpg' ?>" alt="<?= $item['name'] ?>">
            <div>
                <strong><?= $item['name'] ?></strong> - RM<?= number_format($item['price'], 2) ?>
            </div>
            <form method="post">
                <input type="hidden" name="item" value="<?= $item['name'] ?>">
                <button type="submit" name="remove_item" style="background-color: red; color: white;">Buang</button>
            </form>
        </div>
    <?php endforeach; ?>
    
    <div class="total-price">
        <strong>Total Price: RM<?= number_format(array_sum(array_column($_SESSION['order'], 'price')), 2) ?></strong>
    </div>
    
    <div class="order-actions">
        <form method="post">
            <button type="submit" name="accept_order">Terima Pesanan</button>
        </form>
    </div>

<?php else: ?>
    <p style="text-align:center;">No items in your order.</p>
<?php endif; ?>

<div class="back-home">
    <a href="menu.php">Kembali</a>
</div>

</body>
</html>