<?php
include('database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image']; // Get the image path from the form

    // Prepare SQL to insert menu item
    $sql = "INSERT INTO menu (name, price, image) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sds", $name, $price, $image); // Bind the image path here

    if ($stmt->execute()) {
        echo "Menu item added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$con->close();
?>
