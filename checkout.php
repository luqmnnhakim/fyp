<?php
session_start();
include('database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
    $tableNumber = intval($_POST['table_number']);

    // Loop through the cart and insert each item as an order
    foreach ($_SESSION['cart'] as $id => $item) {
        $orname = $item['name'];
        $totalprice = $item['price'] * $item['quantity'];

        $sqlInsertOrder = "INSERT INTO staff (ortable, orname, totalprice, ordate) VALUES ($tableNumber, '$orname', $totalprice, NOW())";
        $con->query($sqlInsertOrder);
    }

    // Clear the cart after checkout
    $_SESSION['cart'] = [];

    // Redirect to a success page
    header('Location: success.php');
    exit;
}
?>
